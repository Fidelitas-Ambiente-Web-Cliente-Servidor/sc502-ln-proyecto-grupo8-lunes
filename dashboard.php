<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION["usuario"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Condominio</title>
    <link rel="stylesheet" href="/assets/css/styles.css?v=<?= time() ?>">
</head>
<body>
    <main class="container">
        <h1>Panel principal</h1>
        <p class="lead">Bienvenido, <?= htmlspecialchars($usuario["nombre"]) ?>.</p>

        <div class="cards">
            <a class="card" href="/pages/solicitudes.php">
                <h3>Solicitudes</h3>
                <p>Gestionar solicitudes del sistema.</p>
            </a>

            <a class="card" href="/logout.php">
                <h3>Cerrar sesión</h3>
                <p>Salir del sistema de forma segura.</p>
            </a>
        </div>
    </main>
</body>
</html>