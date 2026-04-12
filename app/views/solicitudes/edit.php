<?php
require_once __DIR__ . "/../../../includes/header.php";
require_once __DIR__ . "/../../../includes/navbar.php";
?>

<main class="container">
    <h2>Editar solicitud</h2>

    <section class="panel">
        <form class="form" method="POST" action="index.php?page=actualizar_solicitud">

            <input type="hidden" name="id" value="<?= $solicitud["id_solicitud"]; ?>">

            <div class="grid">
                <div class="field">
                    <label>Asunto</label>
                    <input type="text" name="asunto" value="<?= htmlspecialchars($solicitud["asunto"]); ?>" required>
                </div>

                <div class="field">
                    <label>Tipo</label>
                    <select name="tipo" required>
                        <option <?= $solicitud["tipo"] == "Mantenimiento" ? "selected" : "" ?>>Mantenimiento</option>
                        <option <?= $solicitud["tipo"] == "Seguridad" ? "selected" : "" ?>>Seguridad</option>
                        <option <?= $solicitud["tipo"] == "Convivencia" ? "selected" : "" ?>>Convivencia</option>
                        <option <?= $solicitud["tipo"] == "Administración" ? "selected" : "" ?>>Administración</option>
                    </select>
                </div>

                <div class="field">
                    <label>Prioridad</label>
                    <select name="prioridad" required>
                        <option <?= $solicitud["prioridad"] == "Alta" ? "selected" : "" ?>>Alta</option>
                        <option <?= $solicitud["prioridad"] == "Media" ? "selected" : "" ?>>Media</option>
                        <option <?= $solicitud["prioridad"] == "Baja" ? "selected" : "" ?>>Baja</option>
                    </select>
                </div>

                <div class="field">
                    <label>Fecha</label>
                    <input type="date" name="fecha" value="<?= htmlspecialchars($solicitud["fecha_creacion"]); ?>" required>
                </div>

                <div class="field">
                    <label>Estado</label>
                    <select name="estado" required>
                        <option <?= $solicitud["estado"] == "Pendiente" ? "selected" : "" ?>>Pendiente</option>
                        <option <?= $solicitud["estado"] == "En revisión" ? "selected" : "" ?>>En revisión</option>
                        <option <?= $solicitud["estado"] == "Resuelta" ? "selected" : "" ?>>Resuelta</option>
                    </select>
                </div>

                <div class="field field-full">
                    <label>Descripción</label>
                    <textarea name="descripcion" required><?= htmlspecialchars($solicitud["descripcion"]); ?></textarea>
                </div>
            </div>

            <button class="btn" type="submit">Actualizar</button>
            <a href="index.php?page=solicitudes" class="btn" style="background:#6b7280;">Cancelar</a>
        </form>
    </section>
</main>

<?php require_once __DIR__ . "/../../../includes/footer.php"; ?>