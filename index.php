<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/includes/navbar.php";
?>

<main class="container">
  <h1>Sistema de Solicitudes – Condominio</h1>
  <p class="lead">
    Bienvenido(a). Aquí podrás registrar solicitudes, dar seguimiento y consultar el estado de cada gestión.
  </p>

  <div class="cards">
    <a class="card" href="pages/solicitudes.php">
      <h3>Solicitudes</h3>
      <p>Crear y ver solicitudes registradas.</p>
    </a>

    <a class="card" href="pages/nosotros.php">
      <h3>Nosotros</h3>
      <p>Información general del sistema.</p>
    </a>

    <a class="card" href="pages/contacto.php">
      <h3>Contacto</h3>
      <p>Canales de contacto y soporte.</p>
    </a>
  </div>
</main>

<?php require_once __DIR__ . "/includes/footer.php"; ?>