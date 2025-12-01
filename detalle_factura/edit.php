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

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar detalle factura</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #eef2f3;
        padding: 30px;
        color: #333;
    }

    .form-container {
        width: 450px;
        margin: auto;
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    h1 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-top: 12px;
        font-weight: bold;
        color: #34495e;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccd1d1;
        border-radius: 6px;
        font-size: 15px;
    }

    input:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 5px rgba(52,152,219,0.3);
    }

    button {
        width: 100%;
        margin-top: 20px;
        padding: 12px;
        border: none;
        background: #3498db;
        color: white;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
    }

    button:hover {
        background: #2980b9;
    }

    .back-link {
        display: inline-block;
        margin-top: 15px;
        text-decoration: none;
        color: #7f8c8d;
        font-weight: bold;
    }

    .back-link:hover {
        color: #2c3e50;
        text-decoration: underline;
    }
</style>

</head>
<body>

<div class="form-container">

    <h1>Editar detalle</h1>

    <form action="update.php" method="POST">

        <input type="hidden" name="id" value="<?= $detalle['id'] ?>">
        <input type="hidden" name="factura_id" value="<?= $detalle['factura_id'] ?>">

        <label>Producto (ID):</label>
        <input type="text" name="producto_id" value="<?= $detalle['producto_id'] ?>" required>

        <label>Cantidad:</label>
        <input type="number" name="cantidad" value="<?= $detalle['cantidad'] ?>" required>

        <label>Precio unitario:</label>
        <input type="number" name="precio" value="<?= $detalle['precio'] ?>" required>

        <button type="submit">Guardar cambios</button>
    </form>

    <a class="back-link" href="/tienda_final/detalle_factura/list.php?factura_id=<?= $detalle['factura_id'] ?>">← Volver</a>


</div>

</body>
</html>
