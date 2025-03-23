<?php
require_once '../conexion.php';
require_once 'Inventario.php';

$inventario = new Inventario();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Función para convertir valores vacíos a NULL
    function cleanNumericValue($value) {
        return $value === '' ? null : $value;
    }

    $datos = [
        'nombre' => $_POST['nombre'],
        'unidad' => $_POST['unidad'],
        'inventario_inicial' => cleanNumericValue($_POST['inventario_inicial']),
        'compras' => cleanNumericValue($_POST['compras']),
        'consumo' => cleanNumericValue($_POST['consumo']),
        'existencia' => cleanNumericValue($_POST['existencia']),
        'inventario_muestras' => cleanNumericValue($_POST['inventario_muestras']),
        'gasto_por_dia' => cleanNumericValue($_POST['gasto_por_dia']),
        'inventario_en_dias' => cleanNumericValue($_POST['inventario_en_dias']),
        'dias_en_surtir' => cleanNumericValue($_POST['dias_en_surtir']),
        'inventario_al_llegar' => cleanNumericValue($_POST['inventario_al_llegar']),
        'punto_reorden' => cleanNumericValue($_POST['punto_reorden'])
    ];

    if ($inventario->actualizarProducto($_POST['id'], $datos)) {
        echo "<script>
                alert('Reactivo actualizado exitosamente');
                window.location.href = 'verInventario.php';
              </script>";
    } else {
        echo "<script>alert('Error al actualizar el reactivo');</script>";
    }
}

// Obtener datos del reactivo
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$reactivo = $inventario->obtenerProductoPorId($id);

if (!$reactivo) {
    echo "<script>
            alert('Reactivo no encontrado');
            window.location.href = 'verInventario.php';
          </script>";
    exit;
}

// Función para mostrar valores en el formulario
function displayValue($value) {
    return $value === null ? '' : $value;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reactivo</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Editar Reactivo</h2>
            <form method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?php echo $reactivo['id']; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                   value="<?php echo htmlspecialchars($reactivo['nombre']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="unidad">Unidad:</label>
                            <input type="text" class="form-control" id="unidad" name="unidad" 
                                   value="<?php echo htmlspecialchars($reactivo['unidad']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="inventario_inicial">Inventario Inicial:</label>
                            <input type="number" step="0.01" class="form-control" id="inventario_inicial" name="inventario_inicial" 
                                   value="<?php echo displayValue($reactivo['inventario_inicial']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="compras">Compras:</label>
                            <input type="number" step="0.01" class="form-control" id="compras" name="compras" 
                                   value="<?php echo displayValue($reactivo['compras']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="consumo">Consumo:</label>
                            <input type="number" step="0.01" class="form-control" id="consumo" name="consumo" 
                                   value="<?php echo displayValue($reactivo['consumo']); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="existencia">Existencia:</label>
                            <input type="number" step="0.01" class="form-control" id="existencia" name="existencia" 
                                   value="<?php echo displayValue($reactivo['existencia']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="inventario_muestras">Inventario Muestras:</label>
                            <input type="number" step="0.01" class="form-control" id="inventario_muestras" name="inventario_muestras" 
                                   value="<?php echo displayValue($reactivo['inventario_muestras']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="gasto_por_dia">Gasto por Día:</label>
                            <input type="number" step="0.01" class="form-control" id="gasto_por_dia" name="gasto_por_dia" 
                                   value="<?php echo displayValue($reactivo['gasto_por_dia']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="inventario_en_dias">Inventario en Días:</label>
                            <input type="number" class="form-control" id="inventario_en_dias" name="inventario_en_dias" 
                                   value="<?php echo displayValue($reactivo['inventario_en_dias']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="dias_en_surtir">Días en Surtir:</label>
                            <input type="number" class="form-control" id="dias_en_surtir" name="dias_en_surtir" 
                                   value="<?php echo displayValue($reactivo['dias_en_surtir']); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inventario_al_llegar">Inventario al Llegar:</label>
                            <input type="number" step="0.01" class="form-control" id="inventario_al_llegar" name="inventario_al_llegar" 
                                   value="<?php echo displayValue($reactivo['inventario_al_llegar']); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="punto_reorden">Punto de Reorden:</label>
                            <input type="number" class="form-control" id="punto_reorden" name="punto_reorden" 
                                   value="<?php echo displayValue($reactivo['punto_reorden']); ?>">
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar Reactivo</button>
                    <a href="verInventario.php" class="btn btn-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>

    <script src="../../jquery/jquery-3.3.1.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        // Validación del formulario
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
