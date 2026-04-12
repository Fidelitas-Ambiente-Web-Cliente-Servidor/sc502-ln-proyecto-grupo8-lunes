<?php
session_start();
$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'home':
        require_once "app/views/home.php";
        break;

    case "login":
        require_once "app/controllers/AuthController.php";
        $controller = new AuthController();
        $controller->showLogin();
        break;

    case "procesar_login":
        require_once "app/controllers/AuthController.php";
        $controller = new AuthController();
        $controller->login();
        break;

    case 'dashboard':
        require_once "app/controllers/DashboardController.php";
        (new DashboardController())->index();
        break;

    case 'solicitudes':
        require_once "app/controllers/SolicitudController.php";
        (new SolicitudController())->index();
        break;

    case "guardar_solicitud":
        require_once "app/controllers/SolicitudController.php";
        $controller = new SolicitudController();
        $controller->store();
        break;

    case "editar_solicitud":
        require_once "app/controllers/SolicitudController.php";
        $controller = new SolicitudController();
        $controller->edit();
        break;

    case "actualizar_solicitud":
        require_once "app/controllers/SolicitudController.php";
        $controller = new SolicitudController();
        $controller->update();
        break;

    case "eliminar_solicitud":
        require_once "app/controllers/SolicitudController.php";
        $controller = new SolicitudController();
        $controller->delete();
        break;

    case 'nosotros':
        require_once "app/views/nosotros.php";
        break;

    case 'contacto':
        require_once "app/views/contacto.php";
        break;

    case "logout":
        require_once "app/controllers/AuthController.php";
        $controller = new AuthController();
        $controller->logout();
        break;

    default:
        require_once "app/views/home.php";
        break;
}