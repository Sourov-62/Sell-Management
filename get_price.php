<?php
include 'dbconn.php';

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $priceQuery = "SELECT product_price FROM products WHERE product_id = $productId";
    $priceResult = mysqli_query($link, $priceQuery);
    $priceRow = mysqli_fetch_assoc($priceResult);

    echo $priceRow['product_price']; // Return the price for the selected product
}
?>
