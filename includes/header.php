<?php
if (session_status() === PHP_SESSION_NONE) {
    // Start de sessie één keer, zodat de navigatie de loginstatus kan lezen.
    session_start();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mijn Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="site-body">
<nav class="navbar navbar-expand-lg site-nav">
    <div class="container">
        <a class="navbar-brand site-brand" href="index.php">
            <span class="brand-mark">MP</span>
            <span>Mijn Portfolio</span>
        </a>
        <div class="nav-links">
            <a href="index.php" class="nav-link">Home</a>
            <!-- Toon andere navigatieopties voor ingelogde gebruikers. -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php" class="nav-link">Dashboard</a>
                <a href="logout.php" class="btn btn-nav">Uitloggen</a>
            <?php else: ?>
                <a href="login.php" class="nav-link">Login</a>
                <a href="register.php" class="btn btn-nav">Registreren</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<main class="container page-content">