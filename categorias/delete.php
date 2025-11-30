<?php
include __DIR__ . '/../config/conexion.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: ../templates/index.php?page=categorias");
    exit;
}

try {
    $sql = "DELETE FROM categorias WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    header("Location: ../templates/index.php?page=categorias&msg=deleted");
} catch (PDOException $e) {
    header("Location: ../templates/index.php?page=categorias&error=foreign_key");
}
exit;
