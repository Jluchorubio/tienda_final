<?php
include __DIR__ . "/../../config/conexion.php";

if (!$pdo) {
    die("Error de conexión con la base de datos.");
}

$stmt = $pdo->query("SELECT * FROM productos");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$categoria_filtro = $_GET['categoria'] ?? '';
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>

    <style>
        /* Paleta*/
        :root {
            --green: #4db050;
            --dark: #1e293b;
            --muted: #f1f5f9;
            --white: #ffffff;
            --accent-soft: #d6ff90;
            --text-dark: #0b1220;
            --radius: 10px;
            --shadow: 0 6px 18px rgba(14, 30, 37, 0.08);
            font-family: Inter, Roboto, system-ui, -apple-system, "Segoe UI", "Helvetica Neue", Arial;
        }

        /* ----------- ENCABEZADO ----------- */
        .header-section {
            background: var(--white);
            margin: 20px auto 0;
            padding: 25px 25px;
            width: 96%;
            /* 🔥 ancho casi completo */
            max-width: 1400px;
            /* 🔥 límite para pantallas grandes */
            border-radius: var(--radius) var(--radius) 0 0;
            box-shadow: var(--shadow);
            justify-content: space-between;
            align-items: center;
        }


        .header-section h2 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        /* Botón */
        .botones {
            display: flex;
            gap: 10px;
            margin-left: auto;
        }

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

        #categoria {
            padding: 10px 18px;
            background: var(--dark);
            color: var(--white);
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.25s;
        }

        #categoria:hover {
            background: var(--dark);
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
        }

        /* Ícono dentro del select */
        select {
            padding: 6px 40px 6px 12px;
            background: var(--muted);

            /* Ícono SVG como imagen de fondo */
            background-image: url('data:image/svg+xml;utf8,<svg width="20" height="20" fill="none" stroke="%235e6c82" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 12px center;

            border-color: transparent;
            border-left: 1px solid #b9b9b9c7;
            border-radius: 0px 10px 10px 0px;
        }


        /* ===== TABLA ===== */
        .table-container {
            width: 96%;
            /* 🔥 igual que arriba */
            max-width: 1400px;
            margin: 0 auto 30px;
            /* 🔥 centrado */
            background: var(--white);
            border-radius: 0 0 var(--radius) var(--radius);
            box-shadow: var(--shadow);
            overflow-y: auto;
            max-height: 500px;
            /* 🔥 mismo estilo scroll */
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px 16px;
            border-bottom: 1px solid #eaeaea;
            text-align: left;
        }

        th {
            background: #f3f3f3;
            font-weight: 600;
        }

        tr:hover td {
            background: #f9f9f9;
        }

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
        }

        .icon-btn:hover {
            transform: scale(1.05);
        }

        img.thumb {
            max-width: 70px;
            border-radius: 6px;
        }

        /* ============================= */
        /* 📱📱 RESPONSIVE MÓVIL */
        /* ============================= */
        @media (max-width: 600px) {
            .header-section {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            .header-section h2 {
                font-size: 1.4rem;
            }

            .botones {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            table {
                min-width: 500px;
                /* 🔥 Ajuste más pequeño para pantallas chicas */
            }

            td,
            th {
                padding: 10px 12px;
            }

            .icon-btn {
                width: 28px;
                height: 28px;
                padding: 5px;
            }

            .icon-btn svg {
                width: 16px;
                height: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- ENCABEZADO -->
    <div class="header-section">
        <h2>Gestión de Productos</h2>
        <!-- FILTRO -->
        <div class="filter-box">
            <form method="GET">

                <div id="search" role="search">
                    <div>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M21 21l-4.35-4.35" stroke="#718096" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <circle cx="11" cy="11" r="6" stroke="#718096" stroke-width="1.6" />
                        </svg>
                        <input placeholder="Buscar categoria" />
                    </div>
                    <select name="categoria" onchange="this.form.submit()">
                        <option value="">
                            </svg></option>
                </div>


                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= ($categoria_filtro == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nombre']) ?>
                    </option>
                <?php endforeach; ?>
                </select>

                <?php if ($categoria_filtro): ?>
                    <a href="list.php">Quitar filtro</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="botones">
            <a href="create.php" class="btn-primary">Crear Producto</a>
            <a href="../categorias/create.php" class="btn-primary" id="categoria">Crear Categoría</a>
        </div>
    </div>
    </div>

    <div>
        <!-- TABLA -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Categoría</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td><?= htmlspecialchars($p['nombre']) ?></td>
                            <td>$<?= number_format($p['precio'], 2) ?></td>
                            <td><?= $p['cantidad'] ?></td>
                            <td><?= htmlspecialchars($p['categoria'] ?? 'Sin categoría') ?></td>

                            <td>
                                <?php if (!empty($p['imagen']) && file_exists(__DIR__ . '/../uploads/' . $p['imagen'])): ?>
                                    <img class="thumb" src="../uploads/<?= htmlspecialchars($p['imagen']) ?>" alt="">
                                <?php else: ?>
                                    <span style="color:#777;">Sin imagen</span>
                                <?php endif; ?>
                            </td>

                            <td class="actions">

                                <!-- EDITAR -->
                                <a href="edit.php?id=<?= $p['id'] ?>" class="icon-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="#ffffffff" fill-rule="evenodd"
                                            d="M3 18L15 6l3 3L6 21H3zM16 5l2-2l3 3l-2.001 2.001z" />
                                    </svg>
                                </a>

                                <!-- ELIMINAR -->
                                <form action="delete.php" method="POST"
                                    onsubmit="return confirm('¿Eliminar este producto?')" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                    <button class="icon-btn" id="delete" type="submit" style="border:none;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                            <path fill="#fff"
                                                d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                        </svg></button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>

    <?php include __DIR__ . "/../../includes/footer_dashboard.php"; ?>
</body>

</html>