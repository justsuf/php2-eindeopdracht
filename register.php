<?php
require __DIR__ . '/includes/db.php';
require __DIR__ . '/classes/user.php';
$error = '';

if (isset($_POST['register'])) {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $user = new User($username, $email, $password);
    if ($user->register($conn)) {
        header('Location: login.php');
        exit;
    }

    $error = 'Email bestaat al!';
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<h2>Registreren</h2>
<?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form method="POST">
    <input type="text" name="username" class="form-control mb-3" placeholder="Gebruikersnaam" required>
    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Wachtwoord" required>
    <button type="submit" name="register" class="btn btn-primary">
        Registreren
    </button>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>