<?php
session_start();

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'home':
        require_once "app/views/home.php";
        break;

    case "login":
        require_once "app/controllers/AuthController.php";
        (new AuthController())->showLogin();
        break;

    case "procesar_login":
        require_once "app/controllers/AuthController.php";
        (new AuthController())->login();
        break;

    case "logout":
        require_once "app/controllers/AuthController.php";
        (new AuthController())->logout();
        break;

    case 'dashboard':
        require_once "app/controllers/DashboardController.php";
        (new DashboardController())->index();
        break;

    case 'reportes':
        require_once "app/controllers/ReporteController.php";
        (new ReporteController())->index();
        break;

    case 'guardar_reporte':
        require_once "app/controllers/ReporteController.php";
        (new ReporteController())->store();
        break;

    case 'cambiar_estado':
        require_once "app/controllers/ReporteController.php";
        (new ReporteController())->cambiarEstado();
        break;

    case 'asignar_fecha_limite':
        require_once "app/controllers/ReporteController.php";
        (new ReporteController())->asignarFechaLimite();
        break;

    case 'guardar_seguimiento':
        require_once "app/controllers/SeguimientoController.php";
        (new SeguimientoController())->store();
        break;

    case 'ver_seguimiento':
        require_once "app/controllers/SeguimientoController.php";
        (new SeguimientoController())->listarPorReporte();
        break;

    case 'nosotros':
        require_once "app/views/nosotros.php";
        break;

    case 'contacto':
        require_once "app/views/contacto.php";
        break;

    case "register":
        require_once "app/controllers/AuthController.php";
        (new AuthController())->showRegister();
        break;

    case "procesar_register":
        require_once "app/controllers/AuthController.php";
        (new AuthController())->register();
        break;

    case 'ver_reporte':
        require_once "app/controllers/ReporteController.php";
        (new ReporteController())->ver();
        break;

    default:
        require_once "app/views/home.php";
        break;
}