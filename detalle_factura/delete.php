<?php
include __DIR__ . "/../config/conexion.php";

$id = $_GET['id'];
$factura_id = $_GET['factura_id'];

// Borrar detalle
$conexion->query("DELETE FROM detalle_factura WHERE id = $id");

// Actualizar total
$conexion->query("
    UPDATE factura
    SET total = (SELECT IFNULL(SUM(subtotal), 0) FROM detalle_factura WHERE factura_id = $factura_id)
    WHERE id = $factura_id
");

header("Location: list.php?factura_id=$factura_id");
exit();

$conexion->query("
    UPDATE factura
    SET total = (SELECT COALESCE(SUM(subtotal), 0) FROM detalle_factura WHERE factura_id = $factura_id)
    WHERE id = $factura_id
");
