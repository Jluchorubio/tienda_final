<?php
include "../config/conexion.php";  // Conexión a la BD

if (!$pdo) {
    die("Error de conexión con la base de datos.");
}

$stmt = $pdo->query("SELECT * FROM clientes");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>

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
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* elimina espacio */
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
            height:20px;
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
    </style>
</head>

<body>

    <div class="header-section">
        <h2>Gestión de Clientes</h2>
        <a href="../clientes/create.php" class="btn-primary">+ Nuevo Cliente</a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= $cliente['id'] ?></td>
                        <td><?= $cliente['nombre'] ?></td>
                        <td><?= $cliente['email'] ?></td>
                        <td><?= $cliente['telefono'] ?></td>
                        <td><?= $cliente['direccion'] ?></td>

                        <td class="actions">
                            <a href="../clientes/edit.php?id=<?= $cliente['id'] ?>" class="icon-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                    <path fill="#ffffffff" fill-rule="evenodd"
                                        d="M3 18L15 6l3 3L6 21H3zM16 5l2-2l3 3l-2.001 2.001z" />
                                </svg>
                            </a>

                            <a href="../clientes/delete.php?id=<?= $cliente['id'] ?>" class="icon-btn" id="delete"
                                onclick="return confirm('¿Eliminar este cliente?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                    <path fill="#fff"
                                        d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include __DIR__ . "/../../includes/footer_dashboard.php"; ?>
</body>

</html>