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
$sqlTotal = "SELECT COUNT(*) as total FROM docentes ";
$resultTotal = mysqli_query($conex, $sqlTotal);
$totalResultados = mysqli_fetch_assoc($resultTotal)['total'];
$sql = "SELECT * FROM docentes  LIMIT $inicio, $porPagina";
$result = mysqli_query($conex, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($dato = mysqli_fetch_assoc($result)) {
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
                        <!-- Title -->
                        <h1 class="h2 mb-0 ls-tight  ">
                            <img src="https://bytewebster.com/img/logo.png" width="40"> Instituto Educativo RMTC
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="card shadow border-0 mb-7 ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Docentes </h5>
                    <form class="me-2 d-flex justify-content-between align-items-center" role="search">
                        <input class="form-control search-clear " onclick="limpiarBusqueda()" type="search"
                            id="searchInput" placeholder="Buscar..." onkeyup="buscarTabla()" aria-label="Search">
                        <!-- <a data-bs-toggle="modal" data-bs-target="#formularioCrearModal"
                            class="btn d-inline-flex btn-sm btn-primary mx-3">
                            <span class=" pe-2">Crear</span>
                            <span>
                                <i class='bx bx-user-plus' style='font-size: 19px;'></i>
                            </span>
                        </a> -->
                        <a data-bs-toggle="modal" data-bs-target="#formularioCrearModal"
                            class="btn d-flex btn-sm btn-primary mx-3 align-items-center justify-content-end">
                            <span class=" pe-2">Crear</span>
                            <i class='bx bx-user-plus' style='font-size: 19px;'></i>
                        </a>
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
                if (isset($_GET["mensaje"]) and $_GET["mensaje"] == 'registrado') {
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
                <!-- ALERTAS DE ACTUALIZACION -->
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
                <!-- DELETE ALERTA -->
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
                            <tr>
                                <!-- <th scope="col">ID</th> -->
                                <th scope="col"><strong>NOMBRES</strong></th>
                                <th scope="col"><strong>celular</strong></th>
                                <th scope="col"><strong>Direccion</strong></th>
                                <th scope="col"><strong>email</strong></th>
                                <th scope="col"><strong>genero</strong></th>
                                <th scope="col"><strong>fecha</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($result as $dato) {
                                ?>
                                <tr class="text-heading text-capitalize">

                                    <td scope="row">
                                        <?= $dato["nombre"] ?>
                                    </td>
                                    <td>
                                        <?= $dato["celular"] ?>
                                    </td>
                                    <td>
                                        <?= $dato["direccion"] ?>
                                    </td>
                                    <td>
                                        <?= $dato["email"] ?>
                                    </td>
                                    <td>
                                        <?= $dato["genero"] ?>
                                    </td>
                                    <td>
                                        <?= $dato["fecha_ingreso"] ?>
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-outline-success btn-sm " title="Actualizar"
                                            data-bs-toggle="modal" data-bs-target="#formularioActualizarModal"
                                            onclick="mostrarFormularioActualizar(<?= $dato['id'] ?>, '<?= $dato['nombre'] ?>','<?= $dato['direccion'] ?>','<?= $dato['celular'] ?>' , '<?= $dato['email'] ?>', '<?= $dato['genero'] ?>', '<?= $dato['fecha_ingreso'] ?>')">
                                            <!--LOS CAMPOS Q TRAIGO PARA MOSTRAR AL EDITAR  -->
                                            <i class='bx bx-edit-alt'></i>
                                        </button>

                                        <button type="button" class="btn btn-outline-danger btn-sm " title="Eliminar"
                                            onclick="eliminarUsuario(<?= $dato['id'] ?>, '<?= $dato['nombre'] ?>')">
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
                <!-- <div class="card-footer border-0 py-5">
                    <span class="text-muted text-sm">Mostrando 10 artículos de 250 resultados encontrados</span>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link disabled" href="#">Anterior</a></li>
                            <li class="pagitem"><a class="page-link bg-info text-white" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                        </ul>
                    </nav>
                </div> -->

                <div class="card-footer border-0 py-3">
                    <span class="text-muted text-sm d-flex justify-content-center align-items-center">
                        Mostrando
                        <!-- <?php /* echo $porPagina; */?>  datos de -->
                        <?php echo $inicio + 1; ?> a
                        <?php echo $inicio + mysqli_num_rows($result); ?> de
                        <?php echo $totalResultados; ?> datos encontrados
                    </span>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination d-flex justify-content-center align-items-center">
                            <?php
                            $totalPaginas = ceil($totalResultados / $porPagina);
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
                            <form action='crear.php' class="p-4" method="POST" id="formulario">
                                <div class="mb-3">
                                    <label class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" name="nombre" autofocus required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Direccion:</label>
                                    <input type="text" class="form-control" name="direccion" autofocus required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Celular:</label>
                                    <input type="tel" pattern="[0-9]*" class="form-control" name="celular" autofocus
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="email" autofocus required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Genero:</label>
                                    <select class="form-select" name="genero" required>
                                        <?php
                                        $generos = array('Masculino', 'Femenino', 'Otro');
                                        foreach ($generos as $genero) {
                                            echo "<option value=\"$genero\">$genero</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Fecha de Ingreso: </label>
                                    <div class="input-group fecha-input">
                                        <input type="text" class="form-control fecha" name="fecha_ingreso" required>
                                        <span class="input-group-text calendarioIcon"><i
                                                class="bi bi-calendar2-check"></i></span>
                                    </div>
                                </div>
                                <input type="hidden" name="oculto">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="btnAgregar"
                                        aria-labelledby="formulario">Agregar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ------------ACTUALIZAR------------------------ -->
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
                            <form action="actualizar.php" method="POST" id="formularioup">
                                <div class="mb-3">
                                    <label for="nombreActualizar" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombreActualizar" name="nombre"
                                        autofocus required>
                                </div>
                                <div class="mb-3">
                                    <label for="direccionActualizar" class="form-label">Direccion:</label>
                                    <input type="text" class="form-control" id="direccionActualizar" name="direccion"
                                        autofocus required>
                                </div>
                                <div class="mb-3">
                                    <label for="celularActualizar" class="form-label">Celular:</label>
                                    <input type="tel" pattern="[0-9]*" class="form-control" id="celularActualizar"
                                        name="celular" autofocus required>
                                </div>
                                <div class="mb-3">
                                    <label for="emailActualizar" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="emailActualizar" name="email" autofocus
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="generoActualizar" class="form-label">Genero:</label>
                                    <select class="form-select" name="genero" id="generoActualizar" required>
                                        <?php
                                        $generos = array('Masculino', 'Femenino', 'Otro');
                                        foreach ($generos as $genero) {
                                            echo "<option value=\"$genero\">$genero</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="ingresoActualizar" class="form-label">Fecha de Ingreso: </label>
                                    <div class="input-group fecha-input">
                                        <input type="text" class="form-control fecha" id="ingresoActualizar"
                                            name="fecha_ingreso" required>
                                        <span class="input-group-text calendarioIcon"><i
                                                class="bi bi-calendar2-check"></i></span>
                                    </div>
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
        document.getElementById('formulario').addEventListener('submit', function (event) {
            event.preventDefault();
            document.getElementById('formulario').submit();
        });
    });
    <?php
    if (isset($_GET["mensaje"]) && $_GET["mensaje"] == 'registrado') {
        ?>
        Swal.fire({
            text: 'Datos registrados',
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