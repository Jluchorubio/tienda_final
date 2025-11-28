<?php
include __DIR__ . "/../config/conexion.php";
include "actualizar_total.php";

$factura_id  = $_POST['factura_id'];
$producto_id = $_POST['producto_id'];
$cantidad    = $_POST['cantidad'];
$precio      = $_POST['precio'];
$subtotal    = $cantidad * $precio;

$stmt = $conexion->prepare("
    INSERT INTO detalle_factura (factura_id, producto_id, cantidad, precio, subtotal)
    VALUES (?, ?, ?, ?, ?)
");
$stmt->execute([$factura_id, $producto_id, $cantidad, $precio, $subtotal]);

// Actualizar total
actualizarTotalFactura($factura_id, $conexion);

header("Location: list.php?factura_id=$factura_id");
exit();
