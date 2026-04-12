<?php
require_once __DIR__ . "/../models/Solicitud.php";

class DashboardController
{

    public function index()
    {

        if (!isset($_SESSION["usuario"])) {
            header("Location: index.php?page=login");
            exit;
        }

        $model = new Solicitud();

        $id = $_SESSION["usuario"]["id"];

        $resumen = $model->getResumenByUsuario($id);

        require __DIR__ . "/../views/dashboard.php";
    }
}