<?php
include __DIR__ . "/../config/conexion.php";

// Traer facturas con el nombre del cliente
$sql = "SELECT factura.*, clientes.nombre AS cliente 
        FROM factura
        INNER JOIN clientes ON factura.cliente_id = clientes.id";

$resultado = $conexion->query($sql);
?>

<h1>Listado de Facturas</h1>

<a href="create.php">Crear nueva factura</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Total</th>
        <th>Detalles</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($resultado as $fila) { ?>
        <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['cliente']; ?></td>
            <td><?php echo $fila['fecha']; ?></td>
            <td><?php echo $fila['total']; ?></td>

            <td>
                <a href="../detalle_factura/list.php?factura_id=<?php echo $fila['id']; ?>">
                    Ver detalles
                </a>
            </td>

            <td>
                <a href="edit.php?id=<?php echo $fila['id']; ?>">Editar</a> |
                <a href="delete.php?id=<?php echo $fila['id']; ?>">Eliminar</a>
            </td>
        </tr>
    <?php } ?>
</table>
