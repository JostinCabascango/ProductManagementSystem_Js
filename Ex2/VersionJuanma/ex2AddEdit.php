<?php
    
    $servername = "bbdd.martamillanlom.cat";
    $username = "ddb193275";
    $password = "bbddTest12!%";
    $dbname = "ddb193275";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
        
    if(isset($_POST["nomProducte"]) && !empty($_POST["nomProducte"])){
        if($_POST["productId"]==0){
            $sql = "INSERT INTO productes (productName) VALUES ('" . $_POST["nomProducte"] ."')";
        }else{
            $sql = "UPDATE productes SET productName='" . $_POST["nomProducte"] . "' WHERE id=" . $_POST["productId"];
        }
        

        echo $sql;

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

    }
    
    header('Location: ex2FormLlistat.php');

?>
