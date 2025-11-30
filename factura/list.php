<?php
include __DIR__ . "/../config/conexion.php";

/* =============================
   VARIABLES DE FILTRO
============================= */

$buscar = $_GET['buscar'] ?? '';
$cliente_filtro = $_GET['cliente'] ?? '';

/* =============================
   TRAER CLIENTES PARA EL SELECT
============================= */

$stmt = $conexion->query("SELECT id, nombre FROM clientes ORDER BY nombre");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* =============================
   CONSULTA BASE DE FACTURAS
============================= */

$sql = "SELECT f.id, f.fecha, 
               c.nombre AS cliente,
               (SELECT SUM(cantidad * precio) FROM detalle_factura WHERE factura_id = f.id) AS total
        FROM factura f
        INNER JOIN clientes c ON c.id = f.cliente_id
        WHERE 1";

/* Buscar por nombre */
if ($buscar !== '') {
    $sql .= " AND c.nombre LIKE :buscar";
}

/* Filtro por cliente */
if ($cliente_filtro !== '') {
    $sql .= " AND c.id = :cliente";
}

$stmt = $conexion->prepare($sql);

if ($buscar !== '') {
    $stmt->bindValue(':buscar', "%$buscar%");
}

if ($cliente_filtro !== '') {
    $stmt->bindValue(':cliente', $cliente_filtro);
}

$stmt->execute();
$facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* =============================
   CARGAR LA VISTA
============================= */

include __DIR__ . "/../templates/views/factura.php";
