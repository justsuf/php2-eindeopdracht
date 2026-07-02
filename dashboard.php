<?php
session_start();
require __DIR__ . '/includes/db.php';
require __DIR__ . '/classes/Project.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$projecten = Project::getByUsersId($conn, $_SESSION['user_id']);
include __DIR__ . '/includes/header.php';
?>
<h1>Dashboard</h1>
<a href="add-project.php" class="btn btn-success mb-3">Project Toevoegen</a>
<table class="table table-striped">
    <tr>
        <th>Titel</th>
        <th>Beschrijving</th>
        <th>Acties</th>
    </tr>
    <?php foreach ($projecten as $project): ?>
        <tr>
            <td><?= htmlspecialchars($project['naam']) ?></td>
            <td><?= htmlspecialchars($project['beschrijving']) ?></td>
            <td>
                <a href="edit-project.php?id=<?= $project['id']; ?>" class="btn btn-warning btn-sm">Bewerken</a>
                <a href="delete-project.php?id=<?= $project['id']; ?>" class="btn btn-danger btn-sm">Verwijderen</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php include __DIR__ . '/includes/footer.php'; ?>