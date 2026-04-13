<?php
require_once __DIR__ . "/../../config/database.php";

class Seguimiento
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create($data)
    {
        $sql = "INSERT INTO tablaSeguimientos 
                (id_reporte, id_usuario, comentario)
                VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        $stmt->bind_param(
            "iis",
            $data["id_reporte"],
            $data["id_usuario"],
            $data["comentario"]
        );
        if (!$stmt->execute()) {
            die("Error en execute: " . $stmt->error);
        }
        return true;
    }

    public function getByReporte($idReporte)
    {
        $sql = "SELECT 
                    s.id_seguimiento,
                    s.id_reporte,
                    s.id_usuario,
                    s.comentario,
                    s.fecha_actualizacion,
                    u.nombre AS nombre_usuario
                FROM tablaSeguimientos s
                INNER JOIN tablaUsuarios u ON s.id_usuario = u.id_usuario
                WHERE s.id_reporte = ?
                ORDER BY s.fecha_actualizacion DESC";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        $stmt->bind_param("i", $idReporte);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $seguimientos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $seguimientos[] = $fila;
        }
        return $seguimientos;
    }

    public function getUltimos($limite = 5)
    {
        $limite = (int) $limite;
        $sql = "SELECT 
                    s.id_seguimiento,
                    s.id_reporte,
                    s.id_usuario,
                    s.comentario,
                    s.fecha_actualizacion,
                    u.nombre AS nombre_usuario
                FROM tablaSeguimientos s
                INNER JOIN tablaUsuarios u ON s.id_usuario = u.id_usuario
                ORDER BY s.fecha_actualizacion DESC
                LIMIT $limite";

        $resultado = $this->conn->query($sql);
        if (!$resultado) {
            die("Error en query: " . $this->conn->error);
        }
        return $resultado;
    }

    public function getUltimosByUsuario($idUsuario, $limite = 5)
    {
        $limite = (int) $limite;
        $sql = "SELECT 
                    s.id_seguimiento,
                    s.id_reporte,
                    s.id_usuario,
                    s.comentario,
                    s.fecha_actualizacion,
                    u.nombre AS nombre_usuario
                FROM tablaSeguimientos s
                INNER JOIN tablaUsuarios u ON s.id_usuario = u.id_usuario
                INNER JOIN tablaReportes r ON s.id_reporte = r.id_reporte
                WHERE r.id_usuario = ?
                ORDER BY s.fecha_actualizacion DESC
                LIMIT $limite";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        return $stmt->get_result();
    }
}