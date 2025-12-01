<?php
include __DIR__ . "/../config/conexion.php";

$id = $_GET['id'] ?? null;

if ($id) {

    // PRIMERO BORRAR LOS DETALLES
    $stmt = $conexion->prepare("DELETE FROM detalle_factura WHERE factura_id = ?");
    $stmt->execute([$id]);

    // AHORA BORRAR LA FACTURA
    $stmt2 = $conexion->prepare("DELETE FROM factura WHERE id = ?");
    $stmt2->execute([$id]);

    header("Location: ../templates/index.php?page=factura_list&deleted=1");
    exit;
}

header("Location: ../templates/index.php?page=factura_list&error=1");
exit;
