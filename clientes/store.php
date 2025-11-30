<?php
include __DIR__ . '/../config/conexion.php';

$sql = "INSERT INTO clientes (nombre, email, telefono, direccion) 
        VALUES (:nombre, :email, :telefono, :direccion)";
$stmt = $pdo->prepare($sql);  // Prepara la consulta SQL.
$stmt->execute([
    'nombre' => $_POST['nombre'],
    'email' => $_POST['email'],
    'telefono' => $_POST['telefono'],
    'direccion' => $_POST['direccion']
]);

header("Location: ../templates/index.php?page=clientes");
exit;






