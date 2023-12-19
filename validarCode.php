<?php

include 'UsuarioControlador.php';
include 'helps.php';

session_start();

header('Content-type: application/json');
$resultado = array();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(isset($_POST["correo"]) && isset($_POST["contrasena"])) {

        $correo = validar_campo($_POST["correo"]);
        $contrasena = validar_campo($_POST["contrasena"]);
    
        $resultado = array("estado" => "true");
     
        if (UsuarioControlador::login($correo, $contrasena)) {
            $usuario = UsuarioControlador::getUsuario($correo, $contrasena);
            $_SESSION["usuario"] = array(
                "nombre" => $usuario->getNombre(),
                "correo" => $usuario->getCorreo(),
                "contrasena" => $usuario->getContrasena(),
            );
            return print(json_encode($resultado));
        }
    }
}

$resultado = array("estado" => "false");
return print(json_encode($resultado));


?>