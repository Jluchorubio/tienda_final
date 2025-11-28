<?php
include __DIR__ . "/../config/conexion.php";

$stmt = $conexion->query("SELECT id, nombre FROM clientes ORDER BY nombre");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Crear factura</h1>

<form action="store.php" method="POST">

    <label>Cliente:</label>
    <select name="cliente_id" required>
        <option value="">Seleccione</option>
        <?php foreach ($clientes as $c) { ?>
            <option value="<?= $c['id']; ?>"><?= $c['nombre']; ?></option>
        <?php } ?>
    </select>

    <br><br>

    <button type="submit">Guardar factura</button>
</form>

<br>
<a href="list.php">Volver</a>
