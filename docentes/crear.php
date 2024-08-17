<?php
    //print_r($_POST);
    //  if(empty($_POST["oculto"]) || empty($_POST["nombre"]) || empty($_POST["direccion"])|| empty($_POST["celular"])|| empty($_POST["email"])|| empty($_POST["genero"])|| empty($_POST["fecha_ingreso"])){
    //      header('Location: inicio.php?mensaje=error');
    //      exit();
    //  }
     include_once '../model/conexion.php';
     //include(__DIR__ . '/../model/conexion.php');

    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $genero = $_POST['genero'];
    $fecha_ingreso = $_POST['fecha_ingreso'];

    $sentencia = $conex->prepare("INSERT INTO docentes(nombre, direccion,celular,email,genero,fecha_ingreso) VALUES (?, ?, ?, ?, ?, ?);");
    $resultado = $sentencia->execute([$nombre, $direccion,$celular,$email,$genero,$fecha_ingreso]);

    if ($resultado === TRUE) {
        header('Location: inicio.php?mensaje=registrado');
    } else {
        header('Location: inicio.php?mensaje=error');
        exit();
    }