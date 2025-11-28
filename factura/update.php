<?php
include __DIR__ . "/../config/conexion.php";

$id = $_POST['id'];
$cliente_id = $_POST['cliente_id'];

$sql = "UPDATE factura SET cliente_id = ? WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$cliente_id, $id]);

header("Location: list.php");
exit();
