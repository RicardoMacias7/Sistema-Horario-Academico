<?php
    //print_r($_POST);
    //  if(empty($_POST["oculto"]) || empty($_POST["nombre"]) || empty($_POST["direccion"])|| empty($_POST["celular"])|| empty($_POST["email"])|| empty($_POST["genero"])|| empty($_POST["fecha_ingreso"])){
    //      header('Location: inicio.php?mensaje=error');
    //      exit();
    //  }
     include_once '../model/conexion.php';
     //include(__DIR__ . '/../model/conexion.php');

    $nombre = $_POST['nombre'];
    $nivel = $_POST['nivel'];
    $periodo_academico = $_POST['periodo_academico'];


    $sentencia = $conex->prepare("INSERT INTO cursos(nombre, nivel,periodo_academico) VALUES (?, ?, ?);");
    $resultado = $sentencia->execute([$nombre, $nivel,$periodo_academico]);

    if ($resultado === TRUE) {
        header('Location: curso.php?mensaje=curso');
    } else {
        header('Location: curso.php?mensaje=error');
        exit();
    }
