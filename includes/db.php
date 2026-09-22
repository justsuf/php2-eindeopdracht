<?php
$host = 'localhost';
$databaseName = 'portfolio';
$username = 'root';
$password = '';
// connect aan de database met PDO
try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$databaseName;charset=utf8",
        $username,
        $password
    );

    // Stel PDO in om fouten als uitzonderingen te melden
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}