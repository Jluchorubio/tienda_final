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

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Factura <?= $factura['id'] ?></title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        padding: 20px;
        color: #333;
    }

    .factura-container {
        width: 900px;
        margin: auto;
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 10px;
        color: #2c3e50;
    }

    .info-box {
        background: #ecf0f1;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .info-box p {
        margin: 5px 0;
        font-size: 16px;
    }

    .btn {
        display: inline-block;
        background: #3498db;
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 6px;
        margin-bottom: 15px;
    }

    .btn:hover {
        background: #2980b9;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        background: white;
    }

    table th {
        background: #3498db;
        color: white;
        padding: 12px;
        text-align: left;
    }

    table td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background: #f1f9ff;
    }

    .acciones a {
        margin-right: 8px;
        text-decoration: none;
        color: #2980b9;
        font-weight: bold;
    }

    .acciones a:hover {
        text-decoration: underline;
    }

    .total-box {
        margin-top: 20px;
        font-size: 20px;
        text-align: right;
        font-weight: bold;
        color: #2c3e50;
    }

    .back-btn {
        margin-top: 20px;
        display: inline-block;
        background: #95a5a6;
        color: white;
        padding: 10px 15px;
        border-radius: 6px;
        text-decoration: none;
    }

    .back-btn:hover {
        background: #7f8c8d;
    }
</style>
</head>
<body>

<div class="factura-container">

    <h1>Factura #<?= $factura['id']; ?></h1>

    <div class="info-box">
        <p><strong>Cliente:</strong> <?= $factura['cliente']; ?></p>
        <p><strong>Fecha:</strong> <?= $factura['fecha']; ?></p>
        <p><strong>Total actual:</strong> $<?= number_format($factura['total'], 2); ?></p>
    </div>

    <a class="btn" href="create.php?factura_id=<?= $factura_id; ?>">+ Agregar Producto</a>

    <table>
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
                <td class="acciones">
                    <a href="edit.php?id=<?= $d['id']; ?>">Editar</a>
                    <a href="delete.php?id=<?= $d['id']; ?>&factura_id=<?= $factura_id; ?>"
                       onclick="return confirm('¿Eliminar detalle?');">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <div class="total-box">
        Total: $<?= number_format($factura['total'], 2); ?>
    </div>

    <a href="../templates/index.php?page=factura_list" class="back-btn">← Volver</a>

</div>

</body>
</html>
