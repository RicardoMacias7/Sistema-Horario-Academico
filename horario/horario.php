<?php 
session_start();
if (!isset($_SESSION['usuario_id'])) {
header("Location: ../login/login.php");
exit();
} 
?>
<?php include '../html/barra.php' ?>
<?php
include_once '../model/conexion.php';
$porPagina = 10;
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($paginaActual - 1) * $porPagina;
$sqlTotal = "SELECT COUNT(*) as total FROM horas_clases";
$resultTotalHora = mysqli_query($conex, $sqlTotal);
$totalResultadosHora = mysqli_fetch_assoc($resultTotalHora)['total'];

$sql = "SELECT horas_clases.id, horas_clases.dia_semana, horas_clases.hora_inicio, horas_clases.hora_fin, 
               docentes.nombre as nombre_docente, asignaturas.nombre as nombre_asignatura, cursos.nombre as nombre_curso
        FROM horas_clases
        LEFT JOIN docentes ON horas_clases.id_docente = docentes.id
        LEFT JOIN asignaturas ON horas_clases.id_asignatura = asignaturas.id
        LEFT JOIN cursos ON horas_clases.id_curso = cursos.id

        LIMIT $inicio, $porPagina";
$result = mysqli_query($conex, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($dato = mysqli_fetch_assoc($result)) {
        ?>
        <tr class="text-capitalize">
        </tr>
        <?php
    }
}
mysqli_close($conex);
?>

