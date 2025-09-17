<?php
require_once __DIR__ . '/../partials/config.php';

//header('Content-Type: application/json'); // Always return JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $mobile_no = trim($_POST['mobile_no'] ?? '');

    if ($name === '' || $mobile_no === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Supplier name and mobile number are required"
        ]);
        exit;
    }

    // Use prepared statement (safer than direct SQL)
    $stmt = $link->prepare("INSERT INTO suppliers (name, phone) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ss", $name, $mobile_no);
        if ($stmt->execute()) {
            echo json_encode([
                "status" => "success",
                "id" => $stmt->insert_id,
                "name" => $name,
                "phone" => $mobile_no
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Failed to insert supplier: " . $stmt->error
            ]);
        }
        $stmt->close();
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Database error: " . $link->error
        ]);
    }
}
?>
