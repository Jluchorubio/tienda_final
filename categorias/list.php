<?php
include __DIR__ . '../../config/conexion.php';

/* ===========================
   VARIABLES DE FILTRO Y ORDEN
   =========================== */

$buscar = $_GET['buscar'] ?? '';
$categoria_filtro = $_GET['categoria'] ?? '';
$order = $_GET['order'] ?? 'ASC';
$nextOrder = $order === 'ASC' ? 'DESC' : 'ASC';

/* ===========================
   CONSULTA BASE
   =========================== */

$sql = "SELECT * FROM categorias WHERE 1";

/* FILTRO DE BUSQUEDA */
if ($buscar !== '') {
    $sql .= " AND nombre LIKE :buscar";
}

/* FILTRO POR CATEGORÍA */
if ($categoria_filtro !== '') {
    $sql .= " AND id = :categoria";
}

/* ORDENAR POR ID */
$sql .= " ORDER BY id $order";

$stmt = $pdo->prepare($sql);

/* PARAMETROS */
if ($buscar !== '') {
    $stmt->bindValue(':buscar', "%$buscar%");
}
if ($categoria_filtro !== '') {
    $stmt->bindValue(':categoria', $categoria_filtro);
}

$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
