<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}else {

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $especie = $_POST['especie'];
    $genero = $_POST['genero'];
    $afiliacion = $_POST['afiliacion'];

    // Conectar a la base de datos
    require("../Conexion.php");
    $cn = Conexion::conectar();

    if (!$cn) {
        die("Error al conectar a la base de datos");
    }

    // Sentencia SQL con marcadores de posición
    $sql = "INSERT INTO personajes (nombre, especie, genero, afiliacion) VALUES (:nombre, :especie, :genero, :afiliacion)";

    // Preparar la sentencia
    $consulta = $cn->prepare($sql); // Aquí cambiamos $conexion a $cn

    // Vincular parámetros
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':especie', $especie);
    $consulta->bindParam(':genero', $genero);
    $consulta->bindParam(':afiliacion', $afiliacion);

    // Ejecutar la consulta
    $resultado = $consulta->execute();

    header('Location: ../admin.php');
}

header("Location: ../admin.php");
    exit;
}
?>

