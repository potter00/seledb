<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$unidad = (isset($_POST['unidad'])) ? $_POST['unidad'] : '';
$inventario_inicial = (isset($_POST['inventario_inicial']) && $_POST['inventario_inicial'] !== '') ? $_POST['inventario_inicial'] : null;
$compras = (isset($_POST['compras']) && $_POST['compras'] !== '') ? $_POST['compras'] : null;
$consumo = (isset($_POST['consumo']) && $_POST['consumo'] !== '') ? $_POST['consumo'] : null;
$existencia = (isset($_POST['existencia']) && $_POST['existencia'] !== '') ? $_POST['existencia'] : null;
$inventario_muestras = (isset($_POST['inventario_muestras']) && $_POST['inventario_muestras'] !== '') ? $_POST['inventario_muestras'] : null;
$gasto_por_dia = (isset($_POST['gasto_por_dia']) && $_POST['gasto_por_dia'] !== '') ? $_POST['gasto_por_dia'] : null;
$inventario_en_dias = (isset($_POST['inventario_en_dias']) && $_POST['inventario_en_dias'] !== '') ? $_POST['inventario_en_dias'] : null;
$dias_en_surtir = (isset($_POST['dias_en_surtir']) && $_POST['dias_en_surtir'] !== '') ? $_POST['dias_en_surtir'] : null;
$inventario_al_llegar = (isset($_POST['inventario_al_llegar']) && $_POST['inventario_al_llegar'] !== '') ? $_POST['inventario_al_llegar'] : null;
$punto_reorden = (isset($_POST['punto_reorden']) && $_POST['punto_reorden'] !== '') ? $_POST['punto_reorden'] : null;

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1: // alta
        $consulta = "INSERT INTO tblreactivos (nombre, unidad, inventario_inicial, compras, consumo, existencia, inventario_muestras, gasto_por_dia, inventario_en_dias, dias_en_surtir, inventario_al_llegar, punto_reorden) VALUES(:nombre, :unidad, :inventario_inicial, :compras, :consumo, :existencia, :inventario_muestras, :gasto_por_dia, :inventario_en_dias, :dias_en_surtir, :inventario_al_llegar, :punto_reorden)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute([
            ':nombre' => $nombre,
            ':unidad' => $unidad,
            ':inventario_inicial' => $inventario_inicial,
            ':compras' => $compras,
            ':consumo' => $consumo,
            ':existencia' => $existencia,
            ':inventario_muestras' => $inventario_muestras,
            ':gasto_por_dia' => $gasto_por_dia,
            ':inventario_en_dias' => $inventario_en_dias,
            ':dias_en_surtir' => $dias_en_surtir,
            ':inventario_al_llegar' => $inventario_al_llegar,
            ':punto_reorden' => $punto_reorden
        ]); 

        $consulta = "SELECT * FROM tblreactivos ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: // modificación
        $consulta = "UPDATE tblreactivos SET nombre=:nombre, unidad=:unidad, inventario_inicial=:inventario_inicial, compras=:compras, consumo=:consumo, existencia=:existencia, inventario_muestras=:inventario_muestras, gasto_por_dia=:gasto_por_dia, inventario_en_dias=:inventario_en_dias, dias_en_surtir=:dias_en_surtir, inventario_al_llegar=:inventario_al_llegar, punto_reorden=:punto_reorden WHERE id=:id";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute([
            ':nombre' => $nombre,
            ':unidad' => $unidad,
            ':inventario_inicial' => $inventario_inicial,
            ':compras' => $compras,
            ':consumo' => $consumo,
            ':existencia' => $existencia,
            ':inventario_muestras' => $inventario_muestras,
            ':gasto_por_dia' => $gasto_por_dia,
            ':inventario_en_dias' => $inventario_en_dias,
            ':dias_en_surtir' => $dias_en_surtir,
            ':inventario_al_llegar' => $inventario_al_llegar,
            ':punto_reorden' => $punto_reorden,
            ':id' => $id
        ]);        
        
        $consulta = "SELECT * FROM tblreactivos WHERE id=:id";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute([':id' => $id]);
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3: // baja
        $consulta = "DELETE FROM tblreactivos WHERE id=:id";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute([':id' => $id]);
        $data = "Eliminado";                            
        break;
    case 4: // listar
        $consulta = "SELECT * FROM tblreactivos";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5: // obtener un registro específico
        $consulta = "SELECT * FROM tblreactivos WHERE id=:id";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute([':id' => $id]);
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL; 