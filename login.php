<?php
require __DIR__ . '/includes/db.php';
require __DIR__ . '/classes/user.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $user = new User($conn);
    if ($user->login($email, $password)) {
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Ongeldige inloggegevens.';
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<h2>Login</h2>
<?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form action="login.php" method="POST">
    <input type="email" name="email" class="form-control mb-3" placeholder="E-mail" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Wachtwoord" required>
    <button type="submit" class="btn btn-success">Inloggen</button>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>