<?php
include_once '../model/conexion.php';

if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['horas_semana'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $horas_semana = $_POST['horas_semana'];

    $sentencia = $conex->prepare("INSERT INTO asignaturas(nombre, descripcion, horas_semana) VALUES (?, ?, ? );");

    $resultado = $sentencia->execute([$nombre, $descripcion, $horas_semana]);

    if ($resultado === TRUE) {
        header('Location: asignaturas.php?mensaje=asignatura');
        exit();
    } else {
        echo "Error en la inserción: " . $sentencia->error;
        // header('Location: asignaturas.php?mensaje=error');
        // exit();
    }
} else {
    header('Location: asignaturas.php?mensaje=ErrorDatosFaltantes');
    exit();
}