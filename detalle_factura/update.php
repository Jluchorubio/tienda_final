<?php
include __DIR__ . "/../config/conexion.php";

$id         = $_POST['id'];
$factura_id = $_POST['factura_id'];
$producto_id = $_POST['producto_id'];
$cantidad   = $_POST['cantidad'];

// 1. Obtener precio actual del producto
$producto = $conexion->query("SELECT precio FROM productos WHERE id = $producto_id")->fetch_assoc();
$precio = $producto['precio'];

// 2. Calcular subtotal
$subtotal = $precio * $cantidad;

// 3. Actualizar detalle
$conexion->query("
    UPDATE detalle_factura
    SET producto_id = $producto_id,
        cantidad = $cantidad,
        precio = $precio,
        subtotal = $subtotal
    WHERE id = $id
");

// 4. Actualizar total de la factura
$conexion->query("
    UPDATE factura
    SET total = (SELECT IFNULL(SUM(subtotal), 0) 
                 FROM detalle_factura 
                 WHERE factura_id = $factura_id)
    WHERE id = $factura_id
");

header("Location: list.php?factura_id=$factura_id");
exit();

// Recalcular total
$conexion->query("
    UPDATE factura
    SET total = (SELECT SUM(subtotal) FROM detalle_factura WHERE factura_id = $factura_id)
    WHERE id = $factura_id
");
