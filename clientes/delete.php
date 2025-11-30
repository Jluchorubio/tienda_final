<?php
include __DIR__ . '/../config/conexion.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("UPDATE clientes SET estado = 0 WHERE id = :id");
$stmt->execute(['id' => $id]);

header("Location: ../templates/index.php?page=clientes");
exit;
