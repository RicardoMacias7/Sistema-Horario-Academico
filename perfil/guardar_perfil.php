<?php
include_once '../login/conex.php';

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $nombre = $_POST['first_name'];
    $apellido = $_POST['last_name'];
    $telefono = $_POST['phone_number'];
    $direccion = $_POST['address'];
    $ciudad = $_POST['city'];
    $email = $_POST['email']; // No permitir cambios en el email

    // Verifica si la conexión está establecida
    if (!$conex) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    // Actualiza la información en la base de datos con sentencias preparadas
    $query = "UPDATE usuarios SET nombre=?, apellido=?, telefono=?, direccion=?, ciudad=? WHERE email=?";
    $stmt = mysqli_prepare($conex, $query);

    // Verifica si la preparación fue exitosa
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $apellido, $telefono, $direccion, $ciudad, $email);

        // Ejecuta la consulta
        $resultado = mysqli_stmt_execute($stmt);

        // Verifica si la actualización fue exitosa
        if ($resultado) {
            echo json_encode(["success" => true, "message" => "Actualizado correctamente"]);
            exit;
        } else {
            echo json_encode(["success" => false, "message" => "Error al actualizar"]);
            exit;
        }
    } else {
        die("La preparación de la consulta falló: " . mysqli_error($conexion));
    }
} else {
    // Si no es una solicitud POST, redirige a la página principal u otra página
    header("Location: perfil.php?mensaje=ErrorOtros");
    exit;
}
?>
