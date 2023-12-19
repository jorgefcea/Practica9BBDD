<?php

include 'Conexion.php';
include 'Usuario.php';

class UsuariosDao extends Conexion {
   
    protected static $cnx;

    private static function getConexion() {
        self::$cnx = Conexion::conectar();
    }

    private static function desconectar() {
        self::$cnx = null;
    }

    // Método que sirve para validar el login

    public static function login($usuario) {
        $query = 'SELECT * FROM usuarios WHERE correo = :correo AND contrasena = :contrasena';
    
        self::getConexion();
    
        $correo = $usuario->getCorreo();
        $contrasena = $usuario->getContrasena();
    
        $resultado = self::$cnx->prepare($query);
    
        // Utiliza las variables asignadas para bindParam
        $resultado->bindParam(":correo", $correo);
        $resultado->bindParam(":contrasena", $contrasena);
    
        $resultado->execute();
    
        if($resultado->rowCount() > 0) {
            $filas = $resultado->fetch();
            if($filas["correo"] == $usuario->getCorreo() && $filas["contrasena"] == $usuario->getContrasena()) {
                return true;
            }
        }        
    
        return false;
    }
    
    // Método que sirve para obtener un usuario

    public static function getUsuario($usuario) {
        $query = 'SELECT nombre,correo,contrasena FROM usuarios WHERE correo = :correo AND contrasena = :contrasena';
    
        self::getConexion();
    
        $correo = $usuario->getCorreo();
        $contrasena = $usuario->getContrasena();
    
        $resultado = self::$cnx->prepare($query);
    
        // Utiliza las variables asignadas para bindParam
        $resultado->bindParam(":correo", $correo);
        $resultado->bindParam(":contrasena", $contrasena);
    
        $resultado->execute();
    
        $filas = $resultado->fetch();
      
        $usuario = new Usuario();
        $usuario->setNombre($filas["nombre"]);
        $usuario->setCorreo($filas["correo"]);
        $usuario->setContrasena($filas["contrasena"]);

        return $usuario;
    }

    // Método que sirve para registrar usuarios

    public static function registrar($usuario) {
        // Verificar si el correo ya existe
        if (self::correoExiste($usuario->getCorreo())) {
            // Manejar el error o notificar al usuario que el correo ya está registrado
            return false;
        }
    
        $query = 'INSERT INTO usuarios (nombre,correo,contrasena) VALUES (:nombre,:correo,:contrasena)';
    
        self::getConexion();
    
        $resultado = self::$cnx->prepare($query);
    
        $nombre = $usuario->getNombre();  
        $correo = $usuario->getCorreo();  
        $contrasena = $usuario->getContrasena();  
    
        $resultado->bindParam(":nombre", $nombre);
        $resultado->bindParam(":correo", $correo);
        $resultado->bindParam(":contrasena", $contrasena);
    
        if($resultado->execute()) {
            return true;
        }
        return false;
    }
    
    // Método para verificar si el correo ya existe
    private static function correoExiste($correo) {
        // Asegúrate de que la conexión esté establecida
        if (self::$cnx === null) {
            self::getConexion();
        }

        $query = 'SELECT COUNT(*) FROM usuarios WHERE correo = :correo';

        $resultado = self::$cnx->prepare($query);
        $resultado->bindParam(":correo", $correo);
        $resultado->execute();

        $existe = $resultado->fetchColumn() > 0;

        if ($existe) {
            // El correo ya existe, redirige a login.php con un parámetro de mensaje
            header("Location: login.php?mensaje=El correo introducido ya está registrado. Por favor, introduzca otro diferente.");
            exit(); // Asegura que el script se detenga después de la redirección
        }

        return $existe;
    }


}
?>