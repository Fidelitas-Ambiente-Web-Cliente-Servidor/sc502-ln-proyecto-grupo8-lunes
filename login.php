<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: dashboard.php");
    exit;
}

$mensaje = "";

if (isset($_GET['error'])) {
    $mensaje = "Correo o contraseña incorrectos.";
}

if (isset($_GET['logout'])) {
    $mensaje = "Sesión cerrada correctamente.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Condominio</title>
    <link rel="stylesheet" href="/assets/css/styles.css?v=<?= time() ?>">
</head>
<body>
    <main class="container">
        <h1>Iniciar sesión</h1>
        <p class="lead">Accede al sistema con tu usuario administrador.</p>

        <?php if (!empty($mensaje)): ?>
            <div class="card" style="margin-bottom: 16px; color: #b91c1c;">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <div class="card" style="max-width: 500px;">
            <form action="procesar_login.php" method="POST">
                <div style="margin-bottom: 14px;">
                    <label for="correo"><strong>Correo</strong></label><br>
                    <input type="email" name="correo" id="correo" required style="width:100%; padding:10px; margin-top:6px;">
                </div>

                <div style="margin-bottom: 14px;">
                    <label for="contrasena"><strong>Contraseña</strong></label><br>
                    <input type="password" name="contrasena" id="contrasena" required style="width:100%; padding:10px; margin-top:6px;">
                </div>

                <button type="submit" style="padding:10px 18px; cursor:pointer;">Ingresar</button>
            </form>
        </div>
    </main>
</body>
</html>