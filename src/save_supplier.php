<?php
require_once __DIR__ . '/../partials/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($link, $_POST['name']);

    if (!empty($name)) {
        $query = "INSERT INTO suppliers (name) VALUES ('$name')";
        if (mysqli_query($link, $query)) {
            echo json_encode(["status" => "success", "id" => mysqli_insert_id($link), "name" => $name]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($link)]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Supplier name is required"]);
    }
}
?>
