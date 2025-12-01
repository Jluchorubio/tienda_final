<?php
include __DIR__ . "/../config/conexion.php";

$id = $_GET['id'];

$stmt = $conexion->prepare("
    SELECT id, cliente_id
    FROM factura
    WHERE id = ?
");
$stmt->execute([$id]);
$factura = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conexion->query("SELECT id, nombre FROM clientes ORDER BY nombre");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .factura-container {
        max-width: 500px;
        margin: 40px auto;
        background: #ffffff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }

    .factura-container h1 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 24px;
        color: #333;
    }

    .factura-container label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        margin-top: 15px;
        color: #444;
    }

    .factura-container select,
    .factura-container input[type="number"],
    .factura-container input[type="text"] {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        margin-top: 5px;
        font-size: 14px;
    }

    .factura-container button {
        width: 100%;
        background: #007bff;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 6px;
        margin-top: 20px;
        cursor: pointer;
        font-size: 16px;
    }

    .factura-container button:hover {
        background: #0056b3;
    }

    .factura-container .back-link {
        display: block;
        margin-top: 20px;
        text-align: center;
        color: #555;
        text-decoration: none;
        font-size: 14px;
    }

    .factura-container .back-link:hover {
        text-decoration: underline;
    }
</style>

<div class="factura-container">

<h1>Editar factura #<?= $factura['id']; ?></h1>

<form action="/tienda_final/factura/update.php" method="POST">
    <input type="hidden" name="id" value="<?= $factura['id']; ?>">

    <label>Cliente:</label>
    <select name="cliente_id">
        <?php foreach ($clientes as $c) { ?>
            <option value="<?= $c['id']; ?>" <?= $c['id'] == $factura['cliente_id'] ? "selected" : "" ?>>
                <?= $c['nombre']; ?>
            </option>
        <?php } ?>
    </select>

    <button type="submit">Actualizar</button>
</form>

<a class="back-link" href="/tienda_final/templates/index.php?page=factura_list">← Volver</a>

</div>
