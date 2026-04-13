<?php
require_once __DIR__ . "/../../../includes/header.php";
require_once __DIR__ . "/../../../includes/navbar.php";
?>

<main class="container">
    <h2>Detalle del reporte</h2>

    <section class="panel">
        <div class="grid">
            <div class="field">
                <label>Asunto</label>
                <input type="text" value="<?= htmlspecialchars($reporte["asunto"]); ?>" disabled>
            </div>

            <div class="field">
                <label>Categoría</label>
                <input type="text" value="<?= htmlspecialchars($reporte["categoria"]); ?>" disabled>
            </div>

            <div class="field">
                <label>Prioridad</label>
                <input type="text" value="<?= htmlspecialchars($reporte["prioridad"]); ?>" disabled>
            </div>

            <div class="field">
                <label>Estado</label>
                <input type="text" value="<?= htmlspecialchars($reporte["estado"]); ?>" disabled>
            </div>

            <div class="field">
                <label>Fecha de creación</label>
                <input type="text" value="<?= htmlspecialchars($reporte["fecha_creacion"]); ?>" disabled>
            </div>

            <div class="field">
                <label>Fecha límite</label>
                <input type="text" value="<?= !empty($reporte["fecha_limite"]) ? htmlspecialchars($reporte["fecha_limite"]) : "Sin asignar"; ?>" disabled>
            </div>

            <div class="field field-full">
                <label>Descripción</label>
                <textarea disabled><?= htmlspecialchars($reporte["descripcion"]); ?></textarea>
            </div>
        </div>
    </section>

    <section class="panel">
        <h3>Agregar seguimiento</h3>

        <form class="form" method="POST" action="index.php?page=guardar_seguimiento" id="form-seguimiento">
            <input type="hidden" name="id_reporte" value="<?= $reporte["id_reporte"]; ?>">

            <div class="grid">
                <div class="field field-full">
                    <label>Comentario</label>
                    <textarea name="comentario" required></textarea>
                </div>
            </div>

            <button class="btn" type="submit">Guardar seguimiento</button>
        </form>
    </section>

    <section class="panel">
        <h3>Historial de seguimiento</h3>

        <?php if (!empty($seguimientos)): ?>
            <div class="timeline">
                <?php foreach ($seguimientos as $seg): ?>
                    <div class="timeline-item">
                        <h4><?= htmlspecialchars($seg["nombre_usuario"]); ?></h4>
                        <p><?= htmlspecialchars($seg["comentario"]); ?></p>
                        <div class="meta"><?= htmlspecialchars($seg["fecha_actualizacion"]); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No hay seguimientos registrados para este reporte.</p>
        <?php endif; ?>
    </section>

    <a href="index.php?page=reportes" class="btn" style="background:#6b7280;">Volver</a>
</main>

<?php require_once __DIR__ . "/../../../includes/footer.php"; ?>