<?php

require "../../Ex1/Database.php";
require "../../Ex1/Product.php";

if (!empty($_POST["id"])) {
    $db = new Database("localhost", "root", "", "products");
    $product = new Product($db);
    $result = $product->get($_POST["id"]);
    $array = array();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $object = new stdClass();
        $object->id = $row["id"];
        $object->name = $row["name"];
        echo json_encode($object);
    } else {
        echo "0 results";
    }
    $db->close();
}


