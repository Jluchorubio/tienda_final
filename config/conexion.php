<?php
$dsn = 'mysql:host=localhost;dbname=inventario_final;charset=utf8';
$conexion = new PDO("mysql:host=localhost;dbname=inventario_final","root","");
$usuario = 'root';
$contrasena = '';

try {
    $pdo = new PDO($dsn, $usuario, $contrasena);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    die(" Error en la conexión: " . $e->getMessage());
}
?>
