<?php
include __DIR__ . "/../config/conexion.php";

if (!isset($_GET['factura_id'])) {
    die("Error: No se proporcionó factura_id");
}

$factura_id = $_GET['factura_id'];

// Obtener datos de la factura
$stmt = $conexion->query("
    SELECT f.id, f.fecha, f.total, c.nombre AS cliente
    FROM factura f
    INNER JOIN clientes c ON f.cliente_id = c.id
    WHERE f.id = $factura_id
");
$factura = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener detalles
$stmt2 = $conexion->query("
    SELECT df.id, p.nombre AS producto, df.cantidad, df.precio, df.subtotal
    FROM detalle_factura df
    INNER JOIN productos p ON df.producto_id = p.id
    WHERE df.factura_id = $factura_id
");
$detalles = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Detalles de la factura #<?= $factura['id']; ?></h1>
<p>Cliente: <?= $factura['cliente']; ?></p>
<p>Fecha: <?= $factura['fecha']; ?></p>
<p>Total actual: $<?= number_format($factura['total'], 2); ?></p>

<a href="create.php?factura_id=<?= $factura_id; ?>">Agregar detalle</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Subtotal</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($detalles as $d) { ?>
        <tr>
            <td><?= $d['id']; ?></td>
            <td><?= $d['producto']; ?></td>
            <td><?= $d['cantidad']; ?></td>
            <td>$<?= $d['precio']; ?></td>
            <td>$<?= $d['subtotal']; ?></td>
            <td>
                <a href="edit.php?id=<?= $d['id']; ?>">Editar</a> |
                <a href="delete.php?id=<?= $d['id']; ?>&factura_id=<?= $factura_id; ?>"
                   onclick="return confirm('¿Eliminar detalle?');">Eliminar</a>
            </td>
        </tr>
    <?php } ?>
</table>

<br>
<a href="../factura/list.php">Volver a facturas</a>
