
 <?php
    // if (!isset($_GET['id'])) {
    //     header('Location: inicio.php?mensaje=ErrorAlEliminar');
    //     exit();
    // }

    include '../model/conexion.php';
    if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // $sentencia = $conex->prepare("DELETE FROM usuarios WHERE id = ?");
    $sentencia = $conex->prepare("DELETE FROM cursos WHERE id = ?");
    $sentencia->bind_param("i", $id);
    $resultado = $sentencia->execute();

    if ($resultado) {
        header('Location: curso.php?mensaje=eliminado');
    } 
} else {
    // Redirigir o manejar el caso donde no se envió el formulario correctamente
    header("Location: curso.php?mensaje=ErrorAlEliminar");
    exit();
}
?>  
<?php /*
    if (!isset($_GET['id'])) {
        header('Location: curso.php?mensaje=ErrorAlEliminar');
        exit();
    }

    include '../model/conexion.php';
    $id = $_GET['id'];

    // $sentencia = $conex->prepare("DELETE FROM usuarios WHERE id = ?");
    $sentencia = $conex->prepare("UPDATE cursos SET estado = 'inactivo' WHERE id = ?");
    $sentencia->bind_param("i", $id);
    $resultado = $sentencia->execute();

    if ($resultado === TRUE) {
        header('Location: curso.php?mensaje=eliminado');
    } */
?> 


