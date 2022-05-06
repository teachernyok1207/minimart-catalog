<?php
require "connection.php";

// To delete selected product on products.php
function deleteProduct($id){  
    // Database Connection
    $conn = connection();

    // SQL
    $sql="DELETE FROM products WHERE `id`=$id";

    // Execution
    if ($result=$conn->query($sql)){
        header("location: products.php");
        exit();
    }else{
        die ("Error Deleting Products: ".$conn->error);
    }
}

$id=$_GET['id'];
deleteProduct($id);
?>