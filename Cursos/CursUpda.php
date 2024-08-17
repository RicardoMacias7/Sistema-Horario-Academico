<?php

    //   if(empty($_POST["oculto"]) || empty($_POST["nombre"]) || empty($_POST["direccion"])|| empty($_POST["celular"])|| empty($_POST["email"])|| empty($_POST["genero"])|| empty($_POST["fecha_ingreso"])){
    //       header('Location: inicio.php?mensaje=ErrorAlActualizado');
    //       exit();
    //   }
    include_once '../model/conexion.php';

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $nivel = $_POST['nivel'];
        $periodo_academico = $_POST['periodo_academico'];

        // Realizar la actualización en la base de datos
        // $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido' WHERE id = $id";
        $sql = "UPDATE cursos SET nombre = '$nombre', nivel='$nivel' ,periodo_academico = '$periodo_academico' WHERE id = $id";
        $result = mysqli_query($conex, $sql);

        if ($result) {
            header("Location: curso.php?mensaje=actualizado");
            exit();
        } 
    } else {
        // Redirigir o manejar el caso donde no se envió el formulario correctamente
        header("Location: curso.php?mensaje=ErrorAlActualizado");
        exit();
    }
