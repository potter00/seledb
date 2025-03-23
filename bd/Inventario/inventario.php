<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../conexion.php';

class Inventario {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::Conectar();
    }

    public function obtenerProductosStockBajo() {
        try {
            $query = "SELECT * FROM tblreactivos WHERE existencia <= punto_reorden";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener productos: " . $e->getMessage());
        }
    }

    public function obtenerTodosLosProductos() {
        try {
            $query = "SELECT * FROM tblreactivos ORDER BY nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener productos: " . $e->getMessage());
        }
    }

    public function agregarProducto($datos) {
        try {
            $query = "INSERT INTO tblreactivos (nombre, unidad, inventario_inicial, compras, consumo, 
                      existencia, inventario_muestras, gasto_por_dia, inventario_en_dias, 
                      dias_en_surtir, inventario_al_llegar, punto_reorden) 
                      VALUES (:nombre, :unidad, :inventario_inicial, :compras, :consumo, 
                      :existencia, :inventario_muestras, :gasto_por_dia, :inventario_en_dias, 
                      :dias_en_surtir, :inventario_al_llegar, :punto_reorden)";
            
            $stmt = $this->conexion->prepare($query);
            return $stmt->execute($datos);
        } catch (PDOException $e) {
            die("Error al agregar producto: " . $e->getMessage());
        }
    }

    public function actualizarProducto($id, $datos) {
        try {
            $query = "UPDATE tblreactivos SET 
                      nombre = :nombre,
                      unidad = :unidad,
                      inventario_inicial = :inventario_inicial,
                      compras = :compras,
                      consumo = :consumo,
                      existencia = :existencia,
                      inventario_muestras = :inventario_muestras,
                      gasto_por_dia = :gasto_por_dia,
                      inventario_en_dias = :inventario_en_dias,
                      dias_en_surtir = :dias_en_surtir,
                      inventario_al_llegar = :inventario_al_llegar,
                      punto_reorden = :punto_reorden
                      WHERE id = :id";
            
            $datos['id'] = $id;
            $stmt = $this->conexion->prepare($query);
            return $stmt->execute($datos);
        } catch (PDOException $e) {
            die("Error al actualizar producto: " . $e->getMessage());
        }
    }

    public function eliminarProducto($id) {
        try {
            $query = "DELETE FROM tblreactivos WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            die("Error al eliminar producto: " . $e->getMessage());
        }
    }

    public function obtenerProductoPorId($id) {
        try {
            $query = "SELECT * FROM tblreactivos WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener producto: " . $e->getMessage());
        }
    }
}
?>
