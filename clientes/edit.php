<?php
include __DIR__ . '/../config/conexion.php';
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = :id");
$stmt->execute(['id' => $id]);
$cliente = $stmt->fetch();
?>
<link rel="stylesheet" href="../templates/style.css">

<div class="form-card">
    <h2 class="form-title">Editar Cliente</h2>

    <form action="../clientes/update.php" method="POST" class="form-container">
        <input type="hidden" name="id" value="<?php echo $cliente["id"]; ?>">

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo $cliente["nombre"]; ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $cliente["email"]; ?>" required>
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <input type="tel" name="telefono" value="<?php echo $cliente["telefono"]; ?>">
        </div>

        <div class="form-group">
            <label>Dirección</label>
            <textarea name="direccion"><?php echo $cliente["direccion"]; ?></textarea>
        </div>

        <button class="btn-primary-form">Actualizar</button>
    </form>
</div>