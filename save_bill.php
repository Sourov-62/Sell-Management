<?php
include 'dbconn.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data from the POST request
    $customer_name = $_POST['customerName'];
    $email = $_POST['email'] ?? null;
    $address = $_POST['address'] ?? null;
    $total_bill = $_POST['totalBill'];
    $vat_percentage = $_POST['vatPercentage'];
    $discount_percentage = $_POST['discount'];
    $net_balance = $_POST['finalNetBalance'];
    $cash_paid = $_POST['cash'];
    $change_due = $_POST['change'];
    $created_at = date("Y-m-d H:i:s"); // Current date and time

    // Insert data into the 'sell_info' table
    $sql = "INSERT INTO sell_info (customer_name, email, address, total_bill, vat_percentage, discount_percentage, net_balance, cash_paid, change_due, created_at) 
            VALUES ('$customer_name', '$email', '$address', '$total_bill', '$vat_percentage', '$discount_percentage', '$net_balance', '$cash_paid', '$change_due', '$created_at')";

if (mysqli_query($link, $sql)) {
    // Send a success response
    echo json_encode(['success' => true]);
} else {
    // Send an error response
    echo json_encode(['success' => false, 'message' => mysqli_error($link)]);
}

    // Close the database connection
    mysqli_close($link);
}
?>
