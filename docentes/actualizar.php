<?php

    //   if(empty($_POST["oculto"]) || empty($_POST["nombre"]) || empty($_POST["direccion"])|| empty($_POST["celular"])|| empty($_POST["email"])|| empty($_POST["genero"])|| empty($_POST["fecha_ingreso"])){
    //       header('Location: inicio.php?mensaje=ErrorAlActualizado');
    //       exit();
    //   }
    include_once '../model/conexion.php';

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $celular = $_POST['celular'];
        $email = $_POST['email'];
        $genero = $_POST['genero'];
        $fecha_ingreso = $_POST['fecha_ingreso'];

        // Realizar la actualización en la base de datos
        // $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido' WHERE id = $id";
        $sql = "UPDATE docentes SET nombre = '$nombre', direccion='$direccion', celular='$celular' ,email = '$email' ,
        genero='$genero' ,fecha_ingreso='$fecha_ingreso' WHERE id = $id";
        $result = mysqli_query($conex, $sql);

        if ($result) {
            header("Location: inicio.php?mensaje=actualizado");
            exit();
        } 
    } else {
        // Redirigir o manejar el caso donde no se envió el formulario correctamente
        header("Location: inicio.php?mensaje=ErrorAlActualizado");
        exit();
    }
?>
