<?php
include "conexion.php";  // Incluye la conexión a la base de datos.

$id = $_GET['id'];  // Obtiene el ID del cliente desde la URL.

$stmt = $pdo->prepare("DELETE FROM clientes WHERE id = :id");  // Prepara la consulta SQL para eliminar al cliente.
$stmt->execute(['id' => $id]);  // Ejecuta la consulta de eliminación.

header("Location: ../clientes/list.php");
// Redirige a la lista de clientes después de eliminar.