<?php

class Conexion {
    public static function conectar(){
        try {
            $cn = new PDO("mysql:host=localhost;dbname=practica9", "admin", "admin");
            return $cn;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}

?>

