<?php
include __DIR__ . "/../config/conexion.php";

if (!isset($_GET['factura_id'])) {
    die("Error: No se proporcionó factura_id");
}

$factura_id = $_GET['factura_id'];

// Obtener productos existentes
$stmt = $conexion->query("SELECT id, nombre, precio FROM productos ORDER BY nombre ASC");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Guardar detalle
if ($_POST) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    // Obtener precio del producto
    $stmtPrecio = $conexion->prepare("SELECT precio FROM productos WHERE id = ?");
    $stmtPrecio->execute([$producto_id]);
    $producto = $stmtPrecio->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        die("Error: Producto no encontrado");
    }

    $precio = $producto["precio"];
    $subtotal = $precio * $cantidad;

    // Insertar detalle
    $stmtInsert = $conexion->prepare("
        INSERT INTO detalle_factura (factura_id, producto_id, cantidad, precio, subtotal)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmtInsert->execute([$factura_id, $producto_id, $cantidad, $precio, $subtotal]);

    header("Location: list.php?factura_id=$factura_id");
    exit;
}
?>

<h2>Agregar detalle a factura #<?= $factura_id ?></h2>

<form method="POST">

    <label>Producto:</label><br>
    <select name="producto_id" required>
        <option value="">Seleccione uno</option>

        <?php foreach ($productos as $p) { ?>
            <option value="<?= $p['id']; ?>">
                <?= $p['nombre']; ?> — $<?= $p['precio']; ?>
            </option>
        <?php } ?>

    </select>
    <br><br>

    <label>Cantidad:</label><br>
    <input type="number" name="cantidad" min="1" required><br><br>

    <button type="submit">Agregar</button>
</form>

<br>
<a href="list.php?factura_id=<?= $factura_id ?>">Volver</a>
