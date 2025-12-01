<?php
include __DIR__ . "/../../config/conexion.php";

$query = $_GET['query'] ?? '';

?>

<!-- ==========================
       CSS DENTRO DEL ARCHIVO
=========================== -->
<style>
.search-box {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    margin-top: 10px;
}

.search-box h2 {
    margin-bottom: 20px;
}

.search-block {
    margin-top: 30px;
}

.search-block h3 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #333;
    border-left: 4px solid #4CAF50;
    padding-left: 10px;
}

.search-block ul {
    list-style: none;
    padding-left: 0;
}

.search-block ul li {
    background: #f9f9f9;
    border: 1px solid #e3e3e3;
    padding: 12px 15px;
    border-radius: 8px;
    margin-bottom: 6px;
    font-size: 15px;
}

.empty-msg {
    color: #777;
    font-style: italic;
}
</style>


<div class="search-box">

<?php

echo "<h2>Resultados de búsqueda: \"{$query}\"</h2>";

if (!$query) {
    echo "<p>Escribe algo para buscar.</p>";
    exit;
}


// CLIENTES
$sqlClientes = $conexion->prepare("
    SELECT id, nombre, telefono, direccion
    FROM clientes
    WHERE nombre LIKE ?
       OR telefono LIKE ?
       OR direccion LIKE ?
");

$sqlClientes->execute(["%{$query}%", "%{$query}%", "%{$query}%"]);
$clientes = $sqlClientes->fetchAll(PDO::FETCH_ASSOC);


// PRODUCTOS
$sqlProductos = $conexion->prepare("
    SELECT id, nombre, precio
    FROM productos
    WHERE nombre LIKE ?
");

$sqlProductos->execute(["%{$query}%"]);
$productos = $sqlProductos->fetchAll(PDO::FETCH_ASSOC);


// FACTURAS
$sqlFacturas = $conexion->prepare("
    SELECT f.id, c.nombre AS cliente, f.fecha, f.total
    FROM factura f
    INNER JOIN clientes c ON c.id = f.cliente_id
    WHERE c.nombre LIKE ?
");

$sqlFacturas->execute(["%{$query}%"]);
$facturas = $sqlFacturas->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="search-block">
<h3>Clientes</h3>

<?php if ($clientes): ?>
    <ul>
        <?php foreach ($clientes as $c): ?>
            <li><?= $c['nombre'] ?> — <?= $c['telefono'] ?> — <?= $c['direccion'] ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p class="empty-msg">No se encontraron clientes.</p>
<?php endif; ?>
</div>


<div class="search-block">
<h3>Productos</h3>

<?php if ($productos): ?>
    <ul>
        <?php foreach ($productos as $p): ?>
            <li><?= $p['nombre'] ?> — $<?= $p['precio'] ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p class="empty-msg">No se encontraron productos.</p>
<?php endif; ?>
</div>


<div class="search-block">
<h3>Facturas</h3>

<?php if ($facturas): ?>
    <ul>
        <?php foreach ($facturas as $f): ?>
            <li>Factura #<?= $f['id'] ?> — Cliente: <?= $f['cliente'] ?> — Total: $<?= $f['total'] ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p class="empty-msg">No se encontraron facturas.</p>
<?php endif; ?>
</div>

</div>
