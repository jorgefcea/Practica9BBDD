<?php
session_start();
// Verificar si el usuario está autenticado
if (!isset($_SESSION["usuario"])) {
    // Si no hay información del usuario en la sesión, redirigir a la página de inicio de sesión.
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
        <div id="titulo-container">
            <h2>🌌 ¡Bienvenid@ de nuevo <?php echo $_SESSION["usuario"]["nombre"]; ?>! 🌌</h2>
        </div>
        <form action="CRUD/insertarDatos.php" id="formulario" method="POST">
            <div id="fila1">
                <div id="nombre">
                    <p>Nombre:</p>
                    <input type="text" placeholder="Nombre" name="nombre">
                </div>
                <br>
                <div id="especie">
                    <p>Especie:</p>
                    <input type="text" placeholder="Especie" name="especie">
                </div>
            </div>
            <br>
            <div id="fila1">
                <div id="genero">
                    <p>Género:</p>
                    <input type="text" placeholder="Género" name="genero">
                </div>
                <br>
                <div id="afiliacion">
                    <p>Afiliación:</p>
                    <input type="text" placeholder="Afiliación" name="afiliacion">
                </div>
            </div>
            <br>
            <button type="submit" id="botonNoEstilo" class="btn btn-warning">Añadir Registro</button>
        </form>
        <br>
        <div id="boton_logout">
            <form action="logout.php" method="get">
                <button type="submit" name="boton_logout">CERRAR SESIÓN</button>           
            </form>
        </div>
        <br>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table" id="tabla">
                <thead id="tablaTitulo">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Especie</th>
                        <th scope="col">Género</th>
                        <th scope="col">Afiliación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-primary">
                    <?php
                        require("Conexion.php");

                        $cn = Conexion::conectar();

                        if (!$cn) {
                            die("Error al conectar a la base de datos");
                        }

                        $sql = $cn->query("SELECT * FROM personajes");

                        // Verificar si la consulta fue exitosa
                        if ($sql) {
                            while ($resultado = $sql->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                                <tr>
                                    <th scope="row"><?php echo $resultado['id']; ?></th>
                                    <td><?php echo $resultado['nombre']; ?></td>
                                    <td><?php echo $resultado['especie']; ?></td>
                                    <td><?php echo $resultado['genero']; ?></td>
                                    <td><?php echo $resultado['afiliacion']; ?></td>
                                    <th>
                                        <a href="editarForm.php?Id=<?php echo $resultado['id']?>" id="botonNoEstilo" class="btn btn-warning">Editar</a>
                                        <a href="CRUD/eliminarDatos.php?Id=<?php echo $resultado['id']?>" id="botonNoEstilo" class="btn btn-danger">Eliminar</a>
                                    </th>
                                </tr>
                    <?php
                            }
                        } else {
                            die("Error al ejecutar la consulta");
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function actualizarScroll() {
                // Obtén la altura del contenido de la página y de la ventana
                const alturaContenido = document.body.scrollHeight;
                const alturaVentana = window.innerHeight;

                // Desactiva el desplazamiento si el contenido no excede la altura de la ventana
                if (alturaContenido <= alturaVentana) {
                    document.body.style.overflowY = "hidden";
                } else {
                    document.body.style.overflowY = "auto";
                }
            }

            // Actualiza el scroll cuando cambie el tamaño de la ventana
            window.addEventListener("resize", actualizarScroll);

            // Llama a la función inicialmente para configurar el scroll
            actualizarScroll();
        });
    </script>
</body>
</html>