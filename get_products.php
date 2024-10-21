<?php
include 'dbconn.php'; // Include database connection

if (isset($_POST['category_id'])) {
    $categoryId = $_POST['category_id'];
    
    // Fetch products from the 'products' table based on category
    $productQuery = "SELECT product_id, product_title FROM products WHERE cat_id = ?";
    $stmt = $link->prepare($productQuery);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate options for the products dropdown
    if ($result->num_rows > 0) {
        while ($product = $result->fetch_assoc()) {
            echo "<option value='{$product['product_id']}'>{$product['product_title']}</option>";
        }
    } else {
        echo "<option value=''>No products available</option>";
    }

    $stmt->close();
}
?>
