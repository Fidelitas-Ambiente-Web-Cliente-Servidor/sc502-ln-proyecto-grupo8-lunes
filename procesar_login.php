<?php
ob_start();
session_start();
require_once __DIR__ . "/config/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit;
}

$correo = trim($_POST["correo"] ?? "");
$contrasena = $_POST["contrasena"] ?? "";

$sql = "SELECT id_usuario, nombre, correo, contrasena, id_rol FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
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

        header("Location: dashboard.php");
        exit;
    }
}

header("Location: login.php?error=1");
exit;

ob_end_flush();