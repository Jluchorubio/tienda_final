<?php
include __DIR__ . "/../config/conexion.php";

$cliente_id = $_POST['cliente_id'];

$stmt = $conexion->prepare("INSERT INTO factura (cliente_id) VALUES (?)");
$stmt->execute([$cliente_id]);

$factura_id = $conexion->lastInsertId();

header("Location: ../detalle_factura/list.php?factura_id=$factura_id");
exit();
