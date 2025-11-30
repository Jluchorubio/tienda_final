<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Facturas</title>
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
        <h2>Gestión de Facturas</h2>

        <!-- FILTRO -->
        <div class="filter-box">
            <form method="GET">
                <div id="search" role="search">
                    <div style="display: flex; align-items: center; gap: 8px; flex: 1;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M21 21l-4.35-4.35" stroke="#718096" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <circle cx="11" cy="11" r="6" stroke="#718096" stroke-width="1.6" />
                        </svg>
                        <input name="buscar" placeholder="Buscar cliente" id="searchInput" />
                    </div>
                    <select name="cliente" onchange="this.form.submit()">
                        <option value="">Todos</option>
                        <?php foreach ($clientes as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= ($cliente_filtro == $c['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <?php if ($cliente_filtro): ?>
                    <a href="list.php" style="margin-left: 10px; color: #ef4444; text-decoration: none; font-weight: 500;">
                        ✕ Quitar filtro
                    </a>
                <?php endif; ?>
            </form>
                    <!--Botones-->
        <div class="botones">
            <a href="../../factura/create.php" class="btn-primary">Crear Factura</a>
            <a href="../clientes/create.php" id="categoria">Crear Cliente</a>
        </div>
    </div>
        </div>

    <!-- TABLA -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($facturas)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center; color: #86868b; padding: 40px;">
                            No hay facturas registradas
                        </td>
                    </tr>z
                <?php else: ?>
                    <?php foreach ($facturas as $f): ?>
                        <tr>
                            <td><?= htmlspecialchars($f['id']); ?></td>
                            <td><?= htmlspecialchars($f['cliente']); ?></td>
                            <td><?= htmlspecialchars($f['fecha']); ?></td>
                            <td>$<?= number_format($f['total'], 2); ?></td>
                            <td class="actions">
                                <!-- VER DETALLES -->
                                <a href="../detalle_factura/list.php?factura_id=<?= $f['id']; ?>" class="icon-btn"
                                    style="background: #3b82f6; padding: 7px 14px; text-decoration: none; color: white; font-size: 14px;"
                                    title="Ver detalles">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        style="margin-right: 4px;">
                                        <path fill="white"
                                            d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                    </svg>
                                    Ver
                                </a>

                                <!-- EDITAR -->
                                <a href="../../factura/edit.php?id=<?= $f['id'] ?>" class="icon-btn" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="#ffffffff" fill-rule="evenodd"
                                            d="M3 18L15 6l3 3L6 21H3zM16 5l2-2l3 3l-2.001 2.001z" />
                                    </svg>
                                </a>

                                <!-- ELIMINAR -->
                                <form action="../../factura/delete.php" method="POST" onsubmit="return confirm('¿Eliminar esta factura?')"
                                    style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $f['id'] ?>">
                                    <button class="icon-btn" id="delete" type="submit" title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                            <path fill="#fff"
                                                d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Búsqueda en tiempo real
        document.getElementById('searchInput').addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>

    <?php include __DIR__ . "/../../includes/footer_dashboard.php";?>
</body>

</html>