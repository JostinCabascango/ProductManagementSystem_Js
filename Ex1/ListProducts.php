<?php
session_start();
require_once "Database.php";
require_once "Product.php";

$db = new Database("localhost", "root", "", "products");
$product = new Product($db);
$products = fetchProducts($product);
$db->close();
function fetchProducts(Product $product)
{
    $result = $product->getAll();
    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}

function displayMessage()
{
    if (isset($_SESSION['message'])) {
        echo '<div id="alert" class="m-3 fixed top-0 right-0 bg-green-500 text-white p-3"> ' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
}

displayMessage();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-200">
<div class="w-full max-w-2xl mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
    <div class="md:flex">
        <div class="p-8">
            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Products</div>
            <a href="index.php" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">Add new
                product</a>
            <p class="mt-2 text-gray-500">Total products: <?php echo count($products); ?></p>
            <table class="table-auto w-full mt-4">
                <thead>
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Edit</th>
                    <th class="px-4 py-2">Remove</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (empty($products)) { ?>
                    <tr>
                        <td colspan="4" class="border px-4 py-2">No hay registros disponibles</td>
                    </tr>
                <?php } else {
                    foreach ($products as $product) { ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo $product["id"]; ?></td>
                            <td class="border px-4 py-2"><?php echo $product["name"]; ?></td>
                            <td class="border px-4 py-2"><a href="index.php?id=<?php echo $product["id"]; ?>"
                                                            class="text-blue-500 hover:text-blue-800">Edit</a></td>
                            <td class="border px-4 py-2"><a href="delete.php?id=<?php echo $product["id"]; ?>"
                                                            class="text-red-500 hover:text-red-800">Remove</a></td>
                        </tr>
                    <?php }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    setTimeout(function () {
        document.getElementById('alert').style.display = 'none';
    }, 3000);
</script>
</body>
</html>