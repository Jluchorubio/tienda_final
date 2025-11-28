<style>
.welcome-container {
  max-width: 800px;
  margin: 0 auto;
  text-align: center;
}

    .info_general{
        display: flex;
    }

    .card_info{
        padding: 50px 80px;
        background-color: var(--green);
        margin: 12px;
        margin-bottom: 25px;
        border-radius: 20px;
    }
        .card_info2{
        padding: 50px 80px;
        background-color: var(--dark);
        margin: 12px;
        margin-bottom: 25px;
        border-radius: 20px;
        color: white;
    }

.welcome-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
  margin-bottom: 2rem;
}

.welcome-cards .card {
  background: var(--white);
  padding: 20px;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  text-align: left;
}

.welcome-cards .card h2 {
  margin-top: 0;
}

.tip {
  font-size: 0.9rem;
  color: #666;
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
        <p>productos</p>
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