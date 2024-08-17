<?php
// Utiliza rutas relativas o absolutas según la estructura de tu proyecto
include '../model/conexion.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sentencia = $conex->prepare("DELETE FROM docentes WHERE id = ?");
    $sentencia->bind_param("i", $id);
    $resultado = $sentencia->execute();

    if ($resultado) {
        header('Location: inicio.php?mensaje=eliminado');
    } else {
        // Mostrar el error en caso de fallo
        echo "Error al eliminar el docente: " . $sentencia->error;
        // Puedes redirigir a una página de error o hacer algo más aquí según tus necesidades
    }
} else {
    // Redirigir o manejar el caso donde no se envió el formulario correctamente
    header("Location: inicio.php?mensaje=ErrorAlEliminar");
    exit();
}
?>
