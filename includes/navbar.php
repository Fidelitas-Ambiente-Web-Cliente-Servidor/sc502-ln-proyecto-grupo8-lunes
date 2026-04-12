<nav class="navbar">
  <div class="nav-brand">Condominio App</div>

  <div class="nav-links">
    <a href="<?= $BASE ?>/index.php">Inicio</a>
    <a href="<?= $BASE ?>/index.php?page=solicitudes">Solicitudes</a>
    <a href="<?= $BASE ?>/index.php?page=dashboard">Dashboard</a>

    <?php if (isset($_SESSION["usuario"])): ?>
      <a href="<?= $BASE ?>/index.php?page=logout">Cerrar sesión</a>
    <?php else: ?>
      <a href="<?= $BASE ?>/index.php?page=login">Login</a>
    <?php endif; ?>
  </div>
</nav>