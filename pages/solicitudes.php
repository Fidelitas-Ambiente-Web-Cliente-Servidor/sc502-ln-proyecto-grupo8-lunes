<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["usuario"])) {
    header("Location: /login.php");
    exit;
}

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

$mensaje = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $asunto = trim($_POST["asunto"] ?? "");
    $tipo = trim($_POST["tipo"] ?? "");
    $prioridad = trim($_POST["prioridad"] ?? "");
    $fecha = trim($_POST["fecha"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");
    $estado = "Pendiente";
    $id_usuario = $_SESSION["usuario"]["id"];

    if (
        empty($asunto) ||
        empty($tipo) ||
        empty($prioridad) ||
        empty($fecha) ||
        empty($descripcion)
    ) {
        $error = "Todos los campos son obligatorios.";
    } else {
        $sqlInsert = "INSERT INTO solicitudes 
            (asunto, descripcion, tipo, prioridad, fecha_creacion, estado, id_usuario)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param(
            "ssssssi",
            $asunto,
            $descripcion,
            $tipo,
            $prioridad,
            $fecha,
            $estado,
            $id_usuario
        );

        if ($stmtInsert->execute()) {
            $mensaje = "Solicitud guardada correctamente.";
        } else {
            $error = "Error al guardar la solicitud: " . $stmtInsert->error;
        }

        $stmtInsert->close();
    }
}

$sqlSelect = "SELECT id_solicitud, asunto, tipo, prioridad, estado, fecha_creacion
              FROM solicitudes
              ORDER BY id_solicitud DESC";
$resultado = $conn->query($sqlSelect);
?>

<div class="container" style="padding-bottom: 0;">
    <a href="<?= $BASE ?>/dashboard.php" class="btn" style="display:inline-block; text-decoration:none; margin-top:10px;">
        ← Volver al panel
    </a>
</div>

<main class="container">
    <h2>Solicitudes</h2>
    <p class="lead">Registrá una nueva solicitud y revisá el listado.</p>

    <?php if (!empty($mensaje)): ?>
        <div class="panel" style="margin-bottom: 18px; border-left: 5px solid #16a34a;">
            <p style="color:#166534; font-weight:bold; margin:0;"><?= htmlspecialchars($mensaje) ?></p>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="panel" style="margin-bottom: 18px; border-left: 5px solid #dc2626;">
            <p style="color:#991b1b; font-weight:bold; margin:0;"><?= htmlspecialchars($error) ?></p>
        </div>
    <?php endif; ?>

    <section class="panel">
        <h3>Nueva solicitud</h3>

        <form class="form" method="post" action="">
            <div class="grid">
                <div class="field">
                    <label>Asunto</label>
                    <input type="text" name="asunto" required>
                </div>

                <div class="field">
                    <label>Tipo</label>
                    <select name="tipo" required>
                        <option value="">Seleccione...</option>
                        <option>Mantenimiento</option>
                        <option>Seguridad</option>
                        <option>Convivencia</option>
                        <option>Administración</option>
                    </select>
                </div>

                <div class="field">
                    <label>Prioridad</label>
                    <select name="prioridad" required>
                        <option value="">Seleccione...</option>
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
                    <textarea name="descripcion" rows="4" required></textarea>
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
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <?php while ($s = $resultado->fetch_assoc()): ?>
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

                            <!-- 🔥 AQUÍ ESTABA LO QUE TE FALTABA -->
                            <td>
                                <a href="<?= $BASE ?>/pages/editar_solicitud.php?id=<?= $s["id_solicitud"]; ?>"
                                   class="btn"
                                   style="padding:6px 10px; font-size:14px; text-decoration:none;">
                                    Editar
                                </a>

                                <a href="<?= $BASE ?>/pages/eliminar_solicitud.php?id=<?= $s["id_solicitud"]; ?>"
                                   class="btn"
                                   style="padding:6px 10px; font-size:14px; background:#dc2626; margin-left:6px;"
                                   onclick="return confirm('¿Eliminar esta solicitud?');">
                                    Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">
                            No hay solicitudes registradas todavía.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>