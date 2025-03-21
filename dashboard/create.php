\dashboard\create.php
<?php require_once "../vistas/parte_superior.php"; ?>
<?php include '../db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO empleados (nombre, correo, telefono) VALUES ('$nombre', '$correo', '$telefono')";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h1>Agregar Usuario</h1>
<form method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    <br>
    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required>
    <br>
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" required>
    <br>
    <button type="submit">Guardar</button>
</form>

<?php require_once "../vistas/parte_inferior.php"; ?>