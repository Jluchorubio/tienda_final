<?php
include __DIR__ . '/../../categorias/list.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Categorías</title>

    <style>
        /* Paleta*/
        :root {
            --green: #4db050;
            /* acento verde */
            --dark: #1e293b;
            /* gris azulado oscuro (sidebar) */
            --muted: #f1f5f9;
            /* gris claro (fondos) */
            --white: #ffffff;
            --accent-soft: #d6ff90;
            /* acento opcional */
            --text-dark: #0b1220;
            --radius: 10px;
            --shadow: 0 6px 18px rgba(14, 30, 37, 0.08);
            font-family: Inter, Roboto, system-ui, -apple-system, "Segoe UI", "Helvetica Neue", Arial;
        }

        /* ----------- ENCABEZADO DE SECCIÓN ----------- */
        .header-section {
            background: var(--white);
            margin: 20px 20px 0px 20px;
            padding: 20px 25px;
            border-radius: var(--radius) var(--radius) 0 0;
            /* Solo arriba */
            box-shadow: var(--shadow);
            justify-content: space-between;
            align-items: center;
            /* elimina espacio */
            justify-content: space-between;
            align-items: center;
            display: flex;
        }

        /* Título */
        .header-section h2 {
            font-size: 22px;
            font-weight: 600;
        }

        /* Botón */
        .btn-primary {
            padding: 10px 18px;
            background: var(--green);
            color: var(--white);
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.25s;
        }

        .btn-primary:hover {
            background: #3b9e44;
            transform: translateY(-2px);
        }


        /* ===== FILTRO ===== */
        #search {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px;
            border-radius: 10px;
            border: 2px solid transparent;
            background: var(--muted);
            width: 420px;
            justify-content: space-between;

        }

        #search:hover {
            border-color: var(--green);

        }

        #search input {
            border: 0;
            background: transparent;
            outline: 0;
            font-size: 15px
        }

        .filter-box {
            display: flex;
            flex-direction: row;
            margin-top: 20px;
            justify-content: space-between;
        }

        /* Ícono dentro del select */
        select {
            padding: 6px 40px 6px 12px;
            background: var(--muted);
        }

        /* ----------- TABLA ----------- */
        .table-container {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin: 0px 20px 0px 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px 16px;
            border-bottom: 1px solid #eaeaea;
        }

        th {
            background: #f3f3f3;
            font-weight: 600;
        }

        /* Hover */
        tr:hover td {
            background: #f9f9f9;
        }

        /* Acciones */
        .actions {
            display: flex;
            gap: 8px;
        }

        .icon-btn {
            background: var(--dark);
            padding: 7px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        #delete {
            background: red;
            padding: 7px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .icon-btn:hover {
            transform: scale(1.05);
        }

        .icon-btn svg {
            width: 20px;
            height: 20px;
            fill: var(--text-dark);
        }


        /* ==== CONTENEDOR PRINCIPAL ==== */
        .main-content {
            margin-left: 250px;
            /* Ancho del menú lateral */
            padding: 20px;
            width: calc(100% - 250px);
            /* Quita el espacio en blanco */
            box-sizing: border-box;
        }

        /* ==== TARJETA DE GESTIÓN DE CLIENTES SIN RADIUS ==== */
        .card {
            background: #fff;
            padding: 20px;
            margin-top: 10px;
            border: 1px solid #e3e3e3;
            border-radius: 0px !important;
            /* sin bordes redondeados */
        }

        /* ==== TABLA SIN RADIUS ==== */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 0 !important;
        }

        .table-header,
        th {
            background: #f4f4f4;
            border-radius: 0 !important;
        }

        td,
        th {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        /* ==== BOTÓN NUEVO CLIENTE ==== */
        .btn-new {
            background: #0abf53;
            color: #fff;
            padding: 10px 18px;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn-new:hover {
            background: #099648;
        }

        /* ==== SCROLL ==== */
        .table-container {
            max-height: 420px;
            overflow-y: auto;
            overflow-x: auto;
            border-radius: 0 !important;
        }

        table th,
        table td {
            text-align: center;
        }
    </style>

</head>

<body>

    <!-- Encabezado -->
    <div class="header-section">
        <h2>Categorías</h2>

        <a href="../categorias/create.php" class="btn-primary">Crear Categoría</a>
    </div>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'foreign_key'): ?>
        <div class="alert alert-danger">
            No se puede eliminar esta categoría porque tiene productos asociados.
        </div>
    <?php endif; ?>

    <!-- Contenedor principal de tabla -->
    <div class="table-container">
        <table id="tablaCategorias">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($categorias as $c): ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= $c['nombre'] ?></td>
                        <td>
                            <div class="actions">
                                <a class="icon-btn" href="../categorias/edit.php?id=<?php echo $c['id']; ?>"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="#ffffffff" fill-rule="evenodd"
                                            d="M3 18L15 6l3 3L6 21H3zM16 5l2-2l3 3l-2.001 2.001z" />
                                    </svg></a>

                                <a id="delete" href="../categorias/delete.php?id=<?php echo $c['id']; ?>"
                                    onclick="return confirm('¿Eliminar categoría?')"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="#fff"
                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                    </svg></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <script>
        /* ============================= */
        /* 🔍 FILTRO EN TIEMPO REAL */
        /* ============================= */
        document.getElementById('buscar').addEventListener('keyup', function () {
            let filtro = this.value.toLowerCase();
            let filas = document.querySelectorAll("#tablaCategorias tbody tr");

            filas.forEach(fila => {
                let texto = fila.textContent.toLowerCase();
                fila.style.display = texto.includes(filtro) ? "" : "none";
            });
        });
    </script>

</body>

</html>