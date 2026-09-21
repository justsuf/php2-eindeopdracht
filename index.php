<?php
require __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/header.php';

// Filter projecten op categorie wanneer die via de URL is meegegeven.
$category = $_GET['category'] ?? '';
if ($category) {
    $stmt = $conn->prepare("SELECT id, naam AS title, beschrijving AS description, status AS category, project_datum AS date FROM projecten WHERE status = ?");
    $stmt->execute([$category]);
} else {
    $stmt = $conn->query("SELECT id, naam AS title, beschrijving AS description, status AS category, project_datum AS date FROM projecten");
}
$projecten = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Publieke projectoverzichtspagina -->
<div class="mb-4">
    <p class="text-uppercase small fw-bold text-secondary mb-2">Portfolio</p>
    <h1>Projecten met een verhaal</h1>
    <p class="lead text-secondary">Bekijk het werk, de ideeën en de projecten uit mijn portfolio.</p>
</div>
<div class="row">
    <?php foreach ($projecten as $project): ?>
        <div class="col-md-4 mb-3">
            <div class="card project-card p-3 h-100">
                <h3><?= htmlspecialchars($project['title']) ?></h3>
                <p class="project-description"><?= nl2br(htmlspecialchars($project['description'])) ?></p>
                <p class="project-meta">
                    <span><?= htmlspecialchars($project['category']) ?></span>
                    <span><?= htmlspecialchars($project['date']) ?></span>
                </p>
                <a href="project.php?id=<?= $project['id'] ?>" class="btn btn-dark mt-auto">
                    Bekijk
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>