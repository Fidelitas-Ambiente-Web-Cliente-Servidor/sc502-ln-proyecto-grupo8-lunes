<?php
require_once __DIR__ . "/../config/database.php";

class Usuario {

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }
    public function getByCorreo($correo) {
        $sql = "SELECT id_usuario, nombre, correo, contrasena, id_rol 
                FROM tablaUsuarios 
                WHERE correo = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();

        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
}