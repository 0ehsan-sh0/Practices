<?php

// Database configuration
$host = 'your_host';
$dbName = 'your_database';
$user = 'your_username';
$password = 'your_password';

// Establish a database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $primaryImage = $_POST['primary_image'];
    $description = $_POST['description'];
    $isActive = $_POST['is_active'];
    $deliveryAmount = $_POST['delivery_amount'];
    $deliveryAmountPerProduct = $_POST['delivery_amount_per_product'];
    $brandId = $_POST['brand_id'];
    $categoryId = $_POST['category_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $sku = $_POST['sku'];
    $salePrice = $_POST['sale_price'];
    $dateOnSaleFrom = $_POST['date_on_sale_from'];
    $dateOnSaleTo = $_POST['date_on_sale_to'];

    // Prepare the SQL statement
    $sql = "INSERT INTO products (name, slug, primary_image, description, is_active, delivery_amount,
            delivery_amount_per_product category_id,brand_id, price, quantity, sku, sale_price, date_on_sale_from,
            date_on_sale_to)
            VALUES (:name, :slug, :primaryImage, :description, :isActive, :deliveryAmount, 
            :deliveryAmountPerProduct,:brandId,
            :categoryId, :price, :quantity, :sku, :salePrice, :dateOnSaleFrom, :dateOnSaleTo)";
    $stmt = $pdo->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':primaryImage', $primaryImage);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':isActive', $isActive);
    $stmt->bindParam(':deliveryAmount', $deliveryAmount);
    $stmt->bindParam(':deliveryAmountPerProduct', $deliveryAmountPerProduct);
    $stmt->bindParam(':brandId', $brandId);
    $stmt->bindParam(':categoryId', $categoryId);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':sku', $sku);
    $stmt->bindParam(':salePrice', $salePrice);
    $stmt->bindParam(':dateOnSaleFrom', $dateOnSaleFrom);
    $stmt->bindParam(':dateOnSaleTo', $dateOnSaleTo);

    // Execute the statement
    try {
        $stmt->execute();
        echo "Product inserted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
</head>

<body>
    <h1>Add Product</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Slug:</label>
        <input type="text" name="slug" required><br>

        <label>Primary Image:</label>
        <input type="text" name="primary_image" required><br>

        <label>Description:</label>
        <textarea name="description" required></textarea><br>

        <label>Is Active:</label>
        <input type="checkbox" name="is_active" value="1" checked><br>

        <label>Delivery Amount:</label>
        <input type="number" name="delivery_amount" required><br>

        <label>Delivery Amount Per Product:</label>
        <input type="number" name="delivery_amount_per_product" required><br>

        <label>Brand ID:</label>
        <input type="text" name="brand_id" required><br>

        <label>Category ID:</label>
        <input type="text" name="category_id" required><br>

        <label>Price:</label>
        <input type="number" name="price" required><br>

        <label>Quantity:</label>
        <input type="number" name="quantity" required><br>

        <label>SKU:</label>
        <input type="text" name="sku"><br>

        <label>Sale Price:</label>
        <input type="number" name="sale_price"><br>

        <label>Date on Sale From:</label>
        <input type="datetime-local" name="date_on_sale_from"><br>

        <label>Date on Sale To:</label>
        <input type="datetime-local" name="date_on_sale_to"><br>
    </form>
</body>

</html>