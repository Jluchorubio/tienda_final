<?php
include __DIR__ . '/../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = $_POST['id'] ?? null;
$nombre = trim($_POST['nombre'] ?? '');
$precio = trim($_POST['precio'] ?? '');
$cantidad = trim($_POST['cantidad'] ?? '');
$categoria_id = $_POST['categoria_id'] ?? null;

if (!$id || $nombre === '' || $precio === '' || $cantidad === '' || $categoria_id === '') {
    die('Datos incompletos.');
}

// obtener imagen actual
$stmt = $pdo->prepare("SELECT imagen FROM productos WHERE id = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch();
$imagen_actual = $row ? $row['imagen'] : null;

$nueva_imagen = $imagen_actual;

// procesar nueva imagen
if (!empty($_FILES['imagen']['name']) && $_FILES['imagen']['error'] === 0) {

    $allowed = ['jpg','jpeg','png','gif','webp'];
    $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) die('Tipo de imagen no permitido.');
    if ($_FILES['imagen']['size'] > 2*1024*1024) die('Imagen supera 2MB.');

    $uploadDir = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $nuevoNombre = uniqid('p_') . '.' . $ext;

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadDir . $nuevoNombre)) {

        if ($imagen_actual && file_exists($uploadDir . $imagen_actual)) {
            @unlink($uploadDir . $imagen_actual);
        }

        $nueva_imagen = $nuevoNombre;
    }
}

// actualizar registro
$sql = "UPDATE productos
        SET nombre = :nombre,
            precio = :precio,
            cantidad = :cantidad,
            categoria_id = :categoria_id,
            imagen = :imagen
        WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':nombre' => $nombre,
    ':precio' => $precio,
    ':cantidad' => $cantidad,
    ':categoria_id' => $categoria_id,
    ':imagen' => $nueva_imagen,
    ':id' => $id
]);

header('Location: list.php');
exit;
