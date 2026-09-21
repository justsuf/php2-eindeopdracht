<?php
require __DIR__ . '/includes/db.php';
require __DIR__ . '/classes/project.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Alleen ingelogde gebruikers mogen projecten toevoegen.
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$error = '';
$title = '';
$description = '';
$category = '';
$date = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $date = trim($_POST['date'] ?? '');

    // Toon een foutmelding voordat er een databasebewerking wordt uitgevoerd.
    if ($title === '' || $description === '' || $category === '' || $date === '') {
        $error = 'Vul alle velden in.';
    } else {
        $project = new Project($title, $description, $date, $category);

        if ($project->save($conn, $_SESSION['user_id'])) {
            header('Location: dashboard.php');
            exit;
        }
        $error = 'Kon het project niet opslaan. Probeer het opnieuw.';
    }
}
include __DIR__ . '/includes/header.php';
?>
<h1>Project toevoegen</h1>
<?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form method="POST">
    <div class="mb-3">
        <label for="title" class="form-label">Titel</label>
        <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($title) ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Beschrijving</label>
        <textarea id="description" name="description" rows="5" class="form-control" required><?= htmlspecialchars($description) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Categorie</label>
        <input type="text" id="category" name="category" class="form-control" value="<?= htmlspecialchars($category) ?>" required>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Datum</label>
        <input type="date" id="date" name="date" class="form-control" value="<?= htmlspecialchars($date) ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Opslaan</button>
    <a href="dashboard.php" class="btn btn-secondary">Annuleren</a>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>