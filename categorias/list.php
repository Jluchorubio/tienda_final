<?php
include __DIR__ . '/../config/conexion.php';

$buscar = $_GET['buscar'] ?? '';
$categoria_filtro = $_GET['categoria'] ?? '';

$sql = "SELECT * FROM categorias WHERE 1";

if ($buscar !== '') {
    $sql .= " AND nombre LIKE :buscar";
}

if ($categoria_filtro !== '') {
    $sql .= " AND id = :categoria";
}

$stmt = $pdo->prepare($sql);

if ($buscar !== '') {
    $stmt->bindValue(':buscar', "%$buscar%");
}
if ($categoria_filtro !== '') {
    $stmt->bindValue(':categoria', $categoria_filtro);
}

$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
