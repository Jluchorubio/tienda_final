<style>
  /* ============================================================
   PALETA Y CONFIGURACIÓN GENERAL
============================================================ */
:root {
  --green: #4db050;
  --dark: #1e293b;
  --muted: #f1f5f9;
  --white: #ffffff;
  --accent-soft: #d6ff90;
  --text-dark: #0b1220;
  --radius: 14px;
  --shadow: 0 6px 18px rgba(14, 30, 37, 0.08);
  font-family: Inter, Roboto, system-ui, -apple-system, "Segoe UI", Arial;
}

/* ============================================================
   REGLAS ESTRUCTURALES QUE EVITAN OVERFLOW
============================================================ */
*, *::before, *::after {
  box-sizing: border-box;
}

html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  max-width: 100%;
  overflow-x: hidden;   /* no scroll horizontal */
  background: var(--muted);
}

/* ============================================================
   CONTENEDOR PRINCIPAL
============================================================ */
.welcome-page {
  padding: 0;
  width: 100%;
}

.welcome-container {
  width: 100%;
  max-width: 950px;
  margin: 0 auto;
  padding: 20px 16px;
  text-align: center;
}

/* ============================================================
   CARDS SUPERIORES (info_general)
============================================================ */
.info_general {
  display: flex;
  flex-wrap: wrap;         /* para responsive real */
  gap: 16px;
  justify-content: center;
  margin-bottom: 30px;
}

.card_info,
.card_info2 {
  flex: 1 1 260px;          /* RESPONSIVE REAL: se acomodan sin desbordar */
  background: var(--green);
  color: #fff;
  padding: 32px 22px;
  border-radius: 22px;
  box-shadow: var(--shadow);
  min-width: 0;             /* evita overflow por contenido */
  text-align: center;
}

.card_info2 {
  background: var(--dark);
}

/* ============================================================
   TARJETAS GRANDES (GRID)
============================================================ */
.welcome-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  width: 100%;
}

.welcome-cards .card {
  background: var(--white);
  padding: 22px;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  text-align: left;
  min-width: 0;  /* evita overflow por contenido */
}

/* ============================================================
   TIP
============================================================ */
.tip {
  font-size: 0.9rem;
  color: #666;
  margin-top: 25px;
}

/* ============================================================
   RESPONSIVE — TABLET
============================================================ */
@media (max-width: 1024px) {
  .welcome-container {
    max-width: 92%;
    padding: 20px 12px;
  }

  .card_info,
  .card_info2 {
    padding: 28px 20px;
  }
}

/* ============================================================
   RESPONSIVE — MOVIL
============================================================ */
@media (max-width: 600px) {
  h1 {
    font-size: 1.7rem;
  }

  .welcome-subtitle {
    font-size: 1rem;
  }

  .info_general {
    flex-direction: column;
    gap: 14px;
  }

  .card_info,
  .card_info2 {
    width: 100%;
    padding: 20px;
    border-radius: 18px;
  }

  .welcome-cards {
    grid-template-columns: 1fr; /* todas apiladas */
  }

  .welcome-cards .card {
    padding: 16px;
  }
}

</style>

</head>

<main>
  <!-- Página de inicio del dashboard -->
  <div class="welcome-page">
    <div class="welcome-container">
      <h1>Bienvenido a Mi Panel</h1>
      <p class="welcome-subtitle">Administración y gestión con facilidad</p>

      <nav class="info_general">

        <div class="card_info">
          <h2>#numero</h2>
          <p>productos</p>
        </div>

        <div class="card_info">
          <h2>#numero</h2>
          <p>clientes</p>
        </div>

        <div class="card_info2">
          <h2>#numero</h2>
          <p>Compras(por factura)</p>
        </div>

      </nav>

      <div class="welcome-cards">
        <div class="card">
          <h2>Dashboard General</h2>
          <p>Visualiza las estadísticas globales: usuarios activos, datos recientes, reportes.</p>
        </div>
        <div class="card">
          <h2>Área de Configuración</h2>
          <p>Administra tus ajustes, permisos y configura tu sistema según tus necesidades.</p>
        </div>
        <div class="card">
          <h2>Gestión de Usuarios</h2>
          <p>Agrega, edita o elimina usuarios. Controla roles y accesos fácilmente.</p>
        </div>
        <!-- Puedes añadir más tarjetas según las secciones que tenga tu panel -->
      </div>

      <p class="tip">Tip: Explora el menú de la izquierda para comenzar.</p>
    </div>
  </div>

  <?php include __DIR__ . "/../../includes/footer_dashboard.php"; ?>

</main>