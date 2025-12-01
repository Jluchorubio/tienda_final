<?php
include __DIR__ . "/../config/conexion.php";

$stmt = $conexion->query("SELECT id, nombre FROM clientes ORDER BY nombre");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Crear factura</h1>

<form action="/tienda_final/factura/store.php" method="POST">

    <label>Cliente:</label>
    <select name="cliente_id" required>
        <option value="">Seleccione</option>
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c['id']; ?>"><?= $c['nombre']; ?></option>
        <?php endforeach; ?>
    </select>

    <br><br>
    <button type="submit">Guardar factura</button>
</form>

<br>
<a href="index.php?page=factura_list">Volver</a>
