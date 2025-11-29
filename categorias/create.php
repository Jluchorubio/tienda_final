<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Categoría</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px
        }

        .card {
            background: white;
            padding: 20px;
            margin: auto;
            margin-top: 40px;
            max-width: 400px;
            border-radius: 8px;
        }

        input,
        button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc
        }

        button {
            background: #28a745;
            color: white;
            border: none
        }
    </style>
</head>

<body>

    <div class="card">
        <h2>Crear Categoría</h2>

        <form action="store.php" method="POST">
            <label>Nombre</label>
            <input type="text" name="nombre" required maxlength="150">

            <button type="submit">Guardar</button>
        </form>
    </div>

</body>

</html>