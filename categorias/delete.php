<?php
include __DIR__ . '/../config/conexion.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ../templates/index.php?page=categorias");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM categorias WHERE id = :id");
$stmt->execute([':id' => $id]);

header("Location: ../templates/index.php?page=categorias");
exit;
