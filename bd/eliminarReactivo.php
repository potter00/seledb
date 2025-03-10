<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tblreactivos WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        header("Location: reactivos.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
?>
