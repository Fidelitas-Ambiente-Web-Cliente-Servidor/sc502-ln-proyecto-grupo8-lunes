<?php
require_once __DIR__ . "/../../../includes/header.php";
require_once __DIR__ . "/../../../includes/navbar.php";
?>

<main class="container">
    <h2>Reportes</h2>

    <section class="panel">
        <h3>Nuevo reporte</h3>

        <div id="mensaje-reporte"></div>

        <form class="form" method="POST" action="index.php?page=guardar_reporte" id="form-reporte">
            <div class="grid">
                <div class="field">
                    <label>Asunto</label>
                    <input type="text" name="asunto" required>
                </div>

                <div class="field">
                    <label>Categoría</label>
                    <select name="categoria" required>
                        <option value="">Seleccione una categoría</option>
                        <option>Basura</option>
                        <option>Agua</option>
                        <option>Seguridad</option>
                        <option>Infraestructura</option>
                    </select>
                </div>

                <div class="field">
                    <label>Prioridad</label>
                    <select name="prioridad" required>
                        <option value="">Seleccione una prioridad</option>
                        <option>Alta</option>
                        <option>Media</option>
                        <option>Baja</option>
                    </select>
                </div>

                <div class="field field-full">
                    <label>Descripción</label>
                    <textarea name="descripcion" required></textarea>
                </div>
            </div>

            <button class="btn" type="submit">Guardar reporte</button>
        </form>
    </section>

    <section class="panel">
        <h3>Filtrar reportes</h3>

        <form class="form" method="GET" action="index.php">
            <input type="hidden" name="page" value="reportes">

            <div class="grid">
                <div class="field">
                    <label>Estado</label>
                    <select name="estado">
                        <option value="">Todos</option>
                        <option value="Pendiente" <?= (($_GET["estado"] ?? "") === "Pendiente") ? "selected" : "" ?>>
                            Pendiente</option>
                        <option value="En proceso" <?= (($_GET["estado"] ?? "") === "En proceso") ? "selected" : "" ?>>En
                            proceso</option>
                        <option value="Resuelto" <?= (($_GET["estado"] ?? "") === "Resuelto") ? "selected" : "" ?>>Resuelto
                        </option>
                    </select>
                </div>

                <div class="field">
                    <label>Categoría</label>
                    <select name="categoria">
                        <option value="">Todas</option>
                        <option value="Basura" <?= (($_GET["categoria"] ?? "") === "Basura") ? "selected" : "" ?>>Basura
                        </option>
                        <option value="Agua" <?= (($_GET["categoria"] ?? "") === "Agua") ? "selected" : "" ?>>Agua</option>
                        <option value="Seguridad" <?= (($_GET["categoria"] ?? "") === "Seguridad") ? "selected" : "" ?>>
                            Seguridad</option>
                        <option value="Infraestructura" <?= (($_GET["categoria"] ?? "") === "Infraestructura") ? "selected" : "" ?>>Infraestructura</option>
                    </select>
                </div>

                <div class="field">
                    <label>Prioridad</label>
                    <select name="prioridad">
                        <option value="">Todas</option>
                        <option value="Alta" <?= (($_GET["prioridad"] ?? "") === "Alta") ? "selected" : "" ?>>Alta</option>
                        <option value="Media" <?= (($_GET["prioridad"] ?? "") === "Media") ? "selected" : "" ?>>Media
                        </option>
                        <option value="Baja" <?= (($_GET["prioridad"] ?? "") === "Baja") ? "selected" : "" ?>>Baja</option>
                    </select>
                </div>

                <div class="field">
                    <label>&nbsp;</label>
                    <button class="btn" type="submit">Aplicar filtros</button>
                </div>
            </div>
        </form>
    </section>

    <section class="panel">
        <h3>Listado de reportes</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Asunto</th>
                    <th>Categoría</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Fecha límite</th>
                    <th>Detalle</th>
                    <?php if ($_SESSION["usuario"]["rol"] == 1): ?>
                        <th>Actualizar estado</th>
                        <th>Asignar fecha límite</th>
                    <?php endif; ?>
                </tr>
            </thead>

            <tbody>
                <?php if ($reportes instanceof mysqli_result && $reportes->num_rows > 0): ?>
                    <?php while ($s = $reportes->fetch_assoc()): ?>
                        <tr>
                            <td><?= $s["id_reporte"]; ?></td>
                            <td><?= htmlspecialchars($s["asunto"]); ?></td>
                            <td><?= htmlspecialchars($s["categoria"]); ?></td>

                            <td>
                                <span class="prioridad-<?= strtolower($s["prioridad"]); ?>">
                                    <?= htmlspecialchars($s["prioridad"]); ?>
                                </span>
                            </td>

                            <td>
                                <span class="estado-<?= str_replace(" ", "", strtolower($s["estado"])); ?>">
                                    <?= htmlspecialchars($s["estado"]); ?>
                                </span>
                            </td>

                            <td><?= htmlspecialchars($s["fecha_creacion"]); ?></td>

                            <td>
                                <?= !empty($s["fecha_limite"]) ? htmlspecialchars($s["fecha_limite"]) : "Sin asignar" ?>
                            </td>

                            <td>
                                <a class="btn" href="index.php?page=ver_reporte&id=<?= $s["id_reporte"]; ?>">
                                    Ver
                                </a>
                            </td>

                            <?php if ($_SESSION["usuario"]["rol"] == 1): ?>
                                <td>
                                    <form method="POST" action="index.php?page=cambiar_estado" class="form-cambiar-estado">
                                        <input type="hidden" name="id" value="<?= $s["id_reporte"]; ?>">

                                        <select name="estado" required>
                                            <option value="Pendiente" <?= $s["estado"] == "Pendiente" ? "selected" : "" ?>>Pendiente
                                            </option>
                                            <option value="En proceso" <?= $s["estado"] == "En proceso" ? "selected" : "" ?>>En proceso
                                            </option>
                                            <option value="Resuelto" <?= $s["estado"] == "Resuelto" ? "selected" : "" ?>>Resuelto
                                            </option>
                                        </select>

                                        <button class="btn" type="submit">Estado</button>
                                    </form>
                                </td>

                                <td>
                                    <form method="POST" action="index.php?page=asignar_fecha_limite" class="form-fecha-limite">
                                        <input type="hidden" name="id" value="<?= $s["id_reporte"]; ?>">
                                        <input type="date" name="fecha_limite"
                                            value="<?= !empty($s["fecha_limite"]) ? htmlspecialchars($s["fecha_limite"]) : ""; ?>"
                                            required>
                                        <button class="btn" type="submit">Asignar</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="<?= $_SESSION["usuario"]["rol"] == 1 ? '10' : '8' ?>">No hay reportes</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</main>

<?php require_once __DIR__ . "/../../../includes/footer.php"; ?>