<?php

    //   if(empty($_POST["oculto"]) || empty($_POST["nombre"]) || empty($_POST["direccion"])|| empty($_POST["celular"])|| empty($_POST["email"])|| empty($_POST["genero"])|| empty($_POST["fecha_ingreso"])){
    //       header('Location: inicio.php?mensaje=ErrorAlActualizado');
    //       exit();
    //   }

    include_once '../model/conexion.php';
    
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $dia_semana = $_POST['dia_semana'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $id_docente = $_POST['id_docente'];
        $id_asignatura = $_POST['id_asignatura'];
        $id_curso = $_POST['id_curso'];
    
        // Actualizar directamente, asumiendo que el id existe en todas las tablas
        $sql = "UPDATE horas_clases SET dia_semana = '$dia_semana', hora_inicio='$hora_inicio', hora_fin='$hora_fin' , id_docente = '$id_docente', id_asignatura= '$id_asignatura', id_curso= '$id_curso'  WHERE id = $id";
        $result = mysqli_query($conex, $sql);
    
        if ($result) {
            header("Location: horario.php?mensaje=actualizado");
            exit();
        } else {
            echo "Error al actualizar: " . mysqli_error($conex);
        }
    } else {
        // Redirigir o manejar el caso donde no se envió el formulario correctamente
        header("Location: horario.php?mensaje=ErrorAlActualizar");
        exit();
    }
    
?>


<?php /*

include_once '../model/conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $dia_semana = $_POST['dia_semana'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $id_docente = $_POST['id_docente'];
    $id_asignatura = $_POST['id_asignatura'];
    $id_curso = $_POST['id_curso'];

    // Verificar si el docente, asignatura y curso existen antes de la actualización
    $verificarDocente = "SELECT * FROM docentes WHERE id = $id_docente";
    $verificarAsignatura = "SELECT * FROM asignaturas WHERE id = $id_asignatura";
    $verificarCurso = "SELECT * FROM cursos WHERE id = $id_curso";

    $resultadoDocente = mysqli_query($conex, $verificarDocente);
    $resultadoAsignatura = mysqli_query($conex, $verificarAsignatura);
    $resultadoCurso = mysqli_query($conex, $verificarCurso);

    if (mysqli_num_rows($resultadoDocente) > 0 && mysqli_num_rows($resultadoAsignatura) > 0 && mysqli_num_rows($resultadoCurso) > 0) {
        // El docente, asignatura y curso existen, proceder con la actualización
        $sql = "UPDATE horas_clases SET dia_semana = '$dia_semana', hora_inicio='$hora_inicio', hora_fin='$hora_fin' , id_docente = '$id_docente', id_asignatura= '$id_asignatura', id_curso= '$id_curso'  WHERE id = $id";
        $result = mysqli_query($conex, $sql);

        if ($result) {
            header("Location: horario.php?mensaje=actualizado");
            exit();
        } else {
            echo "Error al actualizar: " . mysqli_error($conex);
        }
    } else {
        // Docente, asignatura o curso no existen, manejar el caso de error
        header("Location: horario.php?mensaje=ErrorDatosNoExisten");
        exit();
    }
} else {
    // Redirigir o manejar el caso donde no se envió el formulario correctamente
    header("Location: horario.php?mensaje=ErrorAlActualizar");
    exit();
} */

?>