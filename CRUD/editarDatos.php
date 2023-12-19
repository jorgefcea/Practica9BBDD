<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}else {
    

include_once('../Conexion.php');

$id = isset($_POST['Id']) ? $_POST['Id'] : null;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$especie = isset($_POST['especie']) ? $_POST['especie'] : null;
$genero = isset($_POST['genero']) ? $_POST['genero'] : null;
$afiliacion = isset($_POST['afiliacion']) ? $_POST['afiliacion'] : null;

// Verifica si el ID está presente antes de ejecutar la consulta
if ($id !== null) {
    $sql = "UPDATE personajes SET 
    nombre = :nombre,
    especie = :especie,
    genero = :genero,
    afiliacion = :afiliacion
    WHERE id = :id";

    $cn = Conexion::conectar();
    $stmt = $cn->prepare($sql);

    // Enlaza los parámetros
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':especie', $especie, PDO::PARAM_STR);
    $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
    $stmt->bindParam(':afiliacion', $afiliacion, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Ejecuta la consulta
    try {
        $stmt->execute();
        header('Location: ../admin.php');
    } catch (PDOException $e) {
        echo "Error en la ejecución de la consulta: " . $e->getMessage();
    }
} else {
    echo "ID no proporcionado.";
}

header("Location: ../admin.php");
    exit;
}
?>

