<?php

    //   if(empty($_POST["oculto"]) || empty($_POST["nombre"]) || empty($_POST["direccion"])|| empty($_POST["celular"])|| empty($_POST["email"])|| empty($_POST["genero"])|| empty($_POST["fecha_ingreso"])){
    //       header('Location: inicio.php?mensaje=ErrorAlActualizado');
    //       exit();
    //   }
    include_once '../model/conexion.php';

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $horas_semana = $_POST['horas_semana'];

        $sql = "UPDATE asignaturas SET nombre = '$nombre', descripcion='$descripcion', horas_semana='$horas_semana'  WHERE id = $id";
        $result = mysqli_query($conex, $sql);

        if ($result) {
            header("Location: asignaturas.php?mensaje=actualizado");
            exit();
        } 
    } else {
        header("Location: asignaturas.php?mensaje=ErrorAlActualizado");
        exit();
    }
