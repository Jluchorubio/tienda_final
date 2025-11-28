<?php
include __DIR__ . '/../config/conexion.php';

// =========================
// Cargar categorías (para filtro)
// =========================
$stmtCat = $pdo->query("SELECT * FROM categorias ORDER BY nombre");
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

// categoría seleccionada en el filtro
$categoria_filtro = $_GET['categoria'] ?? '';

// =========================
// Consultar productos (con o sin filtro)
// =========================
if ($categoria_filtro) {
    $sql = "SELECT p.*, c.nombre AS categoria
            FROM productos p
            LEFT JOIN categorias c ON p.categoria_id = c.id
            WHERE p.categoria_id = :cat
            ORDER BY p.id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['cat' => $categoria_filtro]);
} else {
    $sql = "SELECT p.*, c.nombre AS categoria
            FROM productos p
            LEFT JOIN categorias c ON p.categoria_id = c.id
            ORDER BY p.id DESC";

    $stmt = $pdo->query($sql);
}

$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de productos</title>
<style>
    body{font-family:Arial;margin:30px;background:#f4f4f4}
    table{width:95%;margin:auto;border-collapse:collapse;background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.08)}
    th,td{padding:12px;border-bottom:1px solid #e6e6e6;text-align:center}
    th{background:#007bff;color:#fff}
    img.thumb{max-width:80px;height:auto;border-radius:6px}
    .btn{padding:8px 10px;border-radius:6px;color:#fff;text-decoration:none}
    .new{background:#28a745;padding:10px 14px;display:inline-block;margin-bottom:12px}
    .edit{background:#ffc107}
    .delete{background:#dc3545}
    form{display:inline}
</style>
</head>
<body>

<div style="text-align:center; margin-bottom:12px;">
    <a class="new" href="create.php" style="margin-right:10px;">+ Crear producto</a>
    <a class="new" href="../categorias/create.php" style="background:#6f42c1;">+ Crear categoría</a>
</div>

<!-- FILTRO POR CATEGORIA -->
<div style="text-align:center; margin-bottom:20px;">
    <form method="GET">
        <label><strong>Filtrar por categoría:</strong></label>
        <select name="categoria" onchange="this.form.submit()" style="padding:6px; border-radius:6px;">
            <option value="">-- Todas --</option>

            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= ($categoria_filtro == $cat['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <?php if ($categoria_filtro): ?>
            <a href="list.php" style="margin-left:10px;">Quitar filtro</a>
        <?php endif; ?>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Categoria</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($productos as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nombre']) ?></td>
            <td>$<?= number_format($p['precio'], 2) ?></td>
            <td><?= $p['cantidad'] ?></td>
            <td><?= htmlspecialchars($p['categoria'] ?? 'Sin categoría') ?></td>

            <td>
                <?php if (!empty($p['imagen']) && file_exists(__DIR__ . '/../uploads/' . $p['imagen'])): ?>
                    <img class="thumb" src="../uploads/<?= htmlspecialchars($p['imagen']) ?>" alt="">
                <?php else: ?>
                    <span style="color:#777;font-size:0.9em">Sin imagen</span>
                <?php endif; ?>
            </td>

            <td>
                <a class="btn edit" href="edit.php?id=<?= $p['id'] ?>">Editar</a>

                <form action="delete.php" method="POST" onsubmit="return confirm('¿Eliminar este producto?')">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <button class="btn delete" type="submit" style="border:none;padding:8px 10px;border-radius:6px;color:#fff;background:#dc3545;cursor:pointer">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
