<?php
include __DIR__ . "/../config/conexion.php";
include "actualizar_total.php";

$id       = $_POST['id'];
$cantidad = $_POST['cantidad'];
$precio   = $_POST['precio'];
$subtotal = $cantidad * $precio;

// Actualizar detalle
$stmt = $conexion->prepare("
    UPDATE detalle_factura
    SET cantidad = ?, precio = ?, subtotal = ?
    WHERE id = ?
");
$stmt->execute([$cantidad, $precio, $subtotal, $id]);

// Obtener factura_id
$stmt2 = $conexion->prepare("SELECT factura_id FROM detalle_factura WHERE id = ?");
$stmt2->execute([$id]);
$factura_id = $stmt2->fetch(PDO::FETCH_ASSOC)['factura_id'];

// Actualizar total
actualizarTotalFactura($factura_id, $conexion);

header("Location: list.php?factura_id=$factura_id");
exit();
