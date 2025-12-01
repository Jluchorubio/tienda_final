<?php
include __DIR__ . "/../config/conexion.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: ../templates/index.php?page=factura_list&error=sin_id");
    exit;
}

$stmt = $conexion->prepare("SELECT * FROM detalle_factura WHERE id = ?");
$stmt->execute([$id]);
$detalle = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$detalle) {
    header("Location: ../templates/index.php?page=factura_list&error=no_data");
    exit;
}
?>

<h1>Editar detalle factura</h1>

<form action="update.php" method="POST">

    <input type="hidden" name="id" value="<?= $detalle['id'] ?>">
    <input type="hidden" name="factura_id" value="<?= $detalle['factura_id'] ?>">

    <label>Producto:</label>
    <input type="text" name="producto_id" value="<?= $detalle['producto_id'] ?>" required>

    <label>Cantidad:</label>
    <input type="number" name="cantidad" value="<?= $detalle['cantidad'] ?>" required>

    <label>Precio:</label>
    <input type="number" name="precio" value="<?= $detalle['precio'] ?>" required>

    <button type="submit">Guardar cambios</button>
</form>

<br>
<a href="../templates/index.php?page=detalle_factura_list&factura_id=<?= $detalle['factura_id'] ?>">Volver</a>
