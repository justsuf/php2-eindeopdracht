<?php
require __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/header.php';
$category = $_GET['category'] ?? '';
if ($category) {
    $stmt = $conn->prepare("SELECT id AS user_id, naam AS title, beschrijving AS description, status AS category, project_datum AS date FROM projecten WHERE status = ?");
    $stmt->execute([$category]);
} else {
    $stmt = $conn->query("SELECT id AS user_id, naam AS title, beschrijving AS description, status AS category, project_datum AS date FROM projecten");
}
$projecten = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h1>Mijn Projecten</h1>
<div class="row">
    <?php foreach ($projecten as $project): ?>
        <div class="col-md-4 mb-3">
            <div class="card p-3 h-100">
                <h3><?= htmlspecialchars($project['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($project['description'])) ?></p>
                <p class="text-muted mb-3"><?= htmlspecialchars($project['category']) ?> · <?= htmlspecialchars($project['date']) ?></p>
                <a href="project.php?id=<?= $project['user_id'] ?>" class="btn btn-dark">
                    Bekijk
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>