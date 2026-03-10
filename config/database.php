<?php
// Configuración de la base de datos para Docker
define("DB_HOST", "db");
define("DB_USER", "usuario_condo");
define("DB_PASS", "clave123");
define("DB_NAME", "condominio_db");

// Crear conexión
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer charset
$conn->set_charset("utf8");

// Para usar en otros archivos
function getConnection() {
    global $conn;
    return $conn;
}
?>