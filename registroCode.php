<?php

include 'UsuarioControlador.php';
include 'helps.php';

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["contrasena"])) {

        $nombre = validar_campo($_POST["nombre"]);
        $correo = validar_campo($_POST["correo"]);
        $contrasena = validar_campo($_POST["contrasena"]);
    
        $resultado = array("estado" => "true");
     
        if (UsuarioControlador::registrar($nombre, $correo, $contrasena)) {
            $usuario = UsuarioControlador::getUsuario($correo, $contrasena);
            $_SESSION["usuario"] = array(
                "nombre" => $usuario->getNombre(),
                "correo" => $usuario->getCorreo(),
                "contrasena" => $usuario->getContrasena(),
            );
            header("Location: admin.php");

        }
    }
}else {
    header("Location: login.php?error=1");
}
?>