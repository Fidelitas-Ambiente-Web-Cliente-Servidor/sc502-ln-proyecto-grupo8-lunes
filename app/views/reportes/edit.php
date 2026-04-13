<?php
require_once __DIR__ . "/../../../includes/header.php";
require_once __DIR__ . "/../../../includes/navbar.php";
?>

<main class="container">
    <h2>Detalle del reporte</h2>

    <section class="panel">
        <form class="form" method="POST" action="index.php?page=cambiar_estado" id="form-estado-reporte">
            <input type="hidden" name="id" value="<?= $reporte["id_reporte"]; ?>">

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
                    <label>Fecha de creación</label>
                    <input type="text" value="<?= htmlspecialchars($reporte["fecha_creacion"]); ?>" disabled>
                </div>

                <div class="field">
                    <label>Fecha límite</label>
                    <input type="text"
                        value="<?= !empty($reporte["fecha_limite"]) ? htmlspecialchars($reporte["fecha_limite"]) : 'Sin asignar'; ?>"
                        disabled>
                </div>

                <div class="field">
                    <label>Estado</label>
                    <?php if ($_SESSION["usuario"]["rol"] == 1): ?>
                        <select name="estado" required>
                            <option <?= $reporte["estado"] == "Pendiente" ? "selected" : "" ?>>Pendiente</option>
                            <option <?= $reporte["estado"] == "En proceso" ? "selected" : "" ?>>En proceso</option>
                            <option <?= $reporte["estado"] == "Resuelto" ? "selected" : "" ?>>Resuelto</option>
                        </select>
                    <?php else: ?>
                        <input type="text" value="<?= htmlspecialchars($reporte["estado"]); ?>" disabled>
                    <?php endif; ?>
                </div>

                <div class="field field-full">
                    <label>Descripción</label>
                    <textarea disabled><?= htmlspecialchars($reporte["descripcion"]); ?></textarea>
                </div>
            </div>

            <?php if ($_SESSION["usuario"]["rol"] == 1): ?>
                <button class="btn" type="submit">Actualizar estado</button>
            <?php endif; ?>

            <a href="index.php?page=reportes" class="btn" style="background:#6b7280;">Volver</a>
        </form>
    </section>

    <?php if ($_SESSION["usuario"]["rol"] == 1): ?>
        <section class="panel">
            <h3>Asignar fecha límite</h3>

            <form class="form" method="POST" action="index.php?page=asignar_fecha_limite" id="form-fecha-limite">
                <input type="hidden" name="id" value="<?= $reporte["id_reporte"]; ?>">

                <div class="grid">
                    <div class="field">
                        <label>Fecha límite</label>
                        <input type="date" name="fecha_limite"
                            value="<?= !empty($reporte["fecha_limite"]) ? htmlspecialchars($reporte["fecha_limite"]) : ''; ?>"
                            required>
                    </div>
                </div>

                <button class="btn" type="submit">Guardar fecha límite</button>
            </form>
        </section>
    <?php endif; ?>

    <section class="panel">
        <h3>Agregar seguimiento</h3>

        <form class="form" method="POST" action="index.php?page=guardar_seguimiento" id="form-seguimiento">
            <input type="hidden" name="id_reporte" value="<?= $reporte["id_reporte"]; ?>">

            <div class="grid">
                <div class="field field-full">
                    <label>Comentario</label>
                    <textarea name="comentario" required
                        placeholder="Escribe una actualización o comentario sobre el reporte"></textarea>
                </div>
            </div>

            <button class="btn" type="submit">Guardar seguimiento</button>
        </form>
    </section>

    <section class="panel">
        <h3>Historial de seguimiento</h3>

        <?php if (!empty($seguimientos)): ?>
            <div class="cards">
                <?php foreach ($seguimientos as $seg): ?>
                    <div class="card">
                        <h3><?= htmlspecialchars($seg["nombre_usuario"]); ?></h3>
                        <p><?= htmlspecialchars($seg["comentario"]); ?></p>
                        <p class="note">Fecha: <?= htmlspecialchars($seg["fecha_actualizacion"]); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No hay seguimientos registrados para este reporte.</p>
        <?php endif; ?>
    </section>
</main>

<script src="<?= $BASE ?>/assets/js/reportes.js"></script>

<?php require_once __DIR__ . "/../../../includes/footer.php"; ?>