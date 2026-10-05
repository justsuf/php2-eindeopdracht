<?php
require __DIR__ . '/includes/db.php';
require __DIR__ . '/classes/user.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $user = new User($conn);
    if ($user->register($username, $email, $password)) {
        header('Location: login.php');
        exit;
    }

    $error = 'Registratie mislukt. Controleer je gegevens; het e-mailadres is mogelijk al in gebruik.';
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<h2>Registreren</h2>
<?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form action="register.php" method="POST">
    <input type="text" name="username" class="form-control mb-3" placeholder="Gebruikersnaam" required>
    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Wachtwoord" required>
    <button type="submit" class="btn btn-primary">
        Registreren
    </button>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>