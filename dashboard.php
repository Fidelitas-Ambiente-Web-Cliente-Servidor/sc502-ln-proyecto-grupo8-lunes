<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["usuario"])) {
    header("Location: /login.php");
    exit;
}

require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/includes/navbar.php";

$usuario = $_SESSION["usuario"];

$totalSolicitudes = 0;
$pendientes = 0;
$enRevision = 0;
$resueltas = 0;

$sqlTotal = "SELECT COUNT(*) AS total FROM solicitudes";
$resTotal = $conn->query($sqlTotal);
if ($resTotal && $fila = $resTotal->fetch_assoc()) {
    $totalSolicitudes = $fila["total"];
}

$sqlPendientes = "SELECT COUNT(*) AS total FROM solicitudes WHERE estado = 'Pendiente'";
$resPendientes = $conn->query($sqlPendientes);
if ($resPendientes && $fila = $resPendientes->fetch_assoc()) {
    $pendientes = $fila["total"];
}

$sqlRevision = "SELECT COUNT(*) AS total FROM solicitudes WHERE estado = 'En revisión'";
$resRevision = $conn->query($sqlRevision);
if ($resRevision && $fila = $resRevision->fetch_assoc()) {
    $enRevision = $fila["total"];
}

$sqlResueltas = "SELECT COUNT(*) AS total FROM solicitudes WHERE estado = 'Resuelta'";
$resResueltas = $conn->query($sqlResueltas);
if ($resResueltas && $fila = $resResueltas->fetch_assoc()) {
    $resueltas = $fila["total"];
}
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
            <a class="card" href="<?= $BASE ?>/pages/solicitudes.php">
                <h3>Solicitudes</h3>
                <p>Crear, consultar, editar y eliminar solicitudes del sistema.</p>
            </a>

            <a class="card" href="<?= $BASE ?>/index.php">
                <h3>Ir al inicio</h3>
                <p>Regresar a la página principal del proyecto.</p>
            </a>

            <a class="card" href="<?= $BASE ?>/logout.php">
                <h3>Cerrar sesión</h3>
                <p>Salir del sistema de forma segura.</p>
            </a>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/includes/footer.php"; ?>