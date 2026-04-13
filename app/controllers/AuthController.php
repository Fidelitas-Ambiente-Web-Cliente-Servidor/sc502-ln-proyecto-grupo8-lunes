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

    public function showRegister()
    {
        require __DIR__ . "/../views/auth/register.php";
    }

    public function login()
    {
        if (empty($_POST["correo"]) || empty($_POST["contrasena"])) {
            header("Location: index.php?page=login&error=1");
            exit;
        }

        $correo = trim($_POST["correo"]);
        $contrasena = $_POST["contrasena"];

        $sql = "SELECT id_usuario, nombre, correo, contrasena, id_rol
                FROM tablaUsuarios
                WHERE correo = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }

        $stmt->bind_param("s", $correo);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado && $resultado->num_rows === 1) {
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

    public function register()
    {
        if (
            empty($_POST["nombre"]) ||
            empty($_POST["correo"]) ||
            empty($_POST["contrasena"])
        ) {
            header("Location: index.php?page=register&error=1");
            exit;
        }

        $nombre = trim($_POST["nombre"]);
        $correo = trim($_POST["correo"]);
        $contrasena = $_POST["contrasena"];

        $sqlCheck = "SELECT id_usuario FROM tablaUsuarios WHERE correo = ?";
        $stmtCheck = $this->conn->prepare($sqlCheck);

        if (!$stmtCheck) {
            die("Error en prepare: " . $this->conn->error);
        }

        $stmtCheck->bind_param("s", $correo);
        $stmtCheck->execute();
        $resultado = $stmtCheck->get_result();

        if ($resultado && $resultado->num_rows > 0) {
            header("Location: index.php?page=register&error=2");
            exit;
        }

        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $idRol = 2; // 1 = admin 2 = usuario

        $sql = "INSERT INTO tablaUsuarios (nombre, correo, contrasena, id_rol)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }

        $stmt->bind_param("sssi", $nombre, $correo, $hash, $idRol);

        if (!$stmt->execute()) {
            die("Error en execute: " . $stmt->error);
        }

        header("Location: index.php?page=login&success=1");
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