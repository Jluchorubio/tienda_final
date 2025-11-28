<?php
include __DIR__ . "/../config/conexion.php";

$id = $_GET['id'];

$factura = $conexion->query("SELECT * FROM factura WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
$clientes = $conexion->query("SELECT id, nombre FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Editar Factura</h1>

<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $factura['id']; ?>">

    <label>Cliente:</label>
    <select name="cliente_id" required>
        <?php foreach ($clientes as $c) { ?>
            <option value="<?php echo $c['id']; ?>" 
                <?php echo ($c['id'] == $factura['cliente_id']) ? 'selected' : ''; ?>>
                <?php echo $c['nombre']; ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="list.php">Volver</a>
