<?php
session_start();
require __DIR__ . '/includes/db.php';
require __DIR__ . '/classes/Project.php';

// Bescherm het dashboard tegen bezoekers die niet zijn ingelogd.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$projecten = Project::getByUsersId($conn, $_SESSION['user_id']);
include __DIR__ . '/includes/header.php';
?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <p class="text-uppercase small fw-bold text-secondary mb-2">Beheer</p>
        <h1 class="mb-0">Mijn projecten</h1>
    </div>
    <a href="add-project.php" class="btn btn-success">Project toevoegen</a>
</div>
<div class="table-responsive">
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
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>