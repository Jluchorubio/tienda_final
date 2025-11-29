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

        <label>Categoría</label>
        <select name="categoria_id" required>
            <option value="">-- Selecciona --</option>

            <?php foreach ($categorias as $c): ?>
                <option value="<?= $c['id'] ?>">
                    <?= htmlspecialchars($c['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Imagen (opcional)</label>
        <input type="file" name="imagen">

        <button type="submit">Guardar</button>
    </form>

    <a href="../templates/index.php?page=productos">Regresar</a>
</div>

</body>
</html>
