<?php
include __DIR__ . "/../config/conexion.php";

$id = $_GET['id'];

// Eliminar detalles primero
$stmt = $conexion->prepare("DELETE FROM detalle_factura WHERE factura_id = ?");
$stmt->execute([$id]);

// Luego la factura
$stmt = $conexion->prepare("DELETE FROM factura WHERE id = ?");
$stmt->execute([$id]);

header("Location: list.php");
exit();
