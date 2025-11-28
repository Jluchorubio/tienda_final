<?php
include("../conexion.php");

$factura_id  = $_POST['factura_id'];
$producto_id = $_POST['producto_id'];
$cantidad    = $_POST['cantidad'];
$precio      = $_POST['precio'];

$subtotal = $cantidad * $precio;

$sql = "INSERT INTO detalle_factura (factura_id, producto_id, cantidad, precio, subtotal)
        VALUES ($factura_id, $producto_id, $cantidad, $precio, $subtotal)";

$conexion->query($sql);

header("Location: list.php?factura_id=$factura_id");
exit();