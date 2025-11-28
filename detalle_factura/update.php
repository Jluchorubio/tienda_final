<?php
include("../conexion.php");

$id         = $_POST['id'];
$factura_id = $_POST['factura_id'];
$producto_id = $_POST['producto_id'];
$cantidad   = $_POST['cantidad'];

// 1. Obtener el precio real del producto
$producto = $conexion->query("SELECT precio FROM productos WHERE id = $producto_id")->fetch_assoc();
$precio = $producto['precio'];

// 2. Recalcular subtotal
$subtotal = $precio * $cantidad;

// 3. Actualizar el detalle de factura
$sql = "UPDATE detalle_factura 
        SET producto_id = $producto_id,
            cantidad = $cantidad,
            precio = $precio,
            subtotal = $subtotal
        WHERE id = $id";
$conexion->query($sql);

// 4. Actualizar total de la factura
$conexion->query("
    UPDATE factura 
    SET total = (SELECT IFNULL(SUM(subtotal),0) FROM detalle_factura WHERE factura_id = $factura_id)
    WHERE id = $factura_id
");

header("Location: list.php?factura_id=$factura_id");
exit();
