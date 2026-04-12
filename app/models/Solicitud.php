<?php
require_once __DIR__ . "/../../config/database.php";

class Solicitud
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // trae todas las solicitudes
    public function getAll()
    {
        $sql = "SELECT id_solicitud, asunto, tipo, prioridad, estado, fecha_creacion
                FROM tablaSolicitudes
                ORDER BY id_solicitud DESC";

        return $this->conn->query($sql);
    }

    // nueva solicitud
    public function create($data)
    {
        $sql = "INSERT INTO tablaSolicitudes 
            (asunto, descripcion, tipo, prioridad, fecha_creacion, estado, id_usuario)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ssssssi",
            $data["asunto"],
            $data["descripcion"],
            $data["tipo"],
            $data["prioridad"],
            $data["fecha"],
            $data["estado"],
            $data["id_usuario"]
        );

        return $stmt->execute();
    }

    // traer solicitud por ID
    public function getById($id)
    {
        $sql = "SELECT * FROM tablaSolicitudes WHERE id_solicitud = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    // actualiza solicitud
    public function update($id, $data)
    {
        $sql = "UPDATE tablaSolicitudes 
                SET asunto=?, descripcion=?, tipo=?, prioridad=?, fecha_creacion=?, estado=?
                WHERE id_solicitud=?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ssssssi",
            $data["asunto"],
            $data["descripcion"],
            $data["tipo"],
            $data["prioridad"],
            $data["fecha"],
            $data["estado"],
            $id
        );

        return $stmt->execute();
    }

    // eliminar
    public function delete($id)
    {
        $sql = "DELETE FROM tablaSolicitudes WHERE id_solicitud = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
    // roles
    public function getByUser($id_usuario)
    {
        $sql = "SELECT id_solicitud, asunto, tipo, prioridad, estado, fecha_creacion
            FROM tablaSolicitudes
            WHERE id_usuario = ?
            ORDER BY id_solicitud DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();

        return $stmt->get_result();
    }
    public function getResumenByUsuario($id_usuario)
    {
        $data = [];

        $queries = [
            "total" => "SELECT COUNT(*) AS total FROM tablaSolicitudes WHERE id_usuario = ?",
            "pendientes" => "SELECT COUNT(*) AS total FROM tablaSolicitudes WHERE estado = 'Pendiente' AND id_usuario = ?",
            "revision" => "SELECT COUNT(*) AS total FROM tablaSolicitudes WHERE estado = 'En revisión' AND id_usuario = ?",
            "resueltas" => "SELECT COUNT(*) AS total FROM tablaSolicitudes WHERE estado = 'Resuelta' AND id_usuario = ?"
        ];

        foreach ($queries as $key => $sql) {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id_usuario);
            $stmt->execute();
            $res = $stmt->get_result()->fetch_assoc();
            $data[$key] = $res["total"];
        }

        return $data;
    }
}