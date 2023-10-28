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
    $productId = $_POST['product_id'];
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
    $sql = "UPDATE products
            SET name = :name, slug = :slug, primary_image = :primaryImage, description = :description,
                is_active = :isActive, delivery_amount = :deliveryAmount, delivery_amount_per_product = :deliveryAmountPerProduct,
                brand_id = :brandId, category_id = :categoryId, price = :price, quantity = :quantity, sku = :sku,
                sale_price = :salePrice, date_on_sale_from = :dateOnSaleFrom, date_on_sale_to = :dateOnSaleTo
            WHERE id = :productId";
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
    $stmt->bindParam(':productId', $productId);

    // Execute the statement
    try {
        $stmt->execute();
        echo "Product updated successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST">
        <input type="hidden" name="product_id" value="<?php echo $_GET['id']; ?>">

        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>

        <label>Slug:</label>
        <input type="text" name="slug" value="<?php echo $product['slug']; ?>" required><br>

        <label>Primary Image:</label>
        <input type="text" name="primary_image" value="<?php echo $product['primary_image']; ?>" required><br>

        <label>Description:</label>
        <textarea name="description" required><?php echo $product['description']; ?></textarea><br>

        <label>Is Active:</label>
        <input type="checkbox" name="is_active" value="1" <?php echo $product['is_active'] ? 'checked' : ''; ?>><br>

        <label>Delivery Amount:</label>
        <input type="number" name="delivery_amount" value="<?php echo $product['delivery_amount']; ?>" required><br>

        <label>Delivery Amount per Product:</label>
        <input type="number" name="delivery_amount_per_product" value="<?php echo $product['delivery_amount_per_product']; ?>"><br>

        <label>Brand ID:</label>
        <input type="number" name="brand_id" value="<?php echo $product['brand_id']; ?>" required><br>

        <label>Category ID:</label>
        <input type="number" name="category_id" value="<?php echo $product['category_id']; ?>" required><br>

        <label>Price:</label>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" required><br>

        <label>Quantity:</label>
        <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required><br>

        <label>SKU:</label>
        <input type="text" name="sku" value="<?php echo $product['sku']; ?>"><br>

        <label>Sale Price:</label>
        <input type="number" name="sale_price" value="<?php echo $product['sale_price']; ?>"><br>

        <label>Date on Sale From:</label>
        <input type="datetime-local" name="date_on_sale_from" value="<?php echo $product['date_on_sale_from']; ?>"><br>

        <label>Date on Sale To:</label>
        <input type="datetime-local" name="date_on_sale_to" value="<?php echo $product['date_on_sale_to']; ?>"><br>

        <input type="submit" value="Update Product">
    </form>
</body>
</html>