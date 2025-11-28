<?php
include("../conexion.php");

$id = $_GET['id'];
$factura_id = $_GET['factura_id'];

$sql = "DELETE FROM detalle_factura WHERE id = $id";
$conexion->query($sql);

header("Location: list.php?factura_id=$factura_id");
exit();
