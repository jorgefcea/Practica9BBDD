<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (:nombre, :correo, :contrasena)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);

        $stmt->execute();

        echo "Cuenta creada exitosamente";
    } catch (PDOException $e) {
        echo "Error al crear la cuenta: " . $e->getMessage();
    }
}
?>
