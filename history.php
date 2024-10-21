<?php 
include 'dbconn.php'; // Include database connection

// Fetch all sell records from sell_info table
$sellQuery = "SELECT * FROM sell_info";
$sellResult = mysqli_query($link, $sellQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales History - SuperShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>Sales History</h1>

    <?php if (mysqli_num_rows($sellResult) > 0) { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sale ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Total Bill</th>
                    <th>VAT (%)</th>
                    <th>Discount (%)</th>
                    <th>Final Net Balance</th>
                    <th>Cash Paid</th>
                    <th>Change</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($sellResult)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['customer_name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><?= $row['total_bill'] ?></td>
                        <td><?= $row['vat_percentage'] ?>%</td>
                        <td><?= $row['discount_percentage'] ?>%</td>
                        <td><?= $row['net_balance'] ?></td>
                        <td><?= $row['cash_paid'] ?></td>
                        <td><?= $row['change_due'] ?></td>
                        <td><?= $row['created_at'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No sales data available.</p>
    <?php } ?>
</div>

</body>
</html>
