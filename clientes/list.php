<?php
include "conexion.php";  // Incluye la conexión a la base de datos.

$stmt = $pdo->query("SELECT * FROM clientes");  // Obtiene todos los clientes de la base de datos.
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Recupera los resultados de la consulta.
?>
<h1>Clientes</h1>
<a href="clientes/create.php">Nuevo Cliente</a> <!-- Enlace para agregar un nuevo cliente -->
<ul>
    <?php foreach ($clientes as $cliente): ?>
        <li>
            <?php echo $cliente["nombre"]; ?> - <?php echo $cliente["email"]; ?>
            <a href="edit.php?id=<?php echo $cliente["id"]; ?>">Editar</a>
            <a href="delete.php?id=<?php echo $cliente["id"]; ?>">Eliminar</a>
        </li>
    <?php endforeach; ?>
</ul>