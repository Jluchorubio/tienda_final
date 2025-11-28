<?php
include("../conexion.php");

$id       = $_POST['id'];
$cantidad = $_POST['cantidad'];
$precio   = $_POST['precio'];
$subtotal = $cantidad * $precio;

$sql = "UPDATE detalle_factura 
        SET cantidad = $cantidad,
            precio = $precio,
            subtotal = $subtotal
        WHERE id = $id";

$conexion->query($sql);

// Necesitamos el factura_id para regresar al listado
$get_factura = $conexion->query("SELECT factura_id FROM detalle_factura WHERE id = $id")->fetch_assoc();
$factura_id = $get_factura['factura_id'];

header("Location: list.php?factura_id=$factura_id");
exit();
