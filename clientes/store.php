<?php
include __DIR__ . '/../config/conexion.php';

// 1. Verificar si el email ya existe
$check = $pdo->prepare("SELECT id FROM clientes WHERE email = :email");
$check->execute(['email' => $_POST['email']]);

if ($check->rowCount() > 0) {
    echo "<script>alert('El correo ya está registrado.'); window.location.href='/tienda_final/templates/index.php?page=clientes_create';</script>";
    exit;
}

// 2. Insertar
$sql = "INSERT INTO clientes (nombre, email, telefono, direccion) 
        VALUES (:nombre, :email, :telefono, :direccion)";
$stmt = $pdo->prepare($sql);

$stmt->execute([
    'nombre' => $_POST['nombre'],
    'email' => $_POST['email'],
    'telefono' => $_POST['telefono'],
    'direccion' => $_POST['direccion']
]);

header("Location: /tienda_final/templates/index.php?page=clientes");
exit;
