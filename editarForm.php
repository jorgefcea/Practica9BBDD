<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica Tema 9 - BBDD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos/estilo2.css">
</head>
<body>
    <div class="container" id="contenedor1">
    <?php
    include('Conexion.php');

    $cn = Conexion::conectar();

    $id = isset($_GET['Id']) ? $_GET['Id'] : null;

    if ($id === null) {
        header("Location: admin.php");
        exit;
    }

    $sql = "SELECT * FROM personajes WHERE id = :id";
    $stmt = $cn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <div id="titulo-container">
        <h2>🌌 Editar Registro 🌌</h2>
    </div>
    <form action="CRUD/editarDatos.php" id="formulario" method="POST">
        <div id="fila1">
            <input type="hidden" name="Id" value="<?php echo $id; ?>">
            <div id="nombre">
                <p>Nombre:</p>
                <input type="text" placeholder="Nombre" name="nombre" value="<?php echo $row['nombre']; ?>">
            </div>
            <br>
            <div id="especie">
                <p>Especie:</p>
                <input type="text" placeholder="Especie" name="especie" value="<?php echo $row['especie']; ?>">
            </div>
        </div>
        <br>
        <div id="fila1">
            <div id="genero">
                <p>Género:</p>
                <input type="text" placeholder="Género" name="genero" value="<?php echo $row['genero']; ?>">
            </div>
            <br>
            <div id="afiliacion">
                <p>Afiliación:</p>
                <input type="text" placeholder="Afiliación" name="afiliacion" value="<?php echo $row['afiliacion']; ?>">
            </div>
        </div>
        <br>
        <button type="submit" id="botonNoEstilo" class="btn btn-warning">Editar Registro</button>
    </form>
    <br>
    <div id="boton_logout">
        <form action="volver.php" method="get">
            <button type="submit" name="boton_logout">Volver</button>           
        </form>
    </div>
    <br>
</div>
</body>
</html>
