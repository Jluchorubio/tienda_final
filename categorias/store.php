<?php
include __DIR__ . '/../config/conexion.php';

$nombre = trim($_POST['nombre'] ?? '');

if ($nombre === '') {
    die("El nombre es obligatorio.");
}

$stmt = $pdo->prepare("INSERT INTO categorias (nombre) VALUES (:nombre)");
$stmt->execute([':nombre' => $nombre]);

header("Location: list.php");
exit;
