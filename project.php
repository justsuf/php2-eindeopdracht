<?php
require __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/header.php';
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}
$stmt = $conn->prepare("SELECT id, user_id AS user_id, naam AS title, beschrijving AS description, status AS category, project_datum AS date, aangemaakt_op FROM projecten WHERE id = ?");
$stmt->execute([$id]);
$project = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$project) {
    echo '<div class="alert alert-warning">Project niet gevonden.</div>';
    include __DIR__ . '/includes/footer.php';
    exit;
}
?>
<div class="card p-4">
    <h1><?= htmlspecialchars($project['title']) ?></h1>
    <p><?= nl2br(htmlspecialchars($project['description'])) ?></p>
    <p><strong>Categorie:</strong> <?= htmlspecialchars($project['category']) ?></p>
    <p><strong>Datum:</strong> <?= htmlspecialchars($project['date']) ?></p>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>