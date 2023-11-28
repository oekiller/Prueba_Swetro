<?php
    // $host = "localhost";
    // $user = "root";
    // $clave = "";
    // $bd = "prueba_swetro";
    // $conexion = mysqli_connect($host,$user,$clave,$bd);
    // if (mysqli_connect_errno()){
    //     echo "No se pudo conectar a la base de datos";
    //     exit();
    // }
    // mysqli_select_db($conexion,$bd) or die("No se encuentra la base de datos");
    // mysqli_set_charset($conexion,"utf8");

    class Conexion{
        public static function Conectar(){
            define('servidor', 'localhost');
            define('nombre_bd', 'prueba_swetro');
            define('usuario', 'root');
            define('password', '');
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            try {
                $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);
                return $conexion;
            } catch (Exception $e) {
                die("El error de conexion es: ". $e->getMessage());
            }
            
        }
    }
?>