<div class="h-screen flex-grow-1 overflow-y-lg-auto">

    <header class="bg-surface-primary border-bottom pt-6">
        <div class="container-fluid">
            <div class="mb-npx">
                <div class="row align-items-center">
                    <div class="text-center">
                        <h1 class="h2 mb-0 ls-tight">
                            <img src="https://bytewebster.com/img/logo.png" width="40"> Instituto Educativo RMTC
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="container-custon py-6 bg-surface-secondary">
        <div class="container-fluid casa">
            <div class="card shadow custom-card border-0 mb-7 ">
                <div class="card-header d-flex justify-content-between align-items-center ">
                    <h5 class="mb-0">Horarios de clase</h5>
                    <form class="me-2 d-flex justify-content-between align-items-center" role="search">
                        <input class="form-control search-clear " onclick="limpiarBusqueda()" type="search"
                            id="searchInput" placeholder="Buscar..." onkeyup="buscarTabla()" aria-label="Search">
                        <a data-bs-toggle="modal" data-bs-target="#formularioCrearModal"
                            class="btn d-inline-flex btn-sm btn-primary mx-3 align-items-center justify-content-end">
                            <span class=" pe-2">Crear</span>
                            <i class='bx bx-user-plus' style='font-size: 19px;'></i>
                        </a>
                        <!-- <button data-bs-target="_blank" class="btn btn-sm btn-success d-inline-flex" onclick="generarPDF()">
                            <span class="pe-2">Descargar</span>
                            <span>
                                <i class='bx bxs-download' style='font-size: 15px;'></i>
                            </span>
                        </button> -->
                        <div class="text-right">
                            <a href="../pdf/generar_pdf.php" target="_blank"
                                class="btn btn-sm btn-success d-flex align-items-center justify-content-end">
                                <span class="me-2">Descargar</span>
                                <i class='bx bxs-download' style='font-size: 15px;'></i>
                            </a>
                        </div>


                    </form>
                </div>
                <?php
                if (isset($_GET["mensaje"]) and $_GET["mensaje"] == 'falta') {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Advertencia!</strong> Llenar todos los campos.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
                <?php
                if (isset($_GET["mensaje"]) and $_GET["mensaje"] == 'horario') {
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Excelente!</strong> registro exitoso.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
                <?php
                if (isset($_GET["mensaje"]) and $_GET["mensaje"] == 'error') {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> no se puede Agregar nuevo usuario.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
                <?php
                if (isset($_GET["mensaje"]) and $_GET["mensaje"] == 'actualizado') {
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Excelente!</strong> Datos actulizados.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
                <?php
                if (isset($_GET["mensaje"]) and $_GET["mensaje"] == 'ErrorAlActualizado') {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Datos no actulizados.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
                <?php
                if (isset($_GET["mensaje"]) and $_GET["mensaje"] == 'eliminado') {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Excelente!</strong> Datos eliminados.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
                <?php
                if (isset($_GET["mensaje"]) and $_GET["mensaje"] == 'ErrorAlEliminar') {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> al eliminar los datos.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
                <div class="table-responsive text-center">
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr class="font-semibold">
                                <th scope="col"><strong>Dias</strong></th>
                                <th scope="col"><strong>Hora de inicio</strong></th>
                                <th scope="col"><strong>Hora de fin</strong></th>
                                <th scope="col"><strong>Docente</strong></th>
                                <th scope="col"><strong>Asignatura</strong></th>
                                <th scope="col"><strong>Curso</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($result as $dato) {
                                $docenteEliminado = ($dato["nombre_docente"] === null);
                                $asignaturaEliminada = ($dato["nombre_asignatura"] === null);
                                $cursoEliminado = ($dato["nombre_curso"] === null);
                                ?>
                                <tr
                                    class="text-capitalize <?= ($docenteEliminado || $asignaturaEliminada || $cursoEliminado) ?: '' ?>">
                                    <td scope="row">
                                        <?= $dato["dia_semana"] ?>
                                    </td>
                                    <td>
                                        <?= $dato["hora_inicio"] ?>
                                    </td>
                                    <td>
                                        <?= $dato["hora_fin"] ?>
                                    </td>
                                    <td>
                                        <?php if ($docenteEliminado): ?>
                                            <span
                                                style="color: red; font-style: italic; font-weight: bold; display: inline-block;">El
                                                Docente ha sido eliminado</span>
                                        <?php else: ?>
                                            <?= $dato["nombre_docente"] ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($asignaturaEliminada): ?>
                                            <span
                                                style="color: red; font-style: italic; font-weight: bold; display: inline-block;">La
                                                Asignatura ha sido eliminada</span>
                                        <?php else: ?>
                                            <?= $dato["nombre_asignatura"] ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($cursoEliminado): ?>
                                            <span
                                                style="color: red; font-style: italic;font-weight: bold; display: inline-block;">El
                                                Curso ha sido eliminado</span>
                                        <?php else: ?>
                                            <?= $dato["nombre_curso"] ?>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-end">
                                        <button type="button" class="btn btn-outline-success btn-sm" title="Actualizar"
                                            data-bs-toggle="modal" data-bs-target="#formularioActualizarModal"
                                            onclick="mostrarHorarioActualizar(<?= $dato['id'] ?>)">
                                            <i class='bx bx-edit-alt'></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm " title="Eliminar"
                                            onclick="eliminarHoarario(<?= $dato['id'] ?>, '<?= $dato['dia_semana'] ?>')">
                                            <i class='bx bxs-trash'></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>


                    </table>
                    <div id="noResultMessage" style="display: none; color: red;">
                        <p class="d-flex justify-content-center align-items-center">No se encontraron resultados.</p>
                    </div>
                </div>
                <div class="card-footer border-0 py-3 ">
                    <span class="text-muted text-sm d-flex justify-content-center align-items-center">
                        Mostrando
                        <!-- <?php /* echo $porPagina; */?>  datos de -->
                        <?php echo $inicio + 1; ?> a
                        <?php echo $inicio + mysqli_num_rows($result); ?> de
                        <?php echo $totalResultadosHora; ?> datos encontrados
                    </span>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination d-flex justify-content-center align-items-center">
                            <?php
                            $totalPaginas = ceil($totalResultadosHora / $porPagina);
                            if ($paginaActual > 1) {
                                echo "<li class='page-item anterior'><a class='page-link bg-info text-white' href='?pagina=" . ($paginaActual - 1) . "'>Anterior</a></li>";
                            }
                            if ($paginaActual < $totalPaginas) {
                                echo "<li class='page-item siguiente'><a class='page-link bg-info text-white' href='?pagina=" . ($paginaActual + 1) . "'>Siguiente</a></li>";
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <?php
            if (!$result) {
                echo "<script>$('#errorModalBody').text('Error en la consulta de docentes: " . mysqli_error($conex) . "'); $('#errorModal').modal('show');</script>";
            }
            ?>
            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Error en la Consulta</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="errorModalBody">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ------------CREAR------------------------ -->
            <div class="modal fade" id="formularioCrearModal" tabindex="-1" aria-labelledby="formularioCrearModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formularioCrearModalLabel">Ingresar datos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action='horarCrear.php' class="p-4" method="POST" id="formularioHorar">
                                <div class="mb-3">
                                    <label class="form-label">Dias:</label>
                                    <select class="form-select" name="dia_semana" required>
                                        <?php
                                        $Dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes');
                                        foreach ($Dias as $dia) {
                                            echo "<option value=\"$dia\">$dia</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hora de inicio:</label>
                                    <input type="time" class="form-control" name="hora_inicio" autofocus required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">hora de fianl:</label>
                                    <input type="time" class="form-control" name="hora_fin" autofocus required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Docente:</label>
                                    <select class="form-select" name="id_docente" required>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Asignatura:</label>
                                    <select class="form-select" name="id_asignatura" required>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Curso:</label>
                                    <select class="form-select" name="id_curso" required>
                                    </select>
                                </div>
                                <input type="hidden" name="oculto">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="btnAgregar"
                                        aria-labelledby="formularioHorar">Agregar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ------------MODDAL ACTUALZIAR------------------------ -->
            <div class="modal fade" id="formularioActualizarModal" tabindex="-1"
                aria-labelledby="formularioActualizarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formularioActualizarModalLabel">Actualizar datos <span
                                    id="idActualizar"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="horarUpda.php" method="POST" id="formularioup">
                                <div class="mb-3">
                                    <label for="diaActualizar" class="form-label">Nombre:</label>
                                    <select class="form-select" name="dia_semana" id="diaActualizar" required>
                                        <?php
                                        $Dias = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes');
                                        foreach ($Dias as $dia) {
                                            echo "<option value=\"$dia\">$dia</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="inicioActualizar" class="form-label">Hora inicio:</label>
                                    <input type="time" class="form-control" id="inicioActualizar" name="hora_inicio"
                                        autofocus required>
                                </div>
                                <div class="mb-3">
                                    <label for="finActualizar" class="form-label">hora fin:</label>
                                    <input type="time" class="form-control" id="finActualizar" name="hora_fin" autofocus
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="docenteActualizar" class="form-label">Docente:</label>
                                    <select class="form-select" name="id_docente" id="docenteActualizar" required>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="asignaturaActualizar" class="form-label">Asignatura:</label>
                                    <select class="form-select" name="id_asignatura" id="asignaturaActualizar" required>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="cursoActualizar" class="form-label">Curso: </label>
                                    <select class="form-select" name="id_curso" id="cursoActualizar" required>
                                    </select>
                                </div>
                                <input type="hidden" name="id" id="idActualizarInput">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('formularioHorar').addEventListener('submit', function (event) {
            event.preventDefault();
            document.getElementById('formularioHorar').submit();
        });
    });
    <?php
    if (isset($_GET["mensaje"]) && $_GET["mensaje"] == 'horario') {
        ?>
        Swal.fire({
            text: 'Horario Agregado',
            icon: 'success',
            confirmButtonColor: 'blue',
            confirmButtonText: 'Click, para continuar'
        });
        <?php
    } elseif (isset($_GET["mensaje"]) && $_GET["mensaje"] == 'error') {
        ?>
        Swal.fire({
            text: 'Error al agregar docente',
            icon: 'error',
            confirmButtonColor: 'red',
            confirmButtonText: 'Cerrar'
        });
        <?php
    }
    ?>
</script>


<?php include '../html/fin.php' ?>