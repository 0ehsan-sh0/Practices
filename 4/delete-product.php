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
    $id = $_POST['id'];

    // Prepare the SQL statement
    $sql = "UPDATE `products` SET `is_deleted`= true WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':id', $id);

    // Execute the statement
    try {
        $stmt->execute();
        echo "Product deleted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Product</title>
</head>
<body>
    <h1>Delete Product</h1>
    <form method="POST">
        <label>ID:</label>
        <input type="text" name="id" required><br>

        <button type="submit">Delete</button>
    </form>
</body>
</html>