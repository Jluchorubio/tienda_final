<?php
include __DIR__ . '/../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: create.php');
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$precio = trim($_POST['precio'] ?? '');
$cantidad = trim($_POST['cantidad'] ?? '');
$categoria_id = $_POST['categoria_id'] ?? null;

if ($nombre === '' || $precio === '' || $cantidad === '' || $categoria_id === '') {
    die('Todos los campos son obligatorios.');
}

// procesar imagen si viene
$imagenNombre = null;
if (!empty($_FILES['imagen']['name']) && $_FILES['imagen']['error'] === 0) {
    $allowed = ['jpg','jpeg','png','gif','webp'];
    $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        die('Tipo de imagen no permitido.');
    }
    if ($_FILES['imagen']['size'] > 2 * 1024 * 1024) {
        die('La imagen supera el tamaño máximo (2MB).');
    }

    $uploadDir = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $imagenNombre = uniqid('p_') . '.' . $ext;
    $dest = $uploadDir . $imagenNombre;

    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $dest)) {
        die('Error al guardar la imagen.');
    }
}

$sql = "INSERT INTO productos (nombre, precio, cantidad, categoria_id, imagen)
        VALUES (:nombre, :precio, :cantidad, :categoria_id, :imagen)";
$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':nombre' => $nombre,
    ':precio' => $precio,
    ':cantidad' => $cantidad,
    ':categoria_id' => $categoria_id,
    ':imagen' => $imagenNombre
]);

header('Location: ../templates/index.php?page=productos');
exit;
