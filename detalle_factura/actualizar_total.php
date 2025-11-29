<?php
include __DIR__ . "/../config/conexion.php";

function actualizarTotalFactura($factura_id, $conexion) {
    // Sumar subtotales
    $stmt = $conexion->prepare("
        SELECT SUM(subtotal) AS total
        FROM detalle_factura
        WHERE factura_id = ?
    ");
    $stmt->execute([$factura_id]);

    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

    // Actualizar factura
    $stmt2 = $conexion->prepare("
        UPDATE factura
        SET total = ?
        WHERE id = ?
    ");
    $stmt2->execute([$total, $factura_id]);
}
