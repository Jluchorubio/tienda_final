<?php
include("../conexion.php");

$id = $_GET['id'];

// Obtener el detalle de factura
$detalle = $conexion->query("SELECT * FROM detalle_factura WHERE id = $id")->fetch_assoc();
$factura_id = $detalle['factura_id'];

// Obtener productos para seleccionarlos
$productos = $conexion->query("SELECT id, nombre, precio FROM productos");
?>

<h1>Editar detalle de factura</h1>

<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?= $detalle['id']; ?>">
    <input type="hidden" name="factura_id" value="<?= $factura_id; ?>">

    <label>Producto:</label>
    <select name="producto_id" required>
        <?php while ($p = $productos->fetch_assoc()) { ?>
            <option value="<?= $p['id']; ?>"
                <?= $p['id'] == $detalle['producto_id'] ? 'selected' : ''; ?>>
                <?= $p['nombre']; ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <label>Cantidad:</label>
    <input type="number" name="cantidad" value="<?= $detalle['cantidad']; ?>" required>
    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="list.php?factura_id=<?= $factura_id; ?>">Volver</a>

