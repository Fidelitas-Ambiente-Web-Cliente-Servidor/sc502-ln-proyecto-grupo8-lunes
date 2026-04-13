<?php
require_once __DIR__ . "/../models/Reporte.php";
require_once __DIR__ . "/../models/Seguimiento.php";

class ReporteController
{
    private $model;
    private $seguimientoModel;

    public function __construct()
    {
        if (!isset($_SESSION["usuario"])) {
            header("Location: index.php?page=login");
            exit;
        }
        $this->model = new Reporte();
        $this->seguimientoModel = new Seguimiento();
    }

    public function index()
    {
        $rol = $_SESSION["usuario"]["rol"];
        $idUsuario = $_SESSION["usuario"]["id"];
        $filtros = [
            "estado" => $_GET["estado"] ?? "",
            "categoria" => $_GET["categoria"] ?? "",
            "prioridad" => $_GET["prioridad"] ?? ""
        ];
        if ($rol == 1) {
            $reportes = $this->model->filtrar($filtros);
        } else {
            $reportes = $this->model->filtrarPorUsuario($idUsuario, $filtros);
        }
        require __DIR__ . "/../views/reportes/index.php";
    }

    public function store()
    {
        if (
            empty($_POST["asunto"]) ||
            empty($_POST["descripcion"]) ||
            empty($_POST["categoria"]) ||
            empty($_POST["prioridad"])
        ) {
            return $this->response(false, "Todos los campos son obligatorios.");
        }
        $data = [
            "asunto" => trim($_POST["asunto"]),
            "descripcion" => trim($_POST["descripcion"]),
            "categoria" => trim($_POST["categoria"]),
            "prioridad" => trim($_POST["prioridad"]),
            "estado" => "Pendiente",
            "fecha_creacion" => date("Y-m-d"),
            "fecha_limite" => null,
            "id_usuario" => $_SESSION["usuario"]["id"]
        ];
        $idReporte = $this->model->create($data);
        if (!$idReporte) {
            return $this->response(false, "No se pudo guardar el reporte.");
        }
        $this->seguimientoModel->create([
            "id_reporte" => $idReporte,
            "id_usuario" => $_SESSION["usuario"]["id"],
            "comentario" => "Reporte creado con estado Pendiente."
        ]);
        return $this->response(true, "Reporte registrado correctamente.");
    }

    public function cambiarEstado()
    {
        if (empty($_POST["id"]) || empty($_POST["estado"])) {
            return $this->response(false, "Datos inválidos.");
        }
        $idReporte = (int) $_POST["id"];
        $estado = trim($_POST["estado"]);
        $estadosPermitidos = ["Pendiente", "En proceso", "Resuelto"];
        if (!in_array($estado, $estadosPermitidos, true)) {
            return $this->response(false, "Estado no permitido.");
        }
        if ($_SESSION["usuario"]["rol"] != 1) {
            return $this->response(false, "No autorizado.");
        }
        $ok = $this->model->updateEstado($idReporte, $estado);
        if (!$ok) {
            return $this->response(false, "No se pudo actualizar el estado.");
        }
        $this->seguimientoModel->create([
            "id_reporte" => $idReporte,
            "id_usuario" => $_SESSION["usuario"]["id"],
            "comentario" => "Estado actualizado a: " . $estado
        ]);

        return $this->response(true, "Estado actualizado correctamente.");
    }

    public function asignarFechaLimite()
    {
        if ($_SESSION["usuario"]["rol"] != 1) {
            return $this->response(false, "No autorizado.");
        }
        if (empty($_POST["id"]) || empty($_POST["fecha_limite"])) {
            return $this->response(false, "Datos inválidos.");
        }
        $idReporte = (int) $_POST["id"];
        $fechaLimite = $_POST["fecha_limite"];
        $ok = $this->model->updateFechaLimite($idReporte, $fechaLimite);
        if (!$ok) {
            return $this->response(false, "No se pudo asignar la fecha límite.");
        }
        $this->seguimientoModel->create([
            "id_reporte" => $idReporte,
            "id_usuario" => $_SESSION["usuario"]["id"],
            "comentario" => "Fecha límite asignada: " . $fechaLimite
        ]);
        return $this->response(true, "Fecha límite asignada correctamente.");
    }

    private function isAjax()
    {
        return !empty($_SERVER["HTTP_X_REQUESTED_WITH"]) &&
            strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) === "xmlhttprequest";
    }

    private function response($success, $message)
    {
        if ($this->isAjax()) {
            header("Content-Type: application/json");
            echo json_encode([
                "success" => $success,
                "message" => $message
            ]);
            exit;
        }
        header("Location: index.php?page=reportes");
        exit;
    }

    public function ver()
    {
        if (empty($_GET["id"])) {
            header("Location: index.php?page=reportes");
            exit;
        }

        $id = (int) $_GET["id"];

        $reporte = $this->model->getById($id);

        if (!$reporte) {
            header("Location: index.php?page=reportes");
            exit;
        }

        $seguimientos = $this->seguimientoModel->getByReporte($id);

        require __DIR__ . "/../views/reportes/ver.php";
    }
}