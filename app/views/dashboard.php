<?php

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php?page=login");
    exit;
}

require_once __DIR__ . "/../../includes/header.php";
require_once __DIR__ . "/../../includes/navbar.php";

$usuario = $_SESSION["usuario"];

$totalSolicitudes = $resumen["total"];
$pendientes = $resumen["pendientes"];
$enRevision = $resumen["revision"];
$resueltas = $resumen["resueltas"];
?>

<main class="container">
    <h1>Panel principal</h1>
    <p class="lead">Bienvenido, <?= htmlspecialchars($usuario["nombre"]) ?>.</p>

    <section class="panel">
        <h3>Resumen del sistema</h3>

        <div class="cards">
            <div class="card">
                <h3>Total de solicitudes</h3>
                <p style="font-size: 28px; font-weight: bold; margin-top: 10px;">
                    <?= $totalSolicitudes ?>
                </p>
            </div>

            <div class="card">
                <h3>Pendientes</h3>
                <p style="font-size: 28px; font-weight: bold; margin-top: 10px; color: #ca8a04;">
                    <?= $pendientes ?>
                </p>
            </div>

            <div class="card">
                <h3>En revisión</h3>
                <p style="font-size: 28px; font-weight: bold; margin-top: 10px; color: #2563eb;">
                    <?= $enRevision ?>
                </p>
            </div>

            <div class="card">
                <h3>Resueltas</h3>
                <p style="font-size: 28px; font-weight: bold; margin-top: 10px; color: #16a34a;">
                    <?= $resueltas ?>
                </p>
            </div>
        </div>
    </section>

    <section class="panel" style="margin-top: 24px;">
        <h3>Accesos rápidos</h3>

        <div class="cards">
            <a class="card" href="<?= $BASE ?>/index.php?page=solicitudes">
                <h3>Solicitudes</h3>
                <p>Crear, consultar, editar y eliminar solicitudes del sistema.</p>
            </a>

            <a class="card" href="<?= $BASE ?>/index.php">
                <h3>Ir al inicio</h3>
                <p>Regresar a la página principal del proyecto.</p>
            </a>

            <a class="card" href="<?= $BASE ?>/index.php?page=logout">
                <h3>Cerrar sesión</h3>
                <p>Salir del sistema de forma segura.</p>
            </a>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/../../includes/footer.php"; ?>