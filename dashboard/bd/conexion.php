<?php
class Conexion
{
    public static function Conectar()
    {
        define('servidor', '127.0.0.2');
        define('nombre_bd', 'crud_2019');
        define('usuario', 'root');
        define('password', '');
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        try {
            $conexion = new PDO("mysql:host=" . servidor . "; dbname=" . nombre_bd, usuario, password, $opciones);
            return $conexion;
        } catch (Exception $e) {
            die("El error de Conexión es: " . $e->getMessage());
        }
    }
    
    /*
    function conectar() {
        $host = "localhost";
        $port = "5432";
        $dbname = "posgreLogin";
        $user = "postgres";
        $password = "1423";
    
        try {
            $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión exitosa";
            return $conn;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
    */
    // Ejemplo de uso
   
    
    // Realiza operaciones con la conexión, por ejemplo:
    // $result = $conexion->query('SELECT * FROM mi_tabla');
    // ...
    
    // Cierra la conexión cuando hayas terminado de usarla
   
}