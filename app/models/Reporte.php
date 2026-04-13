<?php
require_once __DIR__ . "/../../config/database.php";

class Reporte
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM tablaReportes ORDER BY id_reporte DESC";
        return $this->conn->query($sql);
    }

    public function getByUser($id)
    {
        $sql = "SELECT * 
                FROM tablaReportes 
                WHERE id_usuario = ? 
                ORDER BY id_reporte DESC";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM tablaReportes WHERE id_reporte = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function create($data)
    {
        $sql = "INSERT INTO tablaReportes 
                (asunto, descripcion, categoria, prioridad, estado, fecha_creacion, fecha_limite, id_usuario)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        $stmt->bind_param(
            "sssssssi",
            $data["asunto"],
            $data["descripcion"],
            $data["categoria"],
            $data["prioridad"],
            $data["estado"],
            $data["fecha_creacion"],
            $data["fecha_limite"],
            $data["id_usuario"]
        );

        if (!$stmt->execute()) {
            die("Error en execute: " . $stmt->error);
        }
        return $this->conn->insert_id;
    }

    public function updateEstado($id, $estado)
    {
        $sql = "UPDATE tablaReportes SET estado = ? WHERE id_reporte = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        $stmt->bind_param("si", $estado, $id);
        if (!$stmt->execute()) {
            die("Error en execute: " . $stmt->error);
        }
        return true;
    }

    public function updateFechaLimite($id, $fecha_limite)
    {
        $sql = "UPDATE tablaReportes SET fecha_limite = ? WHERE id_reporte = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        $stmt->bind_param("si", $fecha_limite, $id);
        if (!$stmt->execute()) {
            die("Error en execute: " . $stmt->error);
        }
        return true;
    }

    public function getResumen($id)
    {
        $data = [];
        $queries = [
            "total" => "SELECT COUNT(*) AS total FROM tablaReportes WHERE id_usuario = ?",
            "pendientes" => "SELECT COUNT(*) AS total FROM tablaReportes WHERE estado = 'Pendiente' AND id_usuario = ?",
            "proceso" => "SELECT COUNT(*) AS total FROM tablaReportes WHERE estado = 'En proceso' AND id_usuario = ?",
            "resueltos" => "SELECT COUNT(*) AS total FROM tablaReportes WHERE estado = 'Resuelto' AND id_usuario = ?"
        ];

        foreach ($queries as $key => $sql) {
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                die("Error en prepare: " . $this->conn->error);
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $res = $stmt->get_result()->fetch_assoc();
            $data[$key] = $res["total"];
        }
        return $data;
    }

    public function getResumenAdmin()
    {
        $data = [];
        $queries = [
            "total" => "SELECT COUNT(*) AS total FROM tablaReportes",
            "pendientes" => "SELECT COUNT(*) AS total FROM tablaReportes WHERE estado = 'Pendiente'",
            "proceso" => "SELECT COUNT(*) AS total FROM tablaReportes WHERE estado = 'En proceso'",
            "resueltos" => "SELECT COUNT(*) AS total FROM tablaReportes WHERE estado = 'Resuelto'"
        ];

        foreach ($queries as $key => $sql) {
            $resultado = $this->conn->query($sql);
            if (!$resultado) {
                die("Error en query: " . $this->conn->error);
            }
            $fila = $resultado->fetch_assoc();
            $data[$key] = $fila["total"];
        }
        return $data;
    }

    public function getUltimos($limite = 5)
    {
        $limite = (int) $limite;
        $sql = "SELECT * FROM tablaReportes ORDER BY id_reporte DESC LIMIT $limite";
        return $this->conn->query($sql);
    }

    public function getUltimosByUsuario($idUsuario, $limite = 5)
    {
        $limite = (int) $limite;
        $sql = "SELECT * 
                FROM tablaReportes 
                WHERE id_usuario = ? 
                ORDER BY id_reporte DESC 
                LIMIT $limite";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function filtrar($filtros = [])
    {
        $sql = "SELECT * FROM tablaReportes WHERE 1=1";
        $params = [];
        $types = "";
        if (!empty($filtros["estado"])) {
            $sql .= " AND estado = ?";
            $params[] = $filtros["estado"];
            $types .= "s";
        }
        if (!empty($filtros["categoria"])) {
            $sql .= " AND categoria = ?";
            $params[] = $filtros["categoria"];
            $types .= "s";
        }
        if (!empty($filtros["prioridad"])) {
            $sql .= " AND prioridad = ?";
            $params[] = $filtros["prioridad"];
            $types .= "s";
        }
        $sql .= " ORDER BY id_reporte DESC";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public function filtrarPorUsuario($idUsuario, $filtros = [])
    {
        $sql = "SELECT * FROM tablaReportes WHERE id_usuario = ?";
        $params = [$idUsuario];
        $types = "i";
        if (!empty($filtros["estado"])) {
            $sql .= " AND estado = ?";
            $params[] = $filtros["estado"];
            $types .= "s";
        }
        if (!empty($filtros["categoria"])) {
            $sql .= " AND categoria = ?";
            $params[] = $filtros["categoria"];
            $types .= "s";
        }
        if (!empty($filtros["prioridad"])) {
            $sql .= " AND prioridad = ?";
            $params[] = $filtros["prioridad"];
            $types .= "s";
        }
        $sql .= " ORDER BY id_reporte DESC";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        return $stmt->get_result();
    }
}