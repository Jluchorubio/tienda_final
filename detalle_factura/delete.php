<?php
include __DIR__ . "/../config/conexion.php";
include "actualizar_total.php";

$id = $_GET['id'];
$factura_id = $_GET['factura_id'];

// Eliminar detalle
$stmt = $conexion->prepare("DELETE FROM detalle_factura WHERE id = ?");
$stmt->execute([$id]);

// Actualizar total
actualizarTotalFactura($factura_id, $conexion);

header("Location: list.php?factura_id=$factura_id");
exit();
