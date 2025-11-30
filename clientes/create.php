<link rel="stylesheet" href="../templates/style.css">

<div class="form-card">
    <h2 class="form-title">Crear Cliente</h2>

    <form action="store.php" method="POST" class="form-container">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" placeholder="Ingresa el nombre" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Correo electrónico" required>
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <input type="tel" name="telefono" placeholder="Número de contacto">
        </div>

        <div class="form-group">
            <label>Dirección</label>
            <textarea name="direccion" placeholder="Dirección del cliente"></textarea>
        </div>

        <button class="btn-primary-form">Guardar</button>
    </form>
</div>