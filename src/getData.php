<?php
require_once __DIR__ . '/../partials/config.php';

header('Content-Type: application/json');

// Check if "type" is sent
$type = isset($_GET['type']) ? $_GET['type'] : '';

switch ($type) {
	case 'suppliers':
	$search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';

    $query = "SELECT id, name FROM suppliers";
    if ($search != '') {
        $query .= " WHERE name LIKE '%$search%' OR phone LIKE '%$search%'";
    }
    $query .= " ORDER BY name ASC";

    $result = mysqli_query($link, $query);
    $suppliers = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $suppliers[] = $row;
        }
    }
    echo json_encode($suppliers);
    break;

    case 'supplier-returns':
    $search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';

    $query = "SELECT DISTINCT s.id, s.name FROM suppliers s INNER JOIN purchase_returns pr ON pr.supplier_id = s.id";
    if ($search != '') {
        $query .= " WHERE s.name LIKE '%$search%' OR s.phone LIKE '%$search%'";
    }
    $query .= " ORDER BY s.name ASC";

    $result = mysqli_query($link, $query);
    $suppliers = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $suppliers[] = $row;
        }
    }
    echo json_encode($suppliers);
    break;

    case 'customers':
    $search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';
    $query = "SELECT id, name, phone FROM customers 
              WHERE is_active = 1 
              AND (name LIKE '%$search%' OR phone LIKE '%$search%')
              ORDER BY name ASC LIMIT 10";

    $result = mysqli_query($link, $query);
    $customers = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $customers[] = $row;
        }
    }
    echo json_encode($customers);
    break;

    case 'purchase_references':
    $supplierId = intval($_GET['supplier_id']);
    $search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) :'';

    $query = "SELECT id, reference_no FROM purchase WHERE supplier_id = $supplierId AND reference_no LIKE '%$search%' ORDER BY reference_no ASC";
    $result = mysqli_query($link, $query);
    $purchase_references = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $purchase_references[] = $row;
        }
    }
    echo json_encode($purchase_references);
    break;

    case 'order_references':
    $custId = intval($_GET['cust_id']);
    $search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) :'';

    $query = "SELECT id, order_number FROM orders WHERE customer_id = $custId AND order_number LIKE '%$search%' ORDER BY order_number ASC";
    $result = mysqli_query($link, $query);
    $order_references = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $order_references[] = $row;
        }
    }
    echo json_encode($order_references);
    break;

    case 'products':
    $products = [];
    $limit = 10;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    if ($search !== '') {
        // Search filter
        $stmt = $link->prepare("SELECT id, name, price, cost_price, stock_quantity 
            FROM products 
            WHERE is_active = 1 AND (name LIKE ? OR sku LIKE ? OR description LIKE ?) 
            ORDER BY name ASC 
            LIMIT ?");
        $searchParam = "%$search%";
        $stmt->bind_param("sssi", $searchParam, $searchParam, $searchParam, $limit);
    } else {
        // Default first 10 products
        $stmt = $link->prepare("SELECT id, name, price, cost_price, stock_quantity 
            FROM products 
            WHERE is_active = 1 
            ORDER BY name ASC 
            LIMIT ?");
        $stmt->bind_param("i", $limit);
    }

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    echo json_encode($products);
    break;

    case 'return-products':
    $products = [];
    $limit = 10;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $purchase_id = isset($_GET['purchase_no']) ? trim($_GET['purchase_no']) : '';

    if ($purchase_id !== '') {
        if ($search !== '') {
            // Search with reference filter
            $searchParam = mysqli_real_escape_string($link, $search);
            $purchase_id_safe = mysqli_real_escape_string($link, $purchase_id);

            $query = "SELECT pd.id, pd.name, pd.price, pd.cost_price, pd.stock_quantity, pri.quantity,
            COALESCE(SUM(pri2.return_qty), 0) AS already_returned
            FROM products pd
            JOIN purchase_items pri ON pri.product_id = pd.id 
            JOIN purchase pr ON pr.id = pri.purchase_id
            LEFT JOIN purchase_return_items pri2 ON pri2.product_id = pd.id
            LEFT JOIN purchase_returns pr2 ON pr2.id = pri2.purchase_return_id AND pr2.purchase_id = pr.id
            WHERE pr.id = '$purchase_id_safe'
            AND pd.is_active = 1
            AND (
            pd.name LIKE '%$searchParam%' 
            OR pd.sku LIKE '%$searchParam%' 
            OR pd.description LIKE '%$searchParam%'
            )
            GROUP BY pd.id, pd.name, pd.price, pd.cost_price, pd.stock_quantity, pri.quantity
            ORDER BY pd.name ASC 
            LIMIT $limit ";
        } else {
            // Default first 10 products by reference
            $purchase_id_safe = mysqli_real_escape_string($link, $purchase_id);

            $query = "SELECT pd.id, pd.name, pd.price, pd.cost_price, pd.stock_quantity, pri.quantity,
            COALESCE(SUM(pri2.return_qty), 0) AS already_returned
            FROM products pd
            JOIN purchase_items pri ON pri.product_id = pd.id 
            JOIN purchase pr ON pr.id = pri.purchase_id
            LEFT JOIN purchase_return_items pri2 ON pri2.product_id = pd.id
            LEFT JOIN purchase_returns pr2 ON pr2.id = pri2.purchase_return_id AND pr2.purchase_id = pr.id
            WHERE pr.id = '$purchase_id_safe'
            AND pd.is_active = 1
            GROUP BY pd.id, pd.name, pd.price, pd.cost_price, pd.stock_quantity, pri.quantity
            ORDER BY pd.name ASC 
            LIMIT $limit ";
        }

        $result = mysqli_query($link, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = $row;
            }
        }
        echo json_encode($products);
    } else {
        // If no purchase reference selected, return empty
        echo json_encode([]);
    }
    break;

    case 'sales-return-products':
    $products = [];
    $limit = 10;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $order_id = isset($_GET['order_id']) ? trim($_GET['order_id']) : '';

    if ($order_id !== '') {
        $order_id_safe = mysqli_real_escape_string($link, $order_id);

        if ($search !== '') {
            // Search products in that order
            $searchParam = mysqli_real_escape_string($link, $search);

            $query = "
            SELECT 
            p.id,
            p.name,
            oi.unit_price,
            oi.quantity AS ordered_qty,
            COALESCE(SUM(sri.return_qty), 0) AS already_returned
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            JOIN orders o ON o.id = oi.order_id
            LEFT JOIN sales_return_items sri ON sri.product_id = p.id
            LEFT JOIN sales_returns sr ON sr.id = sri.sales_return_id AND sr.order_id = o.id
            WHERE oi.order_id = '$order_id_safe'
            AND p.is_active = 1
            AND (
            p.name LIKE '%$searchParam%'
            OR p.sku LIKE '%$searchParam%'
            OR p.description LIKE '%$searchParam%'
            )
            GROUP BY p.id, p.name, oi.unit_price, oi.quantity
            ORDER BY p.name ASC
            LIMIT $limit
            ";
        } else {
            // Default first 10 products for that order
            $query = "
            SELECT 
            p.id,
            p.name,
            oi.unit_price,
            oi.quantity AS ordered_qty,
            COALESCE(SUM(sri.return_qty), 0) AS already_returned
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            JOIN orders o ON o.id = oi.order_id
            LEFT JOIN sales_return_items sri ON sri.product_id = p.id
            LEFT JOIN sales_returns sr ON sr.id = sri.sales_return_id AND sr.order_id = o.id
            WHERE oi.order_id = '$order_id_safe'
            AND p.is_active = 1
            GROUP BY p.id, p.name, oi.unit_price, oi.quantity
            ORDER BY p.name ASC
            LIMIT $limit
            ";
        }

        $result = mysqli_query($link, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = $row;
            }
        }
        echo json_encode($products);
    } else {
        // If no order selected, return empty
        echo json_encode([]);
    }
    break;

    case 'get_purchase':
    $purchase_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Get purchase details
    $query = "SELECT p.*, s.name AS supplier_name 
    FROM purchase p 
    LEFT JOIN suppliers s ON p.supplier_id = s.id 
    WHERE p.id = '$purchase_id'";
    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $purchase = mysqli_fetch_assoc($result);

        // Get purchase items
        $itemsQuery = "SELECT pi.*, pr.name 
        FROM purchase_items pi 
        LEFT JOIN products pr ON pi.product_id = pr.id 
        WHERE pi.purchase_id = '$purchase_id'";
        $itemsResult = mysqli_query($link, $itemsQuery);

        $items = [];
        if ($itemsResult) {
            while ($row = mysqli_fetch_assoc($itemsResult)) {
                $items[] = $row;
            }
        }

        echo json_encode([
            'status'   => 'success',
            'purchase' => $purchase,
            'items'    => $items
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Purchase not found']);
    }
    break;

    case 'get-purchase-return':
    $return_id = isset($_GET['return_id']) ? intval($_GET['return_id']) : 0;

    // Get purchase return details
    $query = "SELECT p.*, s.name AS supplier_name 
    FROM purchase_returns p 
    LEFT JOIN suppliers s ON p.supplier_id = s.id 
    WHERE p.id = '$return_id'";
    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $purchase = mysqli_fetch_assoc($result);

        // Get purchase return items
        $itemsQuery = "SELECT pi.*, pr.name, pri.quantity AS purchased_qty,
        COALESCE(pri2.total_returned, 0) AS already_returned,
        GREATEST(pri.quantity - COALESCE(pri2.total_returned, 0) - pi.return_qty, 0) AS stock
        FROM purchase_return_items pi
        LEFT JOIN purchase_returns prr ON prr.id = pi.purchase_return_id
        LEFT JOIN products pr ON pr.id = pi.product_id
        LEFT JOIN purchase_items pri 
        ON pri.purchase_id = prr.purchase_id AND pri.product_id = pi.product_id
        LEFT JOIN (
        SELECT prr_inner.purchase_id, pri2_inner.product_id, SUM(pri2_inner.return_qty) AS total_returned
        FROM purchase_return_items pri2_inner
        JOIN purchase_returns prr_inner ON prr_inner.id = pri2_inner.purchase_return_id
        WHERE pri2_inner.purchase_return_id != '$return_id'
        GROUP BY prr_inner.purchase_id, pri2_inner.product_id
        ) pri2 
        ON pri2.purchase_id = prr.purchase_id AND pri2.product_id = pi.product_id
        WHERE pi.purchase_return_id = '$return_id'";

        $itemsResult = mysqli_query($link, $itemsQuery);

        $items = [];
        if ($itemsResult) {
            while ($row = mysqli_fetch_assoc($itemsResult)) {
                $row['stock'] = max(0, $row['stock']); // ensure no negative stock
                $items[] = $row;
            }
        }

        echo json_encode([
            'status'   => 'success',
            'purchase' => $purchase,
            'items'    => $items
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Purchase Return not found']);
    }
    break;

    case 'get-sales-return':
    $return_id = isset($_GET['return_id']) ? intval($_GET['return_id']) : 0;

    // Get sales return details
    $query = "SELECT s.*, c.name AS cust_name 
    FROM sales_returns s 
    LEFT JOIN customers c ON s.customer_id = c.id 
    WHERE s.id = '$return_id'";
    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $sales = mysqli_fetch_assoc($result);

        // Get sales return items
        $itemsQuery = "SELECT sri.*, pr.name AS product_name, oi.quantity AS purchased_qty,
        COALESCE(sri2.total_returned, 0) AS already_returned,
        oi.quantity AS prod_qty,
        GREATEST(oi.quantity - COALESCE(sri2.total_returned, 0) - sri.return_qty, 0) AS stock
        FROM sales_return_items sri
        LEFT JOIN sales_returns sr ON sr.id = sri.sales_return_id
        LEFT JOIN products pr ON pr.id = sri.product_id
        LEFT JOIN order_items oi 
        ON oi.order_id = sr.order_id AND oi.product_id = sri.product_id
        LEFT JOIN (
        SELECT sr_inner.order_id, sri2_inner.product_id, SUM(sri2_inner.return_qty) AS total_returned
        FROM sales_return_items sri2_inner
        JOIN sales_returns sr_inner ON sr_inner.id = sri2_inner.sales_return_id
        WHERE sri2_inner.sales_return_id != '$return_id'
        GROUP BY sr_inner.order_id, sri2_inner.product_id
        ) sri2 
        ON sri2.order_id = sr.order_id AND sri2.product_id = sri.product_id
        WHERE sri.sales_return_id = '$return_id'";

        $itemsResult = mysqli_query($link, $itemsQuery);

        $items = [];
        if ($itemsResult) {
            while ($row = mysqli_fetch_assoc($itemsResult)) {
                $row['stock'] = max(0, $row['stock']); // ensure no negative stock
                $items[] = $row;
            }
        }

        echo json_encode([
            'status' => 'success',
            'sales'  => $sales,
            'items'  => $items
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Sales Return not found']);
    }
    break;

    // case 'save_customer':
    // $name   = mysqli_real_escape_string($link, $_POST['name'] ?? '');

    // if ($name == '') {
    //     echo json_encode(['success' => false, 'message' => 'Customer name is required']);
    //     exit;
    // }

    // $insert = "INSERT INTO customers (name) VALUES ('$name')";
    // if (mysqli_query($link, $insert)) {
    //     $newId = mysqli_insert_id($link);
    //     echo json_encode([
    //         'success' => true,
    //         'id'      => $newId,
    //         'name'    => $name
    //     ]);
    // } else {
    //     echo json_encode(['success' => false, 'message' => mysqli_error($link)]);
    // }
    // break;

    default:
    echo json_encode(['error' => 'Invalid type']);
    break;
}
?>