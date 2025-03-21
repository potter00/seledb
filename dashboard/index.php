<?php require_once "../vistas/parte_superior.php"; ?>
<?php include '../db.php'; ?>

<h1>Gestión de Usuarios</h1>
<a href="create.php">Agregar nuevo elemento</a>
<table>
    <tr>
        <th>id</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>
    <?php
    $sql = "SELECT * FROM empleados";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nombre']; ?></td>
        <td><?php echo $row['correo']; ?></td>
        <td><?php echo $row['telefono']; ?></td>
        <td>
            <a href="view.php?id=<?php echo $row['id']; ?>">Ver</a>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Editar</a>
            <a href="delete.php?id=<?php echo $row['id']; ?>">Eliminar</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php require_once "../vistas/parte_inferior.php"; ?>