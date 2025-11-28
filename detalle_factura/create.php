<?php
include("../conexion.php");

$factura_id = $_GET['factura_id'];

$productos = $conexion->query("SELECT id, nombre, precio FROM productos");
?>

<h1>Agregar detalle a factura #<?php echo $factura_id; ?></h1>

<form action="store.php" method="POST">
    <input type="hidden" name="factura_id" value="<?php echo $factura_id; ?>">

    <label>Producto:</label>
    <select name="producto_id" required>
        <?php while ($p = $productos->fetch_assoc()) { ?>
            <option value="<?php echo $p['id']; ?>">
                <?php echo $p['nombre']; ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <label>Cantidad:</label>
    <input type="number" name="cantidad" required>
    <br><br>

    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" required>
    <br><br>

    <button type="submit">Guardar</button>
</form>

<br>
<a href="list.php?factura_id=<?php echo $factura_id; ?>">Volver</a>