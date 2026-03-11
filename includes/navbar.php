<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar">
  <div class="nav-brand">Condominio</div>
  <div class="nav-links">
    <a href="<?= $BASE ?>/index.php">Inicio</a>
    <a href="<?= $BASE ?>/pages/solicitudes.php">Solicitudes</a>
    <a href="<?= $BASE ?>/pages/nosotros.php">Nosotros</a>
    <a href="<?= $BASE ?>/pages/contacto.php">Contacto</a>

    <?php if (isset($_SESSION["usuario"])): ?>
      <a href="<?= $BASE ?>/dashboard.php">Panel</a>
      <a href="<?= $BASE ?>/logout.php">Salir</a>
    <?php else: ?>
      <a href="<?= $BASE ?>/login.php">Login</a>
    <?php endif; ?>
  </div>
</nav>