<?php
require "Database.php";
require "Product.php";

$db = new Database("localhost", "root", "", "products");
$product = new Product($db);

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $product->delete($_GET["id"]);
}

header("Location: ListProducts.php");
exit();
?>