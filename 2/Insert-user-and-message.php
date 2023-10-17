<?php
// Database connection settings
$host = 'localhost';
$dbName = 'your_database_name';
$user = 'your_username';
$password = 'your_password';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $password);

    // Insert a user
    $userData = [
        'name' => 'ehsan',
        'last_name' => 'shariaty',
        'email' => 'ehsan@example.com',
        'username' => 'ehsansh',
        'password' => 'password123'
    ];

    $insertUserQuery = "INSERT INTO users (name, last_name, email, username, password)
                        VALUES (:name, :last_name, :email, :username, :password)";

    $insertUserStmt = $pdo->prepare($insertUserQuery);
    $insertUserStmt->execute($userData);
    $userId = $pdo->lastInsertId();

    echo "User inserted successfully. ID: $userId<br>";

    // Insert a message
    $messageData = [
        'title' => 'Hello',
        'description' => 'This is a test message',
        'email' => 'ehsan@example.com'
    ];

    $insertMessageQuery = "INSERT INTO messages (title, description, email)
                           VALUES (:title, :description, :email)";

    $insertMessageStmt = $pdo->prepare($insertMessageQuery);
    $insertMessageStmt->execute($messageData);
    $messageId = $pdo->lastInsertId();

    echo "Message inserted successfully. ID: $messageId<br>";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>