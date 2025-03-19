<?php
class Conexion {
    private static $host = "localhost";
    private static $dbname = "selectadb";
    private static $username = "root";  // Cambia si usas otra credencial
    private static $password = "root";      // Cambia si usas otra credencial
    private static $conexion = null;

    public static function Conectar() {
        if (self::$conexion == null) {
            try {
                self::$conexion = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$username, self::$password);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conexion;
    }
}
?>
