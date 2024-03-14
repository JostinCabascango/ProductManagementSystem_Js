<?php
session_start();
require "Database.php";
require "Product.php";

$db = new Database("localhost", "root", "", "products");
$product = new Product($db);

if (!empty($_GET["id"])) {
    $result = $product->delete($_GET["id"]);
    if ($result) {
        $_SESSION['message'] = "Record deleted successfully";
    } else {
        $_SESSION['message'] = "Error: " . $db->error;
    }
}

header("Location: ListProducts.php");
exit();
?>