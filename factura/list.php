<?php
include __DIR__ . "/../config/conexion.php";

$stmt = $conexion->query("
    SELECT f.id, f.fecha, f.total, c.nombre AS cliente
    FROM factura f
    INNER JOIN clientes c ON f.cliente_id = c.id
    ORDER BY f.id DESC
");
$facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Listado de facturas</h1>
<a href="create.php">Crear nueva factura</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Total</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($facturas as $f) { ?>
        <tr>
            <td><?= $f['id']; ?></td>
            <td><?= $f['cliente']; ?></td>
            <td><?= $f['fecha']; ?></td>
            <td>$<?= number_format($f['total'], 2); ?></td>
            <td>
                <a href="../detalle_factura/list.php?factura_id=<?= $f['id']; ?>">Ver detalles</a>
                <a href="delete.php?id=<?= $f['id']; ?>" onclick="return confirm('¿Eliminar factura?');">Eliminar</a>
            </td>
        </tr>
    <?php } ?>
</table>
