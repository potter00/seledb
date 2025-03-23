<?php
require 'ExcelImport.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"])) {
    $archivo = $_FILES["archivo"]["tmp_name"];
    $importador = new ExcelImport();
    $resultado = $importador->importarExcel($archivo);
    echo $resultado;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Importar Excel</title>
</head>
<body>
    <h2>Importar Inventario desde Excel</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="archivo" accept=".xls,.xlsx" required>
        <button type="submit">Importar</button>
    </form>
</body>
</html>
