<?php
include __DIR__ . '/../config/conexion.php';

// obtener categorias para el select
$catStmt = $pdo->query("SELECT id, nombre FROM categorias ORDER BY nombre");
$categorias = $catStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear producto</title>
<style>
    body{font-family:Arial;background:#f4f4f9;padding:30px}
    .card{max-width:520px;margin:auto;background:#fff;padding:20px;border-radius:10px;box-shadow:0 6px 18px rgba(0,0,0,0.06)}
    input, select, button{width:100%;padding:10px;margin:8px 0;border-radius:6px;border:1px solid #ddd}
    button{background:#28a745;color:white;border:none;cursor:pointer}
    a{display:inline-block;margin-top:8px}
</style>
</head>
<body>

<div class="card">
    <h2>Crear producto</h2>

    <form action="store.php" method="POST" enctype="multipart/form-data">
        <label>Nombre</label>
        <input type="text" name="nombre" required maxlength="150">

        <label>Precio</label>
        <input type="number" name="precio" step="0.01" required>

        <label>Cantidad</label>
        <input type="number" name="cantidad" min="0" required>

        <label>Categoria</label>
        <select name="categoria_id" required>
            <option value="">-- Selecciona --</option>
            <?php foreach ($categorias as $c): ?>
                <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Imagen (opcional, jpg/png/webp – max 2MB)</label>
        <input type="file" name="imagen" accept="image/*">

        <button type="submit">Guardar</button>
    </form>

    <a href="list.php">Volver</a>
</div>

</body>
</html>
