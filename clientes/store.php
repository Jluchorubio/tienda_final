<?php
include "conexion.php";  // Incluye la conexión a la base de datos.

$sql = "INSERT INTO clientes (nombre, email, telefono, direccion) 
        VALUES (:nombre, :email, :telefono, :direccion)";
$stmt = $pdo->prepare($sql);  // Prepara la consulta SQL.
$stmt->execute([
    'nombre' => $_POST['nombre'],
    'email' => $_POST['email'],
    'telefono' => $_POST['telefono'],
    'direccion' => $_POST['direccion']
]);

header("Location: ../clientes/list.php");  // Redirige a la página de listado de clientes.