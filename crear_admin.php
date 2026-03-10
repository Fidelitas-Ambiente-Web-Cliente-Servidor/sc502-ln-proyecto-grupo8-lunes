<?php
require_once __DIR__ . "/config/database.php";

$nuevaPassword = "admin123";
$hash = password_hash($nuevaPassword, PASSWORD_DEFAULT);

$sql = "UPDATE usuarios SET contrasena = ? WHERE correo = ?";
$stmt = $conn->prepare($sql);

$correo = "admin@condominio.com";
$stmt->bind_param("ss", $hash, $correo);

if ($stmt->execute()) {
    echo "Contraseña del administrador actualizada correctamente.<br>";
    echo "Usuario: admin@condominio.com<br>";
    echo "Contraseña: admin123";
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>