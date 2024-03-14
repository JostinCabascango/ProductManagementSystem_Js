<?php
session_start();
require "Database.php";
require "Product.php";

const EMPTY_ID = 0;
const NO_RESULTS_MESSAGE = "0 results";

$db = new Database("localhost", "root", "", "products");
$product = new Product($db);
$productName = "";
$productId = EMPTY_ID;
$message = "";
function getProductDetails($id)
{
    global $product, $productName, $productId, $message, $db;
    $result = $product->get($id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productName = $row["name"];
        $productId = $row["id"];
    } else {
        $message = NO_RESULTS_MESSAGE;
    }
    $db->close();

}

if (!empty($_GET["id"])) {
    getProductDetails($_GET["id"]);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-200">
<div class="w-full max-w-xs">
    <h2 class="mb-5 text-2xl font-bold text-center">Form</h2>
    <form action="process_form.php" method="POST" class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
        <div class="mb-4">
            <label class="block mb-2 text-sm font-bold text-gray-700" for="productName">
                Nom
            </label>
            <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                   id="productName" name="productName" type="text" placeholder="Nom"
                   value="<?php echo $productName; ?>">
        </div>
        <input type="hidden" name="productId" value="<?php echo $productId; ?>"/>
        <div class="flex items-center justify-between">
            <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                    type="submit">
                Submit
            </button>
        </div>
    </form>
</div>
</body>
</html>