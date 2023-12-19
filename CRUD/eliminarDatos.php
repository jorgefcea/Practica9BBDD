<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}else {

include_once('../Conexion.php');

// Verifica si se proporciona un ID válido a través de GET
if (isset($_GET['Id']) && is_numeric($_GET['Id'])) {
    $id = $_GET['Id'];

    $sql = "DELETE FROM personajes WHERE id = :id";

    $cn = Conexion::conectar();
    $stmt = $cn->prepare($sql);

    // Enlaza el parámetro
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Ejecuta la consulta
    try {
        $stmt->execute();
        header('Location: ../admin.php');
    } catch (PDOException $e) {
        echo "Error en la ejecución de la consulta: " . $e->getMessage();
    }
} else {
    echo "ID no proporcionado o no válido.";
}

header("Location: ../admin.php");
    exit;
}
?>
