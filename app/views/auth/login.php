<?php

if (isset($_GET['error'])) {
    $mensaje = "Correo o contraseña incorrectos.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<main class="container">
    <h1>Iniciar sesión</h1>

    <?php if (!empty($mensaje)): ?>
        <div class="card" style="color:red;">
            <?= $mensaje ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=procesar_login">
        <input type="email" name="correo" placeholder="Correo" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>

        <button class="btn">Ingresar</button>
    </form>
</main>

</body>
</html>