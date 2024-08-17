<?php
    if (!isset($_GET['id'])) {
        header('Location: asignaturas.php?mensaje=ErrorAlEliminar');
        exit();
    }

    include '../model/conexion.php';
    $id = $_GET['id'];

    $sentencia = $conex->prepare("DELETE FROM asignaturas WHERE id = ?");
    $sentencia->bind_param("i", $id);
    $resultado = $sentencia->execute();

    if ($resultado === TRUE) {
        header('Location: asignaturas.php?mensaje=eliminado');
    } 
?> 

