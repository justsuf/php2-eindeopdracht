<?php
require __DIR__ . '/includes/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

// Haal één project op voor de detailpagina.
$stmt = $conn->prepare("SELECT id, user_id AS user_id, naam AS title, beschrijving AS description, status AS category, project_datum AS date, aangemaakt_op FROM projecten WHERE id = ?");
$stmt->execute([$id]);
$project = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$project) {
    include __DIR__ . '/includes/header.php';
    echo '<div class="alert alert-warning">Project niet gevonden.</div>';
    include __DIR__ . '/includes/footer.php';
    exit;
}

include __DIR__ . '/includes/header.php';
?>
<div class="card p-4">
    <h1><?= htmlspecialchars($project['title']) ?></h1>
    <p><?= nl2br(htmlspecialchars($project['description'])) ?></p>
    <p><strong>Categorie:</strong> <?= htmlspecialchars($project['category']) ?></p>
    <p><strong>Datum:</strong> <?= htmlspecialchars($project['date']) ?></p>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>