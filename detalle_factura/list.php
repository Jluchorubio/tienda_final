<?php
include("../conexion.php");

$factura_id = $_GET['factura_id'];

$sql = "SELECT df.id, p.nombre AS producto, df.cantidad, df.precio, df.subtotal
        FROM detalle_factura df
        JOIN productos p ON df.producto_id = p.id
        WHERE df.factura_id = $factura_id";

$detalles = $conexion->query($sql);
?>

<h1>Detalles de Factura #<?php echo $factura_id; ?></h1>

<a href="create.php?factura_id=<?php echo $factura_id; ?>">Agregar producto</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Subtotal</th>
        <th>Acciones</th>
    </tr>

    <?php while ($d = $detalles->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $d['producto']; ?></td>
            <td><?php echo $d['cantidad']; ?></td>
            <td><?php echo $d['precio']; ?></td>
            <td><?php echo $d['subtotal']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $d['id']; ?>">Editar</a> |
                <a href="delete.php?id=<?php echo $d['id']; ?>&factura_id=<?php echo $factura_id; ?>"
                   onclick="return confirm('¿Eliminar este detalle?');">
                   Eliminar
                </a>
            </td>
        </tr>
    <?php } ?>
</table>