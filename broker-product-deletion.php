<?php
session_start();
include 'connection.php';
//check if product ID is provided
if (isset($_GET['id'])){
    $productId = $_GET['id'];

    //prepare and execute SQL query to delete product
    $stmt = $db->prepare("DELETE FROM Product WHERE Product_ID =?");
    $stmt-> execute([$productId]);


    //Redirect back to products page
    header("Location: broker-manage-product.php?success=Product successfully deleted");
    exit();
} else {
    header("Location: broker-manage-product.php?error=Product ID could not be retrieved for product");
    exit();
}




?>