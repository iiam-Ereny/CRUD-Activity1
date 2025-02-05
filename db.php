<?php
$host = 'localhost';  // Change this to your database host if different
$dbname = 'manga_db'; // Replace with your database name
$username = 'root';   // Replace with your MySQL username
$password = '';       // Replace with your MySQL password (if any)

try {
    // Create PDO instance for database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error reporting
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>
