<?php
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/includes/navbar.php";
?>

<main class="container">
    <section class="panel" style="text-align:center; padding:40px 24px;">
        <h1>Sistema de Solicitudes – Condominio</h1>
        <p class="lead" style="max-width: 800px; margin: 0 auto 24px;">
            Plataforma web para registrar, dar seguimiento y administrar solicitudes de mantenimiento,
            seguridad, convivencia y asuntos administrativos dentro del condominio.
        </p>

        <div style="display:flex; gap:14px; justify-content:center; flex-wrap:wrap; margin-top:20px;">
            <?php if (isset($_SESSION["usuario"])): ?>
                <a href="<?= $BASE ?>/dashboard.php" class="btn" style="text-decoration:none;">
                    Ir al panel
                </a>
                <a href="<?= $BASE ?>/pages/solicitudes.php" class="btn" style="text-decoration:none;">
                    Ver solicitudes
                </a>
            <?php else: ?>
                <a href="<?= $BASE ?>/login.php" class="btn" style="text-decoration:none;">
                    Iniciar sesión
                </a>
            <?php endif; ?>
        </div>
    </section>

    <section class="cards" style="margin-top:28px;">
        <div class="card">
            <h3>Registro de solicitudes</h3>
            <p>
                Permite crear solicitudes de forma ordenada, indicando asunto, tipo, prioridad,
                fecha y descripción de la situación reportada.
            </p>
        </div>

        <div class="card">
            <h3>Seguimiento de casos</h3>
            <p>
                Las solicitudes quedan almacenadas en la base de datos, permitiendo su revisión,
                edición y actualización según el estado del trámite.
            </p>
        </div>

        <div class="card">
            <h3>Administración centralizada</h3>
            <p>
                El sistema concentra la información en un solo lugar, facilitando la gestión
                y el control administrativo de las solicitudes del condominio.
            </p>
        </div>
    </section>

    <section class="panel" style="margin-top:28px;">
        <h2 style="margin-bottom:16px;">Accesos rápidos</h2>

        <div class="cards">
            <a class="card" href="<?= $BASE ?>/pages/solicitudes.php">
                <h3>Solicitudes</h3>
                <p>Registrar, consultar, editar y eliminar solicitudes del sistema.</p>
            </a>

            <a class="card" href="<?= $BASE ?>/pages/nosotros.php">
                <h3>Nosotros</h3>
                <p>Conocer el objetivo, alcance y propósito general del proyecto.</p>
            </a>

            <a class="card" href="<?= $BASE ?>/pages/contacto.php">
                <h3>Contacto</h3>
                <p>Visualizar medios de contacto y datos generales del sistema.</p>
            </a>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/includes/footer.php"; ?>