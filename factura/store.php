<?php
include __DIR__ . "/../config/conexion.php";

$cliente_id = $_POST['cliente_id'];

$sql = "INSERT INTO factura (cliente_id, total) VALUES (?, 0)";
$stmt = $conexion->prepare($sql);
$stmt->execute([$cliente_id]);

// Obtener ID de la factura recién creada
$factura_id = $conexion->lastInsertId();

// Enviar a detalle_factura para agregar productos
header("Location: ../detalle_factura/list.php?factura_id=$factura_id");
exit();
