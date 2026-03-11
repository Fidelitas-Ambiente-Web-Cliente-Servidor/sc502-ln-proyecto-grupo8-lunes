<?php
define("DB_HOST", "db");
define("DB_USER", "usuario_condo");
define("DB_PASS", "clave123");
define("DB_NAME", "condominio_db");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");

function getConnection() {
    global $conn;
    return $conn;
}