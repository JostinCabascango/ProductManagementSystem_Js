<?php
require "../../Ex1/Database.php";
require "../../Ex1/Product.php";

function getProducts()
{
    $db = new Database("localhost", "root", "", "products");
    $product = new Product($db);
    $products = $product->getAll();

    $array = array();
    if ($products->num_rows > 0) {
        while ($row = $products->fetch_assoc()) {
            $array[] = array("id" => $row["id"], "productName" => $row["name"]);
        }
    } else {
        echo "0 results";
    }
    $db->close();

    return $array;
}

$products = getProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="container mt-5 w-80">
<div class="row">
    <div class="col">
        <h2 class="mb-3">Formulari</h2>

        <form action="ex2AddEdit.php" method="POST">
            <div class="form-group mb-2">
                <input type="text" class="form-control" id="productName" name="productName" placeholder="Nom" value="">
            </div>

            <input type="hidden" name="productId" id="productId" value="0"/>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="col">
        <h2 class="mb-3">Llistat</h2>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Edit</th>
                <th scope="col">Remove</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <th scope="row"><?= $product["id"] ?></th>
                    <td><?= $product["productName"] ?></td>
                    <td><p idProd="<?= $product["id"] ?>" class="btnEdit btn btn-outline-info">Edit</p></td>
                    <td><a href="" class="btn btn-outline-danger">Remove</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    let btnEdit = document.querySelectorAll(".btnEdit");
    btnEdit.forEach(el => {
        el.addEventListener("click", function () {

            let formData = new FormData();
            formData.append("id", this.getAttribute("idProd"));

            let options = {
                method: 'POST',
                body: formData
            }

            fetch("getProducte.php", options)
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    document.getElementById("productName").value = data.name;
                    document.getElementById("productId").value = data.id;
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

        })
    })
</script>
</body>
</html>