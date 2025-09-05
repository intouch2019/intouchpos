<?php
require_once __DIR__ . '/../partials/config.php';

header('Content-Type: application/json');

// Check if "type" is sent
$type = isset($_GET['type']) ? $_GET['type'] : '';

switch ($type) {
	case 'suppliers':
	$query = "SELECT id, name FROM suppliers ORDER BY name ASC";
	$result = mysqli_query($link, $query);
	$suppliers = [];
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			$suppliers[] = $row;
		}
	}
	echo json_encode($suppliers);
	break;

    case 'purchase_references':
    $supplierId = intval($_GET['supplier_id']);
    $query = "SELECT id, reference_no FROM purchase WHERE supplier_id = $supplierId ORDER BY reference_no ASC";
    $result = mysqli_query($link, $query);
    $suppliers = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $suppliers[] = $row;
        }
    }
    echo json_encode($suppliers);
    break;

    case 'products':
    $products = [];
    $limit = 10;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    if ($search !== '') {
        // Search filter
        $stmt = $link->prepare("SELECT id, name, price, cost_price, stock_quantity 
            FROM products 
            WHERE is_active = 1 AND name LIKE ? 
            ORDER BY name ASC 
            LIMIT ?");
        $searchParam = "%$search%";
        $stmt->bind_param("si", $searchParam, $limit);
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
            AND pd.name LIKE '%$searchParam%' 
            GROUP BY pd.id, pd.name, pd.price, pd.cost_price, pd.stock_quantity, pri.quantity
            ORDER BY pd.name ASC 
            LIMIT $limit ";
            // $query = "
            // SELECT pd.id, pd.name, pd.price, pd.cost_price, pd.stock_quantity, pri.quantity 
            // FROM products pd 
            // JOIN purchase_items pri ON pri.product_id = pd.id 
            // JOIN purchase pr ON pr.id = pri.purchase_id
            // WHERE pr.id = '$purchase_id_safe' 
            // AND pd.is_active = 1 
            // AND pd.name LIKE '%$searchParam%' 
            // ORDER BY pd.name ASC 
            // LIMIT $limit
            // ";

        } else {
            // Default first 10 products by reference
            $purchase_id_safe = mysqli_real_escape_string($link, $purchase_id);

            // $query = "
            // SELECT pd.id, pd.name, pd.price, pd.cost_price, pd.stock_quantity, pri.quantity 
            // FROM products pd 
            // JOIN purchase_items pri ON pri.product_id = pd.id 
            // JOIN purchase pr ON pr.id = pri.purchase_id
            // WHERE pr.id = '$purchase_id_safe' 
            // AND pd.is_active = 1 
            // ORDER BY pd.name ASC 
            // LIMIT $limit
            // ";
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
        SELECT prr_inner .purchase_id, pri2_inner.product_id, SUM(pri2_inner.return_qty) AS total_returned
        FROM purchase_return_items pri2_inner
        JOIN purchase_returns prr_inner  ON prr_inner .id = pri2_inner.purchase_return_id
        WHERE pri2_inner.purchase_return_id != '$return_id'
        GROUP BY prr_inner .purchase_id, pri2_inner.product_id
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

    case 'customers':
    $query = "SELECT id, name FROM customers WHERE is_active = 1 ORDER BY name ASC";
    $result = mysqli_query($link, $query);
    $customers = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $customers[] = $row;
        }
    }
    echo json_encode($customers);
    break;

    default:
    echo json_encode(['error' => 'Invalid type']);
    break;
}
?>