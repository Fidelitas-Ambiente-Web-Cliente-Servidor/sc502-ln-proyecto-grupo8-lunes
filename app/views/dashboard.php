<?php

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php?page=login");
    exit;
}

require_once __DIR__ . "/../../includes/header.php";
require_once __DIR__ . "/../../includes/navbar.php";

$usuario = $_SESSION["usuario"];

$totalReportes = $resumen["total"];
$pendientes = $resumen["pendientes"];
$enProceso = $resumen["proceso"];
$resueltos = $resumen["resueltos"];
?>

<main class="container">
    <h1>Panel principal</h1>
    <p class="lead">Bienvenido, <?= htmlspecialchars($usuario["nombre"]) ?>.</p>

    <section class="panel">
        <h3>Resumen del sistema</h3>

        <div class="cards">
            <div class="card">
                <h3>Total de reportes</h3>
                <p style="font-size: 28px; font-weight: bold; margin-top: 10px;">
                    <?= $totalReportes ?>
                </p>
            </div>

            <div class="card">
                <h3>Pendientes</h3>
                <p style="font-size: 28px; font-weight: bold; margin-top: 10px; color: #ca8a04;">
                    <?= $pendientes ?>
                </p>
            </div>

            <div class="card">
                <h3>En proceso</h3>
                <p style="font-size: 28px; font-weight: bold; margin-top: 10px; color: #2563eb;">
                    <?= $enProceso ?>
                </p>
            </div>

            <div class="card">
                <h3>Resueltos</h3>
                <p style="font-size: 28px; font-weight: bold; margin-top: 10px; color: #16a34a;">
                    <?= $resueltos ?>
                </p>
            </div>
        </div>
    </section>

    <section class="panel" style="margin-top: 24px;">
        <h3>Accesos rápidos</h3>

        <div class="cards">
            <a class="card" href="index.php?page=reportes">
                <h3>Reportes</h3>
                <p>Crear, consultar y dar seguimiento a reportes comunitarios.</p>
            </a>

            <a class="card" href="index.php">
                <h3>Ir al inicio</h3>
                <p>Regresar a la página principal del sistema.</p>
            </a>

            <a class="card" href="index.php?page=logout">
                <h3>Cerrar sesión</h3>
                <p>Salir del sistema de forma segura.</p>
            </a>
        </div>
    </section>

    <section class="panel" style="margin-top: 24px;">
        <h3>Últimos reportes</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Asunto</th>
                    <th>Categoría</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($ultimosReportes instanceof mysqli_result && $ultimosReportes->num_rows > 0): ?>
                    <?php while ($reporte = $ultimosReportes->fetch_assoc()): ?>
                        <tr>
                            <td><?= $reporte["id_reporte"]; ?></td>
                            <td><?= htmlspecialchars($reporte["asunto"]); ?></td>
                            <td><?= htmlspecialchars($reporte["categoria"]); ?></td>
                            <td>
                                <span class="prioridad-<?= strtolower($reporte["prioridad"]); ?>">
                                    <?= htmlspecialchars($reporte["prioridad"]); ?>
                                </span>
                            </td>
                            <td>
                                <span class="estado-<?= str_replace(" ", "", strtolower($reporte["estado"])); ?>">
                                    <?= htmlspecialchars($reporte["estado"]); ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($reporte["fecha_creacion"]); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No hay reportes recientes.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

    <section class="panel" style="margin-top: 24px;">
        <h3>Últimos seguimientos</h3>

        <?php if ($ultimosSeguimientos instanceof mysqli_result && $ultimosSeguimientos->num_rows > 0): ?>
            <div class="cards">
                <?php while ($seguimiento = $ultimosSeguimientos->fetch_assoc()): ?>
                    <div class="card">
                        <h3><?= htmlspecialchars($seguimiento["nombre_usuario"]); ?></h3>
                        <p><?= htmlspecialchars($seguimiento["comentario"]); ?></p>
                        <p class="note">
                            Reporte #<?= htmlspecialchars($seguimiento["id_reporte"]); ?> |
                            <?= htmlspecialchars($seguimiento["fecha_actualizacion"]); ?>
                        </p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No hay seguimientos recientes.</p>
        <?php endif; ?>
    </section>
</main>

<?php require_once __DIR__ . "/../../includes/footer.php"; ?>