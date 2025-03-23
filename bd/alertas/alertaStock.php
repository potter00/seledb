<?php
class AlertaStock {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function verificarStockBajo() {
        $sql = "SELECT nombre_producto, stock_actual, stock_minimo FROM inventario WHERE stock_actual <= stock_minimo";
        $resultado = $this->conexion->query($sql);

        $alertas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $alertas[] = "⚠️ El producto **" . $fila['nombre_producto'] . "** tiene solo " . $fila['stock_actual'] . " unidades. (Stock mínimo: " . $fila['stock_minimo'] . ")";
        }

        return $alertas;
    }
}
?>
