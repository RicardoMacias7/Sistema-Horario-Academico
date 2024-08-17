<?php
include_once '../model/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener datos principales
    $sql = "SELECT * FROM horas_clases WHERE id = $id ";
    $result = mysqli_query($conex, $sql);
    $horario = mysqli_fetch_assoc($result);

    // Obtener datos de Docente
    $sqlDocentes = "SELECT id, nombre FROM docentes";
    $resultDocentes = mysqli_query($conex, $sqlDocentes);
    $docentes = mysqli_fetch_all($resultDocentes, MYSQLI_ASSOC);

    // Obtener datos de Asignatura
    $sqlAsignaturas = "SELECT id, nombre FROM asignaturas ";
    $resultAsignaturas = mysqli_query($conex, $sqlAsignaturas);
    $asignaturas = mysqli_fetch_all($resultAsignaturas, MYSQLI_ASSOC);

    // Obtener datos de Curso
    $sqlCursos = "SELECT id, nombre FROM cursos ";
    $resultCursos = mysqli_query($conex, $sqlCursos);
    $cursos = mysqli_fetch_all($resultCursos, MYSQLI_ASSOC);

    $response = array(
        'id' => $horario['id'],
        'dia_semana' => $horario['dia_semana'],
        'hora_inicio' => $horario['hora_inicio'],
        'hora_fin' => $horario['hora_fin'],
        'docentes' => $docentes,
        'asignaturas' => $asignaturas,
        'cursos' => $cursos
    );

    echo json_encode($response);
} else {
    // Manejar el caso donde no se proporciona un ID
    echo json_encode(array('error' => 'ID no proporcionado'));
}
?>

