<?php /*
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login/login.php");
    exit();
} */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Educativo RMTC</title>
    <link rel="stylesheet" href="../css/estiloGeneral.css">
    <link rel="stylesheet" href="../css/estilo_body.css">
    <link rel="icon" href="../img/in.jpg" type="image/png"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Incluye jQuery antes que Bootstrap -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- Incluye las bibliotecas de Bootstrap y Bootstrap Datepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Incluye Bootstrap Datepicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script src="../js/acciones.js"></script>


</head>


<body>

    <?php
    include_once '../login/conex.php';
    $idUsuario = $_SESSION['id']; // Obtén el ID del usuario desde tu sesión o de alguna manera segura
    $sql = "SELECT nombre, apellido, email, telefono, direccion, ciudad FROM usuarios WHERE id = $idUsuario";
    $result = mysqli_query($conex, $sql);
    $rowUsuario = mysqli_fetch_assoc($result);

    $nombreUsuario = $rowUsuario['nombre'];
    $apellidoUsuario = $rowUsuario['apellido'];
    $emailUsuario = $rowUsuario['email'];
    $telefonoUsuario = $rowUsuario['telefono'];
    $direccionUsuario = $rowUsuario['direccion'];
    $ciudadUsuario = $rowUsuario['ciudad'];

    ?>


    <?php
    include_once '../model/conexion.php';

    $sqlTotalHoras = "SELECT COUNT(*) as total FROM horas_clases ";
    $resultTotalHoras = mysqli_query($conex, $sqlTotalHoras);
    $totalResultadosHora = mysqli_fetch_assoc($resultTotalHoras)['total'];

    $sqlTotalDocentes = "SELECT COUNT(*) as total FROM docentes ";
    $resultTotalDocentes = mysqli_query($conex, $sqlTotalDocentes);
    $totalResultadosDocent = mysqli_fetch_assoc($resultTotalDocentes)['total'];

    $sqlTotalAsignaturas = "SELECT COUNT(*) as total FROM asignaturas ";
    $resultTotalAsignaturas = mysqli_query($conex, $sqlTotalAsignaturas);
    $totalResultadosAsig = mysqli_fetch_assoc($resultTotalAsignaturas)['total'];

    $sqlTotalCursos = "SELECT COUNT(*) as total FROM cursos ";
    $resultTotalCursos = mysqli_query($conex, $sqlTotalCursos);
    $totalResultadosCurso = mysqli_fetch_assoc($resultTotalCursos)['total'];
    ?>
    <?php
    // Obtén la URL actual
    $currentUrl = basename($_SERVER['REQUEST_URI']);
    // echo $currentUrl
    ?>

    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary min-vh-100">
        <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg  py-3 navbar-light bg-custom-color border-bottom border-bottom-lg-0 border-end-lg"
            id="navbarVertical">
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler ms-n2 bg-white " type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon "></span>
                </button>
                <!-- Brand -->
                <a class="navbar-brand py-lg-2 mb-lg-5  me-0" href="#">
                    <h3 class="text-white">
                        <!--    <img src="https://bytewebster.com/img/logo.png" width="40"> -->
                        <?php echo $nombreUsuario . " " . $apellidoUsuario; ?>
                    </h3>
                </a>
                <!-- User menu (mobile) -->
                <div class="navbar-user d-lg-none ">
                    <div class="dropdown">
                        <!-- <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="avatar-parent-child">
                                <img alt="Image Placeholder"
                                    src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                                    class="avatar avatar- rounded-circle">
                                <span class="avatar-child avatar-badge bg-success"></span>
                            </div>
                        </a> -->
                        <!-- Menu -->
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                            <a href="#" class="dropdown-item">Cuenta</a>
                            <!-- <hr class="dropdown-divider"> -->
                            <a href="../login/login.php" class="dropdown-item">Cerrar Sesion</a>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="sidebarCollapse">

                    <ul class="navbar-nav ">
                        <li class="nav-item <?php echo ($currentUrl === 'horario.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="../horario/horario.php">
                                <i class="bi bi-calendar "></i>Horarios de Clases
                                <span
                                    class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto"
                                    title="Total de Horarios">

                                    <?php echo $totalResultadosHora; ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($currentUrl === 'inicio.php') ? 'active' : ''; ?>">
                            <a class="nav-link " href="../docentes/inicio.php">
                                <!-- <i class="bi bi-bar-chart"></i> -->
                                <i class="bi bi-person-workspace"></i>Docentes
                                <span
                                    class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto"
                                    title="Total de Docentes">

                                    <?php echo $totalResultadosDocent; ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($currentUrl === 'asignaturas.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="../asignaturas/asignaturas.php">
                                <i class="bi bi-journal"></i>Asignaturas
                                <span
                                    class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto "
                                    title="Total de Asignaturas">
                                    <?php echo $totalResultadosAsig; ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($currentUrl === 'curso.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="../Cursos/curso.php">
                                <i class="bi bi-bookmarks"></i> Cursos
                                <span
                                    class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto"
                                    title="Total de Cursos">
                                    <?php echo $totalResultadosCurso; ?>
                                </span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-people"></i> Usuario
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-globe-americas"></i> Clasificacion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-file-text"></i> Publicaciones
                            </a>
                        </li> -->
                    </ul>
                    <hr class="navbar-divider my-5 ">
                    <div class="mt-auto"></div>
                    <ul class="navbar-nav">
                        <!-- <li class="nav-item <?php echo ($currentUrl === 'perfil.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="../perfil/perfil.php">
                                <i class="bi bi-person-square"></i> Cuenta
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <hr class="navbar-divider my-2 opacity-100" style="background-color:#0E0B78;">
                            <a class="nav-link" href="#" onclick="confirmLogout()">
                                <i class="bi bi-box-arrow-left"></i> Cerrar Sesion
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <!-- Main content -->