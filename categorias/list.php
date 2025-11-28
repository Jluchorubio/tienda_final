<?php
include __DIR__ . '/../config/conexion.php';

$sql = "SELECT * FROM categorias ORDER BY id DESC";
$stmt = $pdo->query($sql);
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
    <style>
        body{font-family:Arial;margin:30px;background:#f4f4f4}
        table{width:60%;margin:auto;border-collapse:collapse;background:white;box-shadow:0 2px 10px rgba(0,0,0,0.1)}
        th,td{padding:12px;border-bottom:1px solid #ddd;text-align:center}
        th{background:#007bff;color:white}
        .btn{padding:8px 12px;border-radius:6px;text-decoration:none;color:white}
        .new{background:#28a745}
        .edit{background:#ffc107;color:black}
        .delete{background:#dc3545}
    </style>
</head>
<body>

<h1 style="text-align:center;">Categorías</h1>

<div style="text-align:center;margin-bottom:20px;">
    <a class="btn new" href="create.php">+ Crear Categoría</a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($categorias as $c): ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= $c['nombre'] ?></td>
        <td>
            <a class="btn edit" href="edit.php?id=<?= $c['id'] ?>">Editar</a>
            <a class="btn delete" href="delete.php?id=<?= $c['id'] ?>" onclick="return confirm('¿Eliminar categoría?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach ?>
</table>

</body>
</html>
