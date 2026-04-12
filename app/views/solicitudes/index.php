<?php
require_once __DIR__ . "/../../../includes/header.php";
require_once __DIR__ . "/../../../includes/navbar.php";
?>

<main class="container">
    <h2>Solicitudes</h2>

    <section class="panel">
        <h3>Nueva solicitud</h3>

        <form class="form" method="POST" action="<?= $BASE ?>/index.php?page=guardar_solicitud">
            <div class="grid">
                <div class="field">
                    <label>Asunto</label>
                    <input type="text" name="asunto" required>
                </div>

                <div class="field">
                    <label>Tipo</label>
                    <select name="tipo" required>
                        <option>Mantenimiento</option>
                        <option>Seguridad</option>
                        <option>Convivencia</option>
                        <option>Administración</option>
                    </select>
                </div>

                <div class="field">
                    <label>Prioridad</label>
                    <select name="prioridad" required>
                        <option>Alta</option>
                        <option>Media</option>
                        <option>Baja</option>
                    </select>
                </div>

                <div class="field">
                    <label>Fecha</label>
                    <input type="date" name="fecha" required>
                </div>

                <div class="field field-full">
                    <label>Descripción</label>
                    <textarea name="descripcion" required></textarea>
                </div>
            </div>

            <button class="btn" type="submit">Guardar solicitud</button>
        </form>
    </section>

    <section class="panel">
        <h3>Listado de solicitudes</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Asunto</th>
                    <th>Tipo</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($solicitudes && $solicitudes->num_rows > 0): ?>
                    <?php while ($s = $solicitudes->fetch_assoc()): ?>
                        <tr>
                            <td><?= $s["id_solicitud"]; ?></td>
                            <td><?= htmlspecialchars($s["asunto"]); ?></td>
                            <td><?= htmlspecialchars($s["tipo"]); ?></td>

                            <td class="prioridad-<?= strtolower($s["prioridad"]); ?>">
                                <?= htmlspecialchars($s["prioridad"]); ?>
                            </td>

                            <td class="estado-<?= str_replace(" ", "", strtolower($s["estado"])); ?>">
                                <?= htmlspecialchars($s["estado"]); ?>
                            </td>

                            <td><?= htmlspecialchars($s["fecha_creacion"]); ?></td>

                            <td>
                                <a href="<?= $BASE ?>/index.php?page=editar_solicitud&id=<?= $s["id_solicitud"]; ?>" class="btn">
                                    Editar
                                </a>

                                <a href="<?= $BASE ?>/index.php?page=eliminar_solicitud&id=<?= $s["id_solicitud"]; ?>"
                                   class="btn"
                                   style="background:#dc2626;"
                                   onclick="return confirm('¿Eliminar esta solicitud?');">
                                    Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay solicitudes</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</main>

<?php require_once __DIR__ . "/../../../includes/footer.php"; ?>