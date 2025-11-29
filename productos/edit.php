<?php
include __DIR__ . '/../config/conexion.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: list.php');
    exit;
}

// Obtener producto
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
$stmt->execute([':id' => $id]);
$p = $stmt->fetch();

if (!$p) {
    die('Producto no encontrado');
}

// Obtener categorías para el select
$sqlCat = $pdo->query("SELECT * FROM categorias ORDER BY nombre ASC");
$categorias = $sqlCat->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Editar Producto</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px
        }

        .card {
            background: white;
            padding: 20px;
            max-width: 700px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1)
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 15px
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer
        }

        .save {
            background: #28a745
        }

        .cancel {
            background: #6c757d;
            text-decoration: none;
            padding: 10px 15px;
            color: white;
            border-radius: 6px
        }
    </style>

</head>

<body>

    <div class="card">
        <h2>Editar Producto</h2>

        <form action="update.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $p['id'] ?>">

            <!-- Nombre -->
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($p['nombre']) ?>" required>

            <!-- Precio -->
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" value="<?= $p['precio'] ?>" required>

            <!-- Cantidad -->
            <label>Cantidad</label>
            <input type="number" name="cantidad" value="<?= $p['cantidad'] ?>" required>

            <!-- Categoría -->
            <label>Categoría</label>
            <select name="categoria_id" required>
                <option value="">-- Selecciona --</option>

                <?php foreach ($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= ($c['id'] == $p['categoria_id']) ? 'selected' : '' ?>>
                        <?= $c['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Imagen -->
            <label>Imagen actual</label>
            <?php if ($p['imagen']): ?>
                <p><img src="../uploads/<?= $p['imagen'] ?>" width="120"></p>
            <?php else: ?>
                <p>No hay imagen</p>
            <?php endif; ?>

            <label>Reemplazar imagen (opcional)</label>
            <input type="file" name="imagen">

            <div class="actions">
                <button class="save" type="submit">Actualizar</button>
                <a class="cancel" href="list.php">Cancelar</a>
            </div>