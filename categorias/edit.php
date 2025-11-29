<?php
include __DIR__ . '/../config/conexion.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: list.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM categorias WHERE id = :id");
$stmt->execute([':id' => $id]);
$categoria = $stmt->fetch();

if (!$categoria)
    die("Categoría no encontrada");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px
        }

        .card {
            background: white;
            padding: 20px;
            margin: auto;
            margin-top: 40px;
            max-width: 400px;
            border-radius: 8px;
        }

        input,
        button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc
        }

        button {
            background: #ffc107;
            color: black;
            border: none
        }
    </style>
</head>

<body>

    <div class="card">
        <h2>Editar Categoría</h2>

        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $categoria['id'] ?>">

            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($categoria['nombre']) ?>" required>

            <button type="submit">Actualizar</button>
        </form>
    </div>

</body>

</html>