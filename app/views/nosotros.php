<?php
require_once __DIR__ . "/../../includes/header.php";
require_once __DIR__ . "/../../includes/navbar.php";
?>

<main class="container">
  <h1>Nosotros</h1>
  <p class="lead">
    Este proyecto fue desarrollado como parte del curso SC-502 con el objetivo de crear una solución web
    orientada a la gestión y seguimiento de reportes comunitarios, abordando problemáticas reales en barrios,
    cantones y comunidades.
  </p>

  <div class="cards">
    <div class="card">
      <h3>¿Qué es este sistema?</h3>
      <p>
        Es una plataforma web que permite a los usuarios registrar y dar seguimiento a reportes relacionados con
        problemas comunitarios como acumulación de basura, fugas de agua, daños en infraestructura y situaciones
        de seguridad, manteniendo la información organizada y accesible.
      </p>
    </div>

    <div class="card">
      <h3>Objetivo</h3>
      <p>
        Facilitar la gestión de incidencias dentro de una comunidad mediante el uso de tecnología, permitiendo
        un mejor control, seguimiento y resolución de problemas, así como una comunicación más eficiente entre
        los usuarios y los encargados de atender los reportes.
      </p>
    </div>

    <div class="card">
      <h3>Impacto social</h3>
      <p>
        El sistema busca mejorar la calidad de vida en las comunidades al facilitar la detección,
        organización y solución de problemas, promoviendo la participación ciudadana y la transparencia
        en la gestión de incidencias.
      </p>
    </div>

    <div class="card">
      <h3>Estado del proyecto</h3>
      <p>
        Actualmente, el sistema cuenta con funcionalidades de registro de usuarios, creación de reportes,
        asignación de estados, seguimiento mediante historial y visualización en un panel principal.
        Se proyecta como base para futuras mejoras como notificaciones automáticas, geolocalización
        y análisis estadístico.
      </p>
    </div>
  </div>

  <section class="panel" style="margin-top: 24px;">
    <h3>Tecnologías utilizadas</h3>

    <div class="cards">
      <div class="card">
        <h3>Frontend</h3>
        <p>HTML, CSS y JavaScript para la interfaz y experiencia del usuario.</p>
      </div>

      <div class="card">
        <h3>Backend</h3>
        <p>PHP bajo el patrón MVC para la lógica del sistema.</p>
      </div>

      <div class="card">
        <h3>Base de datos</h3>
        <p>MySQL para el almacenamiento estructurado de la información.</p>
      </div>

      <div class="card">
        <h3>Arquitectura</h3>
        <p>Modelo Cliente/Servidor con separación de responsabilidades.</p>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . "/../../includes/footer.php"; ?>