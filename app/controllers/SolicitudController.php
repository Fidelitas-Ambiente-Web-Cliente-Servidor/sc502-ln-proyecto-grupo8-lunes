<?php
require_once __DIR__ . "/../models/Solicitud.php";
class SolicitudController
{

    private $model;

    public function __construct()
    {
        if (!isset($_SESSION["usuario"])) {
            header("Location: index.php?page=login");
            exit;
        }
        $this->model = new Solicitud();
    }

    public function index()
    {
        if ($_SESSION["usuario"]["rol"] == 1) {
            $solicitudes = $this->model->getAll();
        } else {
            $id = $_SESSION["usuario"]["id"];
            $solicitudes = $this->model->getByUser($id);
        }
        require __DIR__ . "/../views/solicitudes/index.php";
    }

    public function store()
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (empty($_POST["asunto"]) || empty($_POST["descripcion"])) {
                die("Todos los campos son obligatorios");
            }
            $data = [
                "asunto" => $_POST["asunto"],
                "descripcion" => $_POST["descripcion"],
                "tipo" => $_POST["tipo"],
                "prioridad" => $_POST["prioridad"],
                "fecha" => $_POST["fecha"],
                "estado" => "Pendiente",
                "id_usuario" => $_SESSION["usuario"]["id"]
            ];

            $this->model->create($data);

            header("Location: index.php?page=solicitudes");
            exit;
        }
    }
    public function edit()
    {
        $id = $_GET["id"];
        $solicitud = $this->model->getById($id);

        require __DIR__ . "/../views/solicitudes/edit.php";
    }

    public function update()
    {

        $id = $_POST["id"];

        $data = [
            "asunto" => $_POST["asunto"],
            "descripcion" => $_POST["descripcion"],
            "tipo" => $_POST["tipo"],
            "prioridad" => $_POST["prioridad"],
            "fecha" => $_POST["fecha"],
            "estado" => $_POST["estado"]
        ];

        $this->model->update($id, $data);

        header("Location: index.php?page=solicitudes");
    }
    public function delete()
    {
        $id = $_GET["id"];
        $this->model->delete($id);

        header("Location: index.php?page=solicitudes");
    }
}