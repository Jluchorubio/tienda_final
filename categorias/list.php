<?php
include __DIR__ . '/../config/conexion.php';

/* Ordenamiento dinámico */
$order = isset($_GET['order']) && $_GET['order'] === 'asc' ? 'ASC' : 'DESC';
$sql = "SELECT * FROM categorias ORDER BY id $order";
$stmt = $pdo->query($sql);
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* Define próximo orden al hacer clic */
$nextOrder = $order === 'ASC' ? 'DESC' : 'ASC';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Categorías</title>

    <style>
        /* ============================= */
        /* 🎨 PALETA Y BASE */
        /* ============================= */
        :root {
            --green: #4db050;
            --dark: #1e293b;
            --white: #ffffff;
            --muted: #f8fafc;
            --gray: #64748b;

            --radius: 10px;
            --shadow: 0 6px 18px rgba(14, 30, 37, 0.08);

            font-family: Inter, Roboto, system-ui, sans-serif;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: var(--muted);
            overflow-x: hidden;
        }

        h1 {
            text-align: center;
            margin: 25px 0;
            color: var(--dark);
        }

        /* ============================= */
        /* 🔹 ENCABEZADO */
        /* ============================= */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 900px;
            margin: auto;
            padding: 10px;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: var(--green);
            color: white;
            padding: 10px 14px;
            border-radius: var(--radius);
            text-decoration: none;
            font-weight: 600;
            box-shadow: var(--shadow);
        }

        /* ============================= */
        /* 🔍 BUSCADOR */
        /* ============================= */
        .search-box {
            max-width: 900px;
            margin: 15px auto;
            padding: 0 10px;
        }

        .search-input {
            width: 100%;
            padding: 12px 14px;
            border-radius: var(--radius);
            border: 1px solid #ccc;
            font-size: 1rem;
            box-shadow: var(--shadow);
        }

        /* ============================= */
        /* 📦 TABLA */
        /* ============================= */
        .table-container {
            max-width: 900px;
            margin: auto;
            background: var(--white);
            padding: 18px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 500px;
        }

        thead {
            background: var(--dark);
            color: white;
        }

        th,
        td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
        }

        tbody tr:nth-child(even) {
            background: var(--muted);
        }

        .btn {
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
        }

        .edit {
            background: #ffc107;
            color: black;
        }

        .delete {
            background: #dc3545;
        }

        /* ============================= */
        /* 📱 RESPONSIVE */
        /* ============================= */
        @media (max-width: 600px) {
            .header-section {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            h1 {
                font-size: 1.6rem;
            }

            table {
                min-width: 400px;
            }
        }
    </style>

</head>

<body>

    <h1>Categorías</h1>

    <div class="header-section">
        <a href="create.php" class="btn-primary">+ Crear Categoría</a>
    </div>

    <!-- BUSCADOR -->
    <div class="search" role="search">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
            <path d="M21 21l-4.35-4.35" stroke="#718096" stroke-width="1.6" stroke-linecap="round"
                stroke-linejoin="round" />
            <circle cx="11" cy="11" r="6" stroke="#718096" stroke-width="1.6" />
        </svg>
        <input placeholder="Buscar categoria" />
    </div>
    
    </div>

    <div class="table-container">
        <table id="tablaCategorias">
            <thead>
                <tr>
                    <th>
                        <a href="?order=<?= $nextOrder ?>" style="color:white;text-decoration:none;">
                            ID <?= $order === 'ASC' ? '▲' : '▼' ?>
                        </a>
                    </th>
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
                            <a class="btn edit" href="edit.php?id=<?= $c['id'] ?>">Editar</a>
                            <a class="btn delete" href="delete.php?id=<?= $c['id'] ?>"
                                onclick="return confirm('¿Eliminar categoría?')">Eliminar</a>
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