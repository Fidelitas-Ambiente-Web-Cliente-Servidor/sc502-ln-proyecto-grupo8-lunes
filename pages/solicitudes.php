<?php
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";


$solicitudes = [
  ["id" => 1, "asunto" => "Fuga de agua", "tipo" => "Mantenimiento", "prioridad" => "Alta", "estado" => "Pendiente", "fecha" => "2026-03-03"],
  ["id" => 2, "asunto" => "Ruido en horario nocturno", "tipo" => "Convivencia", "prioridad" => "Media", "estado" => "En revisión", "fecha" => "2026-03-02"],
];
?>

<main class="container">
  <h2>Solicitudes</h2>
  <p class="lead">Registrá una nueva solicitud y revisá el listado.</p>

  <section class="panel">
    <h3>Nueva solicitud</h3>

    <form class="form" method="post" action="#">
      <div class="grid">
        <div class="field">
          <label>Asunto</label>
          <input type="text" name="asunto" placeholder="Ej: Cambio de bombillo en pasillo" required>
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
          <textarea name="descripcion" rows="4" placeholder="Describa la situación..." required></textarea>
        </div>
      </div>

      <button class="btn" type="submit">Guardar solicitud</button>
      <p class="note">* En esta etapa el formulario es demostrativo (se conecta a BD en el siguiente avance).</p>
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
        </tr>
      </thead>
      <tbody>
        <?php foreach ($solicitudes as $s): ?>
          <tr>
            <td><?php echo $s["id"]; ?></td>
            <td><?php echo htmlspecialchars($s["asunto"]); ?></td>
            <td><?php echo $s["tipo"]; ?></td>
            <td class="prioridad-<?php echo strtolower($s["prioridad"]); ?>">
              <?php echo $s["prioridad"]; ?>
            </td>

            <td class="estado-<?php echo str_replace(" ", "", strtolower($s["estado"])); ?>">
              <?php echo $s["estado"]; ?>
            </td>
            <td><?php echo $s["fecha"]; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>