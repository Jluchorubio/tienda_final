<?php
include __DIR__ . "/../config/conexion.php";

$stmt = $conexion->query("SELECT id, nombre FROM clientes ORDER BY nombre");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .factura-container {
        max-width: 500px;
        margin: 40px auto;
        background: #ffffff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }

    .factura-container h1 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 25px;
        color: #333;
    }

    .factura-container label {
        display: block;
        font-weight: bold;
        margin-bottom: 8px;
        color: #444;
        margin-top: 15px;
    }

    .factura-container select {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .factura-container button {
        width: 100%;
        background: #007bff;
        color: white;
        padding: 12px;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 10px;
    }

    .factura-container button:hover {
        background: #0056b3;
    }

    .factura-container .back-link {
        display: block;
        margin-top: 20px;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        color: #555;
    }

    .factura-container .back-link:hover {
        text-decoration: underline;
    }
</style>

<div class="factura-container">

<h1>Crear factura</h1>

<form action="/tienda_final/factura/store.php" method="POST">

    <label>Cliente:</label>
    <select name="cliente_id" required>
        <option value="">Seleccione</option>
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c['id']; ?>"><?= $c['nombre']; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Guardar factura</button>
</form>

<a class="back-link" href="/tienda_final/templates/index.php?page=factura_list">← Volver</a>

</div>
