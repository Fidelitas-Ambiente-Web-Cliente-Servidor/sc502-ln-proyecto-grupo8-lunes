<?php require_once __DIR__ . "/../../includes/header.php"; ?>
<?php require_once __DIR__ . "/../../includes/navbar.php"; ?>

<main class="container">
    <h1>Sistema de Solicitudes – Condominio</h1>
    <p class="lead">
        Bienvenido(a). Aquí podrás registrar solicitudes, dar seguimiento y consultar el estado de cada gestión.
    </p>

    <div class="cards">
        <a class="card" href="<?= $BASE ?>/index.php?page=solicitudes">
            <h3>Solicitudes</h3>
            <p>Crear y ver solicitudes registradas.</p>
        </a>

        <a class="card" href="index.php?page=nosotros">
            <h3>Nosotros</h3>
            <p>Información general del sistema.</p>
        </a>

        <a class="card" href="index.php?page=contacto">
            <h3>Contacto</h3>
            <p>Canales de contacto y soporte.</p>
        </a>
    </div>
</main>

<?php require_once __DIR__ . "/../../includes/footer.php"; ?>