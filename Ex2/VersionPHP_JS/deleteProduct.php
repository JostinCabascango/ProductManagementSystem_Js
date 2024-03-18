<?php
require "../../Ex1/Database.php";
require "../../Ex1/Product.php";

if (!empty($_POST["id"])) {
    $db = new Database("localhost", "root", "", "products");
    $product = new Product($db);
    $result = $product->delete($_POST["id"]);
    $response = new stdClass();
    if ($result) {
        $response->status = "success";
        $response->message = "Product deleted successfully";
    } else {
        $response->status = "error";
        $response->message = "Error deleting product: " . $db->error;
    }
    $db->close();
    echo json_encode($response);
}