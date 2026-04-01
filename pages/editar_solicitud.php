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

$id = $_GET["id"] ?? null;
$mensaje = "";
$error = "";

if (!$id || !is_numeric($id)) {
    echo "<main class='container'><p>ID de solicitud no válido.</p></main>";
    require_once __DIR__ . "/../includes/footer.php";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $asunto = trim($_POST["asunto"] ?? "");
    $tipo = trim($_POST["tipo"] ?? "");
    $prioridad = trim($_POST["prioridad"] ?? "");
    $fecha = trim($_POST["fecha"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");
    $estado = trim($_POST["estado"] ?? "Pendiente");

    if (
        empty($asunto) ||
        empty($tipo) ||
        empty($prioridad) ||
        empty($fecha) ||
        empty($descripcion) ||
        empty($estado)
    ) {
        $error = "Todos los campos son obligatorios.";
    } else {
        $sqlUpdate = "UPDATE solicitudes 
                      SET asunto = ?, descripcion = ?, tipo = ?, prioridad = ?, fecha_creacion = ?, estado = ?
                      WHERE id_solicitud = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param(
            "ssssssi",
            $asunto,
            $descripcion,
            $tipo,
            $prioridad,
            $fecha,
            $estado,
            $id
        );

        if ($stmtUpdate->execute()) {
            $mensaje = "Solicitud actualizada correctamente.";
        } else {
            $error = "Error al actualizar la solicitud.";
        }

        $stmtUpdate->close();
    }
}

$sql = "SELECT * FROM solicitudes WHERE id_solicitud = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$solicitud = $resultado->fetch_assoc();
$stmt->close();

if (!$solicitud) {
    echo "<main class='container'><p>Solicitud no encontrada.</p></main>";
    require_once __DIR__ . "/../includes/footer.php";
    exit;
}
?>

<div class="container" style="padding-bottom: 0;">
    <a href="<?= $BASE ?>/pages/solicitudes.php" class="btn" style="display:inline-block; text-decoration:none; margin-top:10px;">
        ← Volver a solicitudes
    </a>
</div>

<main class="container">
    <h2>Editar solicitud</h2>

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
        <form class="form" method="post" action="">
            <div class="grid">
                <div class="field">
                    <label>Asunto</label>
                    <input type="text" name="asunto" value="<?= htmlspecialchars($solicitud["asunto"]); ?>" required>
                </div>

                <div class="field">
                    <label>Tipo</label>
                    <select name="tipo" required>
                        <option value="Mantenimiento" <?= $solicitud["tipo"] === "Mantenimiento" ? "selected" : ""; ?>>Mantenimiento</option>
                        <option value="Seguridad" <?= $solicitud["tipo"] === "Seguridad" ? "selected" : ""; ?>>Seguridad</option>
                        <option value="Convivencia" <?= $solicitud["tipo"] === "Convivencia" ? "selected" : ""; ?>>Convivencia</option>
                        <option value="Administración" <?= $solicitud["tipo"] === "Administración" ? "selected" : ""; ?>>Administración</option>
                    </select>
                </div>

                <div class="field">
                    <label>Prioridad</label>
                    <select name="prioridad" required>
                        <option value="Alta" <?= $solicitud["prioridad"] === "Alta" ? "selected" : ""; ?>>Alta</option>
                        <option value="Media" <?= $solicitud["prioridad"] === "Media" ? "selected" : ""; ?>>Media</option>
                        <option value="Baja" <?= $solicitud["prioridad"] === "Baja" ? "selected" : ""; ?>>Baja</option>
                    </select>
                </div>

                <div class="field">
                    <label>Fecha</label>
                    <input type="date" name="fecha" value="<?= htmlspecialchars($solicitud["fecha_creacion"]); ?>" required>
                </div>

                <div class="field">
                    <label>Estado</label>
                    <select name="estado" required>
                        <option value="Pendiente" <?= $solicitud["estado"] === "Pendiente" ? "selected" : ""; ?>>Pendiente</option>
                        <option value="En revisión" <?= $solicitud["estado"] === "En revisión" ? "selected" : ""; ?>>En revisión</option>
                        <option value="Resuelta" <?= $solicitud["estado"] === "Resuelta" ? "selected" : ""; ?>>Resuelta</option>
                    </select>
                </div>

                <div class="field field-full">
                    <label>Descripción</label>
                    <textarea name="descripcion" rows="4" required><?= htmlspecialchars($solicitud["descripcion"]); ?></textarea>
                </div>
            </div>

            <button class="btn" type="submit">Actualizar solicitud</button>
        </form>
    </section>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>