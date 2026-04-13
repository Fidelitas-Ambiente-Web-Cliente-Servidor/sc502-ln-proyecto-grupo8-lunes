<?php
require_once __DIR__ . "/../../../includes/header.php";

if (isset($_GET['error'])) {
    $mensaje = "Error al registrar.";
}

if (isset($_GET['success'])) {
    $mensaje = "Usuario creado correctamente.";
}
?>

<main class="container">
    <h1>Registro</h1>

    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-error">
            <?= $mensaje ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=procesar_register" class="form">
        <div class="grid">
            <div class="field">
                <label>Nombre</label>
                <input type="text" name="nombre" required>
            </div>

            <div class="field">
                <label>Correo</label>
                <input type="email" name="correo" required>
            </div>

            <div class="field">
                <label>Contraseña</label>
                <input type="password" name="contrasena" required>
            </div>
        </div>

        <button class="btn">Registrarse</button>
    </form>

    <p class="note">
        ¿Ya tienes cuenta? <a href="index.php?page=login">Inicia sesión</a>
    </p>
</main>

<?php require_once __DIR__ . "/../../../includes/footer.php"; ?>