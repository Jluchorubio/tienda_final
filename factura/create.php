<?php
include __DIR__ . "/../config/conexion.php";

// Obtener lista de clientes para el select
$clientes = $conexion->query("SELECT id, nombre FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Crear Factura</h1>

<form action="store.php" method="POST">

    <label>Cliente:</label>
    <select name="cliente_id" required>
        <option value="">Seleccione...</option>
        <?php foreach ($clientes as $c) { ?>
            <option value="<?php echo $c['id']; ?>">
                <?php echo $c['nombre']; ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <button type="submit">Guardar factura</button>
</form>

<br>
<a href="list.php">Volver al listado</a>
