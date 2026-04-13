<?php
require_once __DIR__ . "/../../../includes/header.php";

$mensaje = "";

if (isset($_GET['error'])) {
    if ($_GET['error'] == 1) {
        $mensaje = "Correo o contraseña incorrectos.";
    }
}

if (isset($_GET['success'])) {
    if ($_GET['success'] == 1) {
        $mensaje = "Usuario registrado correctamente. Ahora puedes iniciar sesión.";
    }
}
?>

<main class="container">
    <h1>Iniciar sesión</h1>

    <?php if (!empty($mensaje)): ?>
        <div class="card" style="color: <?= isset($_GET['error']) ? 'red' : 'green' ?>;">
            <?= $mensaje ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=procesar_login">
        <input type="email" name="correo" placeholder="Correo" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>

        <button class="btn">Ingresar</button>
    </form>

    <p class="note">
        ¿No tienes cuenta?
        <a href="index.php?page=register">Regístrate aquí</a>
    </p>
</main>

<?php require_once __DIR__ . "/../../../includes/footer.php"; ?>