<?php
require_once __DIR__ . "/../models/Reporte.php";
require_once __DIR__ . "/../models/Seguimiento.php";

class DashboardController
{
    private $reporteModel;
    private $seguimientoModel;

    public function __construct()
    {
        $this->reporteModel = new Reporte();
        $this->seguimientoModel = new Seguimiento();
    }

    public function index()
    {
        if (!isset($_SESSION["usuario"])) {
            header("Location: index.php?page=login");
            exit;
        }

        $idUsuario = $_SESSION["usuario"]["id"];
        $rol = $_SESSION["usuario"]["rol"];

        if ($rol == 1) {
            $resumen = $this->reporteModel->getResumenAdmin();
            $ultimosReportes = $this->reporteModel->getUltimos(5);
            $ultimosSeguimientos = $this->seguimientoModel->getUltimos(5);
        } else {
            $resumen = $this->reporteModel->getResumen($idUsuario);
            $ultimosReportes = $this->reporteModel->getUltimosByUsuario($idUsuario, 5);
            $ultimosSeguimientos = $this->seguimientoModel->getUltimosByUsuario($idUsuario, 5);
        }

        require __DIR__ . "/../views/dashboard.php";
    }
}