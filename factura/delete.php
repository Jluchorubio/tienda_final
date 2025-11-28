<?php
include __DIR__ . "/../config/conexion.php";

$id = $_GET['id'];

// Primero borrar los detalles
$conexion->prepare("DELETE FROM detalle_factura WHERE factura_id = ?")->execute([$id]);

// Borrar la factura
$conexion->prepare("DELETE FROM factura WHERE id = ?")->execute([$id]);

header("Location: list.php");
exit();
