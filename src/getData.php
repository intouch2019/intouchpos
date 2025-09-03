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

	case 'products':
	$query = "SELECT id, name, price, cost_price, stock_quantity FROM products WHERE is_active = 1 ORDER BY name ASC";
	$result = mysqli_query($link, $query);
	$products = [];
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			$products[] = $row;
		}
	}
	echo json_encode($products);
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

	default:
	echo json_encode(['error' => 'Invalid type']);
	break;
}
?>