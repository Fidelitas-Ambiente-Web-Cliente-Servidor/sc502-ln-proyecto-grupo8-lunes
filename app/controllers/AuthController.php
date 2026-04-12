<?php
require_once __DIR__ . "/../../config/database.php";

class AuthController
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function showLogin()
    {
        require __DIR__ . "/../views/auth/login.php";
    }

    public function login()
    {
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];

        $sql = "SELECT id_usuario, nombre, correo, contrasena, id_rol
                FROM tablaUsuarios WHERE correo = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            if (password_verify($contrasena, $usuario["contrasena"])) {
                $_SESSION["usuario"] = [
                    "id" => $usuario["id_usuario"],
                    "nombre" => $usuario["nombre"],
                    "correo" => $usuario["correo"],
                    "rol" => $usuario["id_rol"]
                ];

                header("Location: index.php?page=dashboard");
                exit;
            }
        }

        header("Location: index.php?page=login&error=1");
        exit;
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    }
}