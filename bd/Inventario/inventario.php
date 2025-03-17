<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Crear la conexión a la base de datos
$conexion = Conexion::Conectar();

class Inventario {

    private $conexion;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Método para agregar un nuevo reactivo
    public function agregarReactivo($nombre, $unidad, $inventario_inicial, $compras, $consumo, $existencia, $inventario_muestras, $gasto_por_dia, $inventario_en_dias, $dias_en_surtir, $inventario_al_llegar, $punto_reorden) {
        $sql = "INSERT INTO tblreactivos (nombre, unidad, inventario_inicial, compras, consumo, existencia, inventario_muestras, gasto_por_dia, inventario_en_dias, dias_en_surtir, inventario_al_llegar, punto_reorden)
                VALUES ('$nombre', '$unidad', '$inventario_inicial', '$compras', '$consumo', '$existencia', '$inventario_muestras', '$gasto_por_dia', '$inventario_en_dias', '$dias_en_surtir', '$inventario_al_llegar', '$punto_reorden')";

        if ($this->conexion->query($sql) === TRUE) {
            echo "Nuevo reactivo agregado exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conexion->error;
        }
    }

    // Método para actualizar un reactivo
    public function actualizarReactivo($id, $nombre, $unidad, $inventario_inicial, $compras, $consumo, $existencia, $inventario_muestras, $gasto_por_dia, $inventario_en_dias, $dias_en_surtir, $inventario_al_llegar, $punto_reorden) {
        $sql = "UPDATE tblreactivos SET 
                    nombre = '$nombre', 
                    unidad = '$unidad', 
                    inventario_inicial = '$inventario_inicial',
                    compras = '$compras',
                    consumo = '$consumo',
                    existencia = '$existencia',
                    inventario_muestras = '$inventario_muestras',
                    gasto_por_dia = '$gasto_por_dia',
                    inventario_en_dias = '$inventario_en_dias',
                    dias_en_surtir = '$dias_en_surtir',
                    inventario_al_llegar = '$inventario_al_llegar',
                    punto_reorden = '$punto_reorden'
                WHERE id = $id";

        if ($this->conexion->query($sql) === TRUE) {
            echo "Reactivo actualizado correctamente";
        } else {
            echo "Error: " . $this->conexion->error;
        }
    }

    // Método para eliminar un reactivo
    public function eliminarReactivo($id) {
        $sql = "DELETE FROM tblreactivos WHERE id = $id";

        if ($this->conexion->query($sql) === TRUE) {
            echo "Reactivo eliminado exitosamente";
        } else {
            echo "Error: " . $this->conexion->error;
        }
    }

    // Método para obtener todos los reactivos
    public function obtenerReactivos() {
        $sql = "SELECT * FROM tblreactivos";
        return $this->conexion->query($sql);
    }

    // Método para obtener un reactivo específico por ID
    public function obtenerReactivoPorId($id) {
        $sql = "SELECT * FROM tblreactivos WHERE id = $id";
        return $this->conexion->query($sql)->fetch_assoc();
    }
}

// Crear una instancia de la clase Inventario
$inventario = new Inventario($conexion);

// Si el formulario de agregar reactivo ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $unidad = $_POST['unidad'];
    $inventario_inicial = $_POST['inventario_inicial'];
    $compras = $_POST['compras'];
    $consumo = $_POST['consumo'];
    $existencia = $_POST['existencia'];
    $inventario_muestras = $_POST['inventario_muestras'];
    $gasto_por_dia = $_POST['gasto_por_dia'];
    $inventario_en_dias = $_POST['inventario_en_dias'];
    $dias_en_surtir = $_POST['dias_en_surtir'];
    $inventario_al_llegar = $_POST['inventario_al_llegar'];
    $punto_reorden = $_POST['punto_reorden'];

    // Agregar un nuevo reactivo
    $inventario->agregarReactivo($nombre, $unidad, $inventario_inicial, $compras, $consumo, $existencia, $inventario_muestras, $gasto_por_dia, $inventario_en_dias, $dias_en_surtir, $inventario_al_llegar, $punto_reorden);
}

// No es necesario cerrar la conexión explícitamente con PDO
?>
