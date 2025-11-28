<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="app">

        <aside class="sidebar" aria-label="barra lateral">

            <div class="brand">

                <div class="logo"><img src="IMG/logo.jpg" alt=""></div>

                <div class="or_panel">
                    <h1>Mi Panel</h1>
                    <div style="font-size:12px;opacity:0.8">administrador</div>
                </div>
            </div>

            <nav class="nav" aria-label="navegación principal">

                <a href="index.php?page=inicio" class="active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5"
                            d="m2 8l9.732-4.866a.6.6 0 0 1 .536 0L22 8m-2 3v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8" />
                    </svg>Inicio
                </a>

                <a href="index.php?page=productos" class="active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 2048 2048">
                        <path fill="currentColor"
                            d="m1344 2l704 352v785l-128-64V497l-512 256v258l-128 64V753L768 497v227l-128-64V354zm0 640l177-89l-463-265l-211 106zm315-157l182-91l-497-249l-149 75zm-507 654l-128 64v-1l-384 192v455l384-193v144l-448 224L0 1735v-676l576-288l576 288zm-640 710v-455l-384-192v454zm64-566l369-184l-369-185l-369 185zm576-1l448-224l448 224v527l-448 224l-448-224zm384 576v-305l-256-128v305zm384-128v-305l-256 128v305zm-320-288l241-121l-241-120l-241 120z" />
                    </svg>Productos
                </a>

                <a href="index.php?page=clientes" class="active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M16 17v2H2v-2s0-4 7-4s7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 3.5-3.5m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.4 3.4 0 0 0-1.93.59a5 5 0 0 1 0 5.82A3.4 3.4 0 0 0 15 11a3.5 3.5 0 0 0 0-7" />
                    </svg>
                    Clientes
                </a>

                <a href="index.php?page=factura" class="active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 12 12">
                        <path fill="currentColor"
                            d="M10.5 4h-2C7.67 4 7 3.33 7 2.5v-2c0-.28-.22-.5-.5-.5H2c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h8c.55 0 1-.45 1-1V4.5c0-.28-.22-.5-.5-.5m-2 6h-5c-.28 0-.5-.22-.5-.5s.22-.5.5-.5h5c.28 0 .5.22.5.5s-.22.5-.5.5M9 7.5c0 .28-.22.5-.5.5h-5c-.28 0-.5-.22-.5-.5v-2c0-.28.22-.5.5-.5h5c.28 0 .5.22.5.5zm-1-7V2c0 .55.45 1 1 1h1.5c.45 0 .67-.54.35-.85l-2-2C8.54-.17 8 .06 8 .5" />
                    </svg>
                    Facturas
                </a>
            </nav>

            <div class="logout">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z"
                            clip-rule="evenodd" />
                    </svg>
                    Perfil
                </a>
            </div>

        </aside>

        <main class="main">
            <header class="topbar">
                <div style="display:flex;align-items:center;gap:16px">
                    <div class="search" role="search">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M21 21l-4.35-4.35" stroke="#718096" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <circle cx="11" cy="11" r="6" stroke="#718096" stroke-width="1.6" />
                        </svg>
                        <input placeholder="Buscar productos, clientes..." />
                    </div>
                </div>

                <div class="top-actions">
                    <button class="btn" title="Notificaciones">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 4.5a.5.5 0 0 0-.5-.5a.5.5 0 0 0-.5.5v1.53c-2.25.25-4 2.15-4 4.47v5.91L5.41 18h12.18L16 16.41V10.5c0-2.32-1.75-4.22-4-4.47zM11.5 3A1.5 1.5 0 0 1 13 4.5v.71c2.31.65 4 2.79 4 5.29V16l3 3H3l3-3v-5.5C6 8 7.69 5.86 10 5.21V4.5A1.5 1.5 0 0 1 11.5 3m0 19a2.5 2.5 0 0 1-2.45-2h1.04a1.495 1.495 0 0 0 2.82 0h1.04a2.5 2.5 0 0 1-2.45 2" />
                        </svg>
                    </button>

                </div>
            </header>

            <main class="vista">
                <?php
                $page = $_GET['page'] ?? 'inicio'; // carga por defecto "inicio"
                
                $archivo = "views/" . $page . ".php";

                if (file_exists($archivo)) {
                    include $archivo;
                } else {
                    echo "<p style='padding:20px'>⚠ Página no encontrada</p>";
                }
                ?>
            </main>
        </main>
    </div>
</body>

</html>