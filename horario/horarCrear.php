<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once '../model/conexion.php';

$dia_semana = $_POST['dia_semana'];
$hora_inicio = $_POST['hora_inicio'];
$hora_fin = $_POST['hora_fin'];
$id_docente = $_POST['id_docente'];
$id_asignatura = $_POST['id_asignatura'];
$id_curso = $_POST['id_curso'];

// Establecer el estado por defecto como 'activo' al insertar
$sentencia = $conex->prepare("INSERT INTO horas_clases (dia_semana, hora_inicio, hora_fin, id_docente, id_asignatura, id_curso)
     VALUES (?, ?, ?, ?, ?, ?);");
$resultado = $sentencia->execute([$dia_semana, $hora_inicio, $hora_fin, $id_docente, $id_asignatura, $id_curso]);

if ($resultado === TRUE) {
    header('Location: horario.php?mensaje=horario');
} else {
    header('Location: horario.php?mensaje=error');
    exit();
}
?>

<?php /*

error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once '../model/conexion.php';

$dia_semana = $_POST['dia_semana'];
$hora_inicio = $_POST['hora_inicio'];
$hora_fin = $_POST['hora_fin'];
$id_docente = $_POST['id_docente'];
$id_asignatura = $_POST['id_asignatura'];
$id_curso = $_POST['id_curso'];

$sentencia = $conex->prepare("INSERT INTO horas_clases(dia_semana, hora_inicio ,hora_fin ,id_docente,id_asignatura,id_curso)
     VALUES (?, ?, ?, ?,?,?);");
$resultado = $sentencia->execute([$dia_semana, $hora_inicio, $hora_fin, $id_docente, $id_asignatura, $id_curso]);

if ($resultado === TRUE) {
    header('Location: horario.php?mensaje=horario');
} else {
    header('Location: horario.php?mensaje=error');
    exit();
} */
?>