<?php
session_start();
if ($_SESSION["s_usuario"] === null) {
    header("Location: ../alertaStock.php");
}

require '../bd/alertasStock.php';

$alertaStock = new AlertaStock();
$alertas = $alertaStock->verificarStockBajo();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Alertas de Stock</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4 text-center">🔔 Alertas de Stock</h1>
            <hr class="my-4">

            <?php if (!empty($alertas)): ?>
                <div class="alert alert-warning">
                    <ul>
                        <?php foreach ($alertas as $alerta): ?>
                            <li>⚠️ <strong><?= $alerta['nombre'] ?></strong> tiene <strong><?= $alerta['stock_actual'] ?></strong> unidades (Mínimo: <?= $alerta['stock_minimo'] ?>).</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else: ?>
                <div class="alert alert-success text-center">
                    ✅ Todos los productos tienen suficiente stock.
                </div>
            <?php endif; ?>

            <a class="btn btn-danger btn-lg" href="../bd/logout.php">Cerrar Sesión</a>
        </div>
    </div>

    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../popper/popper.min.js"></script>
    <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../codigo.js"></script>
</body>
</html>
