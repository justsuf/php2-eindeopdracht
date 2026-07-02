<?php
session_start();
require __DIR__ . '/includes/db.php';
require __DIR__ . '/classes/user.php';
if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $user = User::login($conn, $email, $password);

    if ($user) {

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Onjuiste gegevens";
    }
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<h2>Login</h2>
<?php if (isset($error)) : ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form method="POST">
    <input type="email" name="email" class="form-control mb-3" placeholder="E-mail" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Wachtwoord" required>
    <button type="submit" name="login" class="btn btn-success">Inloggen</button>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>