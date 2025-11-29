<?php
include __DIR__ . '/../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../templates/index.php?page=productos');
    exit;
}

$id = $_POST['id'] ?? null;
if (!$id) {
    header('Location: ../templates/index.php?page=productos');
    exit;
}

// borrar imagen si existe
$stmt = $pdo->prepare("SELECT imagen FROM productos WHERE id = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch();
if ($row && !empty($row['imagen'])) {
    $path = __DIR__ . '/../uploads/' . $row['imagen'];
    if (file_exists($path))
        @unlink($path);
}

// borrar registro
$del = $pdo->prepare("DELETE FROM productos WHERE id = :id");
$del->execute([':id' => $id]);

header('Location: ../templates/index.php?page=productos');
exit;
