<?php

include 'UsuariosDao.php';

class UsuarioControlador {

    public static function login($correo, $contrasena) {
        $obj_usuario = new Usuario();
        $obj_usuario->setCorreo($correo);
        $obj_usuario->setContrasena($contrasena);

        return UsuariosDao::login($obj_usuario);
    }

    public static function getUsuario($correo, $contrasena) {
        $obj_usuario = new Usuario();
        $obj_usuario->setCorreo($correo);
        $obj_usuario->setContrasena($contrasena);

        return UsuariosDao::getUsuario($obj_usuario);
    }

    public static function registrar($nombre, $correo, $contrasena) {
        $obj_usuario = new Usuario();
        $obj_usuario->setNombre($nombre);
        $obj_usuario->setCorreo($correo);
        $obj_usuario->setContrasena($contrasena);

        return UsuariosDao::registrar($obj_usuario);
    }
}

?>
