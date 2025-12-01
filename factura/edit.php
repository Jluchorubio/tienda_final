<?php
include __DIR__ . "/../config/conexion.php";

$id = $_GET['id'];

$stmt = $conexion->prepare("
    SELECT id, cliente_id
    FROM factura
    WHERE id = ?
");
$stmt->execute([$id]);
$factura = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conexion->query("SELECT id, nombre FROM clientes ORDER BY nombre");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Editar factura #<?= $factura['id']; ?></h1>

<form action="/tienda_final/factura/update.php" method="POST">
    <input type="hidden" name="id" value="<?= $factura['id']; ?>">

    <label>Cliente:</label>
    <select name="cliente_id">
        <?php foreach ($clientes as $c) { ?>
            <option value="<?= $c['id']; ?>" <?= $c['id'] == $factura['cliente_id'] ? "selected" : "" ?>>
                <?= $c['nombre']; ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="index.php?page=factura_list">Volver</a>
