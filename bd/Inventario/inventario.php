<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../conexion.php';

class Inventario {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::Conectar(); // Ahora obtenemos la conexión directamente
    }

    public function agregarProducto($nombre, $unidad, $stock_actual, $stock_minimo) {
        try {
            $sql = "INSERT INTO inventario (nombre, unidad, stock_actual, stock_minimo) 
                    VALUES (:nombre, :unidad, :stock_actual, :stock_minimo)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':unidad', $unidad);
            $stmt->bindParam(':stock_actual', $stock_actual);
            $stmt->bindParam(':stock_minimo', $stock_minimo);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error al agregar producto: " . $e->getMessage());
        }
    }

    public function obtenerProductosStockBajo() {
        try {
            $sql = "SELECT * FROM inventario WHERE stock_actual < stock_minimo";
            $stmt = $this->conexion->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener stock bajo: " . $e->getMessage());
        }
    }
}
?>
