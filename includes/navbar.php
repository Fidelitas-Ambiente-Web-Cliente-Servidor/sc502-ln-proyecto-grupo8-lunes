<nav class="navbar">
  <div class="nav-brand">Reportes Comunitarios</div>

  <div class="nav-links">
    <a href="index.php">Inicio</a>
    <a href="index.php?page=reportes">Reportes</a>
    <a href="index.php?page=dashboard">Dashboard</a>

    <?php if (isset($_SESSION["usuario"])): ?>
      <div class="nav-user">
        <span class="nav-user-name">
          <?= htmlspecialchars($_SESSION["usuario"]["nombre"]) ?>
        </span>

        <?php if ($_SESSION["usuario"]["rol"] == 1): ?>
          <span class="nav-user-role admin">Admin</span>
        <?php else: ?>
          <span class="nav-user-role usuario">Usuario</span>
        <?php endif; ?>
      </div>

      <a href="index.php?page=logout">Cerrar sesión</a>
    <?php else: ?>
      <a href="index.php?page=login">Login</a>
    <?php endif; ?>
  </div>
</nav>