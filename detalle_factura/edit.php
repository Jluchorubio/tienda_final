<?php
include("../conexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM detalle_factura WHERE id = $id";
$detalle = $conexion->query($sql)->fetch_assoc();
?>

<h1>Editar detalle</h1>

<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $detalle['id']; ?>">

    <label>Cantidad:</label>
    <input type="number" name="cantidad" value="<?php echo $detalle['cantidad']; ?>" required>
    <br><br>

    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" value="<?php echo $detalle['precio']; ?>" required>
    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="list.php?factura_id=<?php echo $detalle['factura_id']; ?>">Volver</a>
