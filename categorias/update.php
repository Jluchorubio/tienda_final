<?php
include __DIR__ . '/../config/conexion.php';

$id = $_POST['id'] ?? null;
$nombre = trim($_POST['nombre'] ?? '');

if (!$id || $nombre === '') {
    die("Datos inválidos");
}

$stmt = $pdo->prepare("UPDATE categorias SET nombre = :nombre WHERE id = :id");
$stmt->execute([
    ':nombre' => $nombre,
    ':id' => $id
]);

header("Location: list.php");
exit;
