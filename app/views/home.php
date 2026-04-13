<?php require_once __DIR__ . "/../../includes/header.php"; ?>
<?php require_once __DIR__ . "/../../includes/navbar.php"; ?>

<main class="container">
    <h1>Sistema de Reportes Comunitarios</h1>
    <p class="lead">
        Bienvenido(a). Esta plataforma permite registrar, gestionar y dar seguimiento a problemas
        comunitarios como basura, fugas de agua, daños en infraestructura y situaciones de seguridad.
    </p>

    <div class="cards">
        <a class="card" href="<?= $BASE ?>/index.php?page=reportes">
            <h3>Reportes</h3>
            <p>Crear, consultar y dar seguimiento a reportes de la comunidad.</p>
        </a>

        <a class="card" href="index.php?page=dashboard">
            <h3>Dashboard</h3>
            <p>Visualiza estadísticas, estados y actividad reciente del sistema.</p>
        </a>

        <a class="card" href="index.php?page=nosotros">
            <h3>Nosotros</h3>
            <p>Información general del sistema y su propósito.</p>
        </a>

        <a class="card" href="index.php?page=contacto">
            <h3>Contacto</h3>
            <p>Canales de soporte y comunicación.</p>
        </a>
    </div>

    <section class="panel" style="margin-top: 24px;">
        <h3>¿Qué puedes hacer en este sistema?</h3>

        <div class="cards">
            <div class="card">
                <h3>Registrar incidencias</h3>
                <p>
                    Reporta problemas comunitarios de forma organizada, indicando categoría,
                    prioridad y descripción detallada.
                </p>
            </div>

            <div class="card">
                <h3>Dar seguimiento</h3>
                <p>
                    Consulta el estado de tus reportes y revisa las actualizaciones realizadas
                    por los administradores.
                </p>
            </div>

            <div class="card">
                <h3>Mejorar tu comunidad</h3>
                <p>
                    Contribuye activamente a la solución de problemas en tu entorno mediante
                    una comunicación más eficiente.
                </p>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/../../includes/footer.php"; ?>