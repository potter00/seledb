<?php require_once "../vistas/parte_superior.php"; ?>
<?php include '../db.php'; ?>

<?php
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $sql = "UPDATE empleados SET nombre='$nombre', correo='$correo', telefono='$telefono' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT * FROM empleados WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<h1>Editar Usuario</h1>
<form method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
    <br>
    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" value="<?php echo $row['correo']; ?>" required>
    <br>
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>" required>
    <br>
    <button type="submit">Guardar</button>
</form>

<?php require_once "../vistas/parte_inferior.php"; ?>