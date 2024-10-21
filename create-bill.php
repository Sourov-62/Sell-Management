<?php 
include 'dbconn.php'; // Include database connection



// Fetch categories from the 'categories' table
$categoryQuery = "SELECT * FROM categories";
$categoryResult = mysqli_query($link, $categoryQuery);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
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

    // Insert data into the sell_info table
    $sql = "INSERT INTO sell_info (customer_name, email, address, total_bill, vat_percentage, discount_percentage, net_balance, cash_paid, change_due, created_at) 
            VALUES ('$customer_name', '$email', '$address', '$total_bill', '$vat_percentage', '$discount_percentage', '$net_balance', '$cash_paid', '$change_due', '$created_at')";

    if (mysqli_query($link, $sql)) {
        echo "Bill created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

    // Close the database connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Bill - SuperShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Styles omitted for brevity */
    </style>
</head>
<body>

<div class="container">
    <h1>Create Bill</h1>

    <!-- Success message -->
    <div id="message" class="alert alert-success" style="display:none;">
        Bill created successfully! You can now print the receipt.
    </div>

    <form id="billForm">
        <div class="form-group">
            <label for="customerName">Customer Name</label>
            <input type="text" name="customerName" id="customerName" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email (optional)</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="address">Address (optional)</label>
            <input type="text" name="address" id="address" class="form-control">
        </div>

        <h4>Products</h4>
        <div id="productContainer"></div>
        <button type="button" id="addProductBtn" class="btn btn-info">Add Product</button>

        <div class="form-row mt-3">
            <div class="col text-right">
                <label for="totalBill">Total Bill</label>
                <input type="text" name="totalBill" id="totalBill" class="form-control" readonly>
            </div>
        </div>

        <div class="payment-section mt-4">
            <h4>Payment Details</h4>
            <div class="form-group">
                <label for="vatPercentage">VAT (%)</label>
                <input type="text" name="vatPercentage" id="vatPercentage" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="discount">Discount (%)</label>
                <input type="text" name="discount" id="discount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="finalNetBalance">Net Balance</label>
                <input type="text" name="finalNetBalance" id="finalNetBalance" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="cash">Cash</label>
                <input type="text" name="cash" id="cash" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="change">Change</label>
                <input type="text" name="change" id="change" class="form-control" readonly>
            </div>
        </div>

        <!-- Submit and print buttons -->
        <button type="submit" id="submitBillBtn" class="btn btn-primary">Submit Bill</button>
        <button type="button" id="printReceiptBtn" class="btn btn-secondary" style="display:none;">Print Receipt</button>
    </form>
</div>

<script>
// Function to add a new product row
function addProductRow() {
    const productRow = 
        `<div class="product-row mb-3">
            <div class="form-row align-items-end">
                <div class="col">
                    <label for="category">Select Category</label>
                    <select name="category_id[]" class="form-control category" required>
                        <option value="">Choose a category</option>
                        <?php while ($row = mysqli_fetch_assoc($categoryResult)) { ?>
                            <option value="<?= $row['cat_id'] ?>"><?= $row['cat_title'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <label for="product">Select Product</label>
                    <select name="product_id[]" class="form-control product" required disabled>
                        <option value="">Choose a product</option>
                    </select>
                </div>
                <div class="col">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity[]" class="form-control quantity" value="1" min="1">
                </div>
                <div class="col">
                    <label for="price">Price</label>
                    <input type="text" name="price[]" class="form-control price" readonly>
                </div>
                <div class="col">
                    <label for="totalPrice">Total Price</label>
                    <input type="text" name="totalPrice[]" class="form-control totalPrice" readonly>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger remove-product">Remove</button>
                </div>
            </div>
        </div>`;
    $('#productContainer').append(productRow);
}

$(document).ready(function() {
    addProductRow();

    $('#addProductBtn').click(function() {
        addProductRow();
    });

    $('#productContainer').on('change', '.category', function() {
        var categoryId = $(this).val();
        var productSelect = $(this).closest('.product-row').find('.product');

        if (categoryId) {
            $.ajax({
                type: 'POST',
                url: 'get_products.php',
                data: { category_id: categoryId },
                success: function(response) {
                    productSelect.html(response);
                    productSelect.prop('disabled', false);
                }
            });
        } else {
            productSelect.html('<option value="">Choose a product</option>');
            productSelect.prop('disabled', true);
        }
    });

    $('#productContainer').on('change', '.product', function() {
        var productId = $(this).val();
        var priceInput = $(this).closest('.product-row').find('.price');
        var totalPriceInput = $(this).closest('.product-row').find('.totalPrice');

        if (productId) {
            $.ajax({
                type: 'POST',
                url: 'get_price.php',
                data: { product_id: productId },
                success: function(price) {
                    priceInput.val(price);
                    calculateTotal();
                }
            });
        } else {
            priceInput.val('');
            totalPriceInput.val('');
        }
    });

    $('#productContainer').on('input', '.quantity', function() {
        calculateTotal();
    });

    function calculateTotal() {
        let overallTotal = 0;

        $('.product-row').each(function() {
            const price = parseFloat($(this).find('.price').val()) || 0;
            const quantity = parseInt($(this).find('.quantity').val()) || 0;
            const totalPrice = price * quantity;
            $(this).find('.totalPrice').val(totalPrice.toFixed(2));

            overallTotal += totalPrice;
        });

        $('#totalBill').val(overallTotal.toFixed(2));
        calculateBalance(); // Update net balance after total calculation
    }

    $('#productContainer').on('click', '.remove-product', function() {
        $(this).closest('.product-row').remove();
        calculateTotal();
    });

    // Function to calculate final net balance and change
    function calculateBalance() {
        const totalBill = parseFloat($('#totalBill').val()) || 0;
        const cash = parseFloat($('#cash').val()) || 0;
        const vatPercentage = parseFloat($('#vatPercentage').val()) || 0;
        const discountPercentage = parseFloat($('#discount').val()) || 0;

        const vatAmount = (totalBill * vatPercentage) / 100;
        const discountAmount = (totalBill * discountPercentage) / 100;
        const finalNetBalance = (totalBill + vatAmount - discountAmount).toFixed(2);

        $('#finalNetBalance').val(finalNetBalance);
        const change = (cash - finalNetBalance).toFixed(2);
        $('#change').val(change);
    }

    // Calculate balance on input change
    $('#vatPercentage, #discount').on('input', function() {
        calculateBalance();
    });

    // Calculate balance on cash input change
    $('#cash').on('input', function() {
        calculateBalance();
    });

    // Handle form submission
    $('#billForm').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        $.ajax({
    type: 'POST',
    url: 'save_bill.php',
    data: $(this).serialize(),
    dataType: 'json', // Expecting a JSON response
    success: function(response) {
        if (response.success) {
            // Show success message and enable print button
            $('#message').show();
            $('#printReceiptBtn').show();
            $('#submitBillBtn').prop('disabled', true); // Disable submit after successful submission
        } else {
            // Handle error case
            alert('Error: ' + response.message);
        }
    },
    error: function() {
        // Handle AJAX error
        alert('An error occurred while saving the bill.');
    }
});

    });

// Handle print button click
$('#printReceiptBtn').click(function() {
    // Get the required details
    const customerName = $('#customerName').val();
    const address = $('#address').val();
    const date = new Date().toLocaleString(); // Get the current date and time
    let productDetails = '';

    // Gather product details
    $('.product-row').each(function() {
        const product = $(this).find('.product option:selected').text();
        const quantity = $(this).find('.quantity').val();
        const price = $(this).find('.price').val();
        const totalPrice = $(this).find('.totalPrice').val();
        
        productDetails += `
            <tr>
                <td>${product}</td>
                <td>${quantity}</td>
                <td>${price}</td>
                <td>${totalPrice}</td>
            </tr>`;
    });

    // Create a new window for printing
    const printWindow = window.open('', '_blank', 'width=600,height=400');
    printWindow.document.write(`
        <html>
        <head>
            <title>Print Receipt</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <h1>Receipt</h1>
            <p><strong>Customer Name:</strong> ${customerName}</p>
            <p><strong>Address:</strong> ${address}</p>
            <p><strong>Date:</strong> ${date}</p>
            <h4>Product Details</h4>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    ${productDetails}
                </tbody>
            </table>
            <button onclick="window.print();">Print</button>
        </body>
        </html>
    `);
    printWindow.document.close(); // Close the document for writing
});

});
</script>

</body>
</html>




