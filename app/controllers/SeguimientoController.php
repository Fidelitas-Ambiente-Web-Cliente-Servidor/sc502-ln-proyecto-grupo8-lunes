<?php
require_once __DIR__ . "/../models/Seguimiento.php";
require_once __DIR__ . "/../models/Reporte.php";

class SeguimientoController
{
    private $model;
    private $reporteModel;

    public function __construct()
    {
        if (!isset($_SESSION["usuario"])) {
            header("Location: index.php?page=login");
            exit;
        }
        $this->model = new Seguimiento();
        $this->reporteModel = new Reporte();
    }

    public function store()
    {
        if (empty($_POST["id_reporte"]) || empty($_POST["comentario"])) {
            return $this->response(false, "Todos los campos son obligatorios.");
        }
        $idReporte = (int) $_POST["id_reporte"];
        $comentario = trim($_POST["comentario"]);
        if ($comentario === "") {
            return $this->response(false, "El comentario no puede ir vacío.");
        }
        $reporte = $this->reporteModel->getById($idReporte);
        if (!$reporte) {
            return $this->response(false, "El reporte no existe.");
        }

        $rol = $_SESSION["usuario"]["rol"];
        $idUsuario = $_SESSION["usuario"]["id"];
        if ($rol != 1 && $reporte["id_usuario"] != $idUsuario) {
            return $this->response(false, "No autorizado.");
        }
        $ok = $this->model->create([
            "id_reporte" => $idReporte,
            "id_usuario" => $idUsuario,
            "comentario" => $comentario
        ]);
        if (!$ok) {
            return $this->response(false, "No se pudo guardar el seguimiento.");
        }
        return $this->response(true, "Seguimiento agregado correctamente.");
    }

    public function listarPorReporte()
    {
        if (empty($_GET["id_reporte"])) {
            return $this->response(false, "Reporte no válido.");
        }
        $idReporte = (int) $_GET["id_reporte"];
        $reporte = $this->reporteModel->getById($idReporte);
        if (!$reporte) {
            return $this->response(false, "El reporte no existe.");
        }
        $rol = $_SESSION["usuario"]["rol"];
        $idUsuario = $_SESSION["usuario"]["id"];
        if ($rol != 1 && $reporte["id_usuario"] != $idUsuario) {
            return $this->response(false, "No autorizado.");
        }
        $seguimientos = $this->model->getByReporte($idReporte);
        if ($this->isAjax()) {
            header("Content-Type: application/json");
            echo json_encode([
                "success" => true,
                "seguimientos" => $seguimientos
            ]);
            exit;
        }
        require __DIR__ . "/../views/seguimientos/index.php";
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
}