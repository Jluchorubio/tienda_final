<?php
include __DIR__ . '/../config/conexion.php';

$sql = "UPDATE clientes SET 
            nombre = :nombre, 
            email = :email, 
            telefono = :telefono, 
            direccion = :direccion 
        WHERE id = :id";
$stmt = $pdo->prepare($sql);  // Prepara la consulta SQL.
$stmt->execute([
    'nombre' => $_POST['nombre'],
    'email' => $_POST['email'],
    'telefono' => $_POST['telefono'],
    'direccion' => $_POST['direccion'],
    'id' => $_POST['id']
]);
header("Location: ../templates/index.php?page=clientes");
exit;