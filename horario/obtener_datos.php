<?php
include_once '../model/conexion.php';

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];

    $query = "";
    switch ($tipo) {
        case "docentes":
            $query = "SELECT id, nombre FROM docentes ";
            break;
        case "asignaturas":
            $query = "SELECT id, nombre FROM asignaturas ";
            break;
        case "cursos":
            $query = "SELECT id, nombre FROM cursos ";
            break;
        default:
            // Manejar otro tipo (si es necesario)
            break;
    }

    if ($query !== "") {
        $result = mysqli_query($conex, $query);

        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        // Manejar el caso si el tipo no es válido
        echo json_encode(array('error' => 'Tipo no válido'));
    }
}
?>
