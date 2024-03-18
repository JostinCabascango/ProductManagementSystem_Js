<?php
require "../../Ex1/Database.php";
require "../../Ex1/Product.php";

$db = new Database("localhost", "root", "", "products");
$product = new Product($db);
const EMPTY_ID = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    processForm();
}

function processForm()
{
    global $db, $product;

    $productName = $_POST["productName"];
    $productId = $_POST["productId"];

    if (!empty($productName)) {
        $message = EMPTY_ID == $productId ? saveProduct($productName) : updateProduct($productName, $productId);
        $_SESSION['message'] = $message;
    }

    $db->close();
    header('Location: ListProducts.php');
}

function saveProduct($productName)
{
    global $product, $db;
    $result = $product->save($productName);
    return $result ? "New record created successfully" : "Error: " . $db->error;
}

function updateProduct($productName, $productId)
{
    global $product, $db;
    $result = $product->update($productName, $productId);
    return $result ? "Product with id $productId updated successfully" : "Error: " . $db->error;
}

header('Location: ex2FormLlistat.php');