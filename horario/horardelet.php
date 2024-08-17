<?php
if (!isset($_GET['id'])) {
    header('Location: horario.php?mensaje=ErrorAlEliminar');
    exit();
}

include '../model/conexion.php';
if(isset($_GET['id'])) {
$id = $_GET['id'];

// Actualizar el estado a 'inactivo' en lugar de eliminar
//$sentencia = $conex->prepare("UPDATE horas_clases SET estado = 'inactivo' WHERE id = ?");

$sentencia = $conex->prepare("DELETE FROM horas_clases WHERE id = ?");
$sentencia->bind_param("i", $id);
$resultado = $sentencia->execute();

if ($resultado === TRUE) {
    header('Location: horario.php?mensaje=eliminado');
} 
} else {
    // Redirigir o manejar el caso donde no se envió el formulario correctamente
    header("Location: inicio.php?mensaje=ErrorAlEliminar");
    exit();
}