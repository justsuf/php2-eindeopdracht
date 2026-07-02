<?php
require __DIR__ . '/includes/db.php';
require __DIR__ . '/classes/project.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: dashboard.php');
    exit;
}
if (Project::delete($conn, $id, $_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
$error = 'Kon het project niet verwijderen.';
include __DIR__ . '/includes/header.php';
?>
<h1>Project verwijderen</h1>
<div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<a href="dashboard.php" class="btn btn-secondary">Terug naar dashboard</a>
<?php include __DIR__ . '/includes/footer.php'; ?>
