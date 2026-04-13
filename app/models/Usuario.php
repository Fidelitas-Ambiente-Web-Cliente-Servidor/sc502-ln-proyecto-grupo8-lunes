<?php
require_once __DIR__ . "/../../config/database.php";

class Usuario
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getByCorreo($correo)
    {
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

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        }

        return null;
    }

    public function create($data)
    {
        $sql = "INSERT INTO tablaUsuarios (nombre, correo, contrasena, id_rol)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }

        $stmt->bind_param(
            "sssi",
            $data["nombre"],
            $data["correo"],
            $data["contrasena"],
            $data["id_rol"]
        );

        if (!$stmt->execute()) {
            die("Error en execute: " . $stmt->error);
        }

        return $this->conn->insert_id;
    }
}