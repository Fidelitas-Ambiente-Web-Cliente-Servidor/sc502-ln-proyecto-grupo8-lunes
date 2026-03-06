<?php
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";
?>

<main class="container">
  <h1>Nosotros</h1>
  <p class="lead">
    Este proyecto fue desarrollado como parte del curso SC-502 con el objetivo de crear una solución web básica
    para la gestión de solicitudes en un condominio.
  </p>

  <div class="cards">
    <div class="card">
      <h3>¿Qué es este sistema?</h3>
      <p>
        Es una plataforma sencilla para registrar y dar seguimiento a reportes comunes como mantenimiento,
        convivencia o seguridad, manteniendo la información organizada.
      </p>
    </div>

    <div class="card">
      <h3>Objetivo</h3>
      <p>
        Facilitar la comunicación entre residentes y administración, permitiendo que las solicitudes tengan
        un control más claro y un historial.
      </p>
    </div>

    <div class="card">
      <h3>Estado del proyecto</h3>
      <p>
        En esta etapa la interfaz y el formulario son demostrativos. En los siguientes avances se integrará
        la base de datos para guardar y consultar solicitudes reales.
      </p>
    </div>
  </div>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>