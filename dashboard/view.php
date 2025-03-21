<?php require_once "../vistas/parte_superior.php"; ?>
<?php include '../db.php'; ?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM empleados WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<h1>Ver Usuario</h1>
<p>Nombre: <?php echo $row['nombre']; ?></p>
<p>Correo: <?php echo $row['correo']; ?></p>
<p>Teléfono: <?php echo $row['telefono']; ?></p>
<a href="index.php">Volver</a>

<?php require_once "../vistas/parte_inferior.php"; ?>