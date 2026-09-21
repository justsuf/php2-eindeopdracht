<?php
$host = 'localhost';
$databaseName = 'portfolio';
$username = 'root';
$password = '';

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$databaseName;charset=utf8",
        $username,
        $password
    );

    // Laat PDO fouten als uitzonderingen melden, zodat databaseproblemen niet stil blijven.
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}