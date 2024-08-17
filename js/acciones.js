// $(document).ready(function() {
//     // Al cargar la página, realizar una solicitud AJAX para obtener los docentes
//     $.ajax({
//         url: "obtener_docentes.php", // Reemplaza con la ruta correcta a tu script PHP
//         method: "GET",
//         dataType: "html",
//         success: function(data) {
//             // Insertar las opciones obtenidas en el campo de selección de docentes
//             $("select[name='id_docente']").html(data);
//         },
//         error: function() {
//             alert("Error al cargar datos de docentes");
//         }
//     });
// });

function confirmLogout() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Quieres cerrar la sesión?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cerrar sesión'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, redirige al script de cerrar sesión
            window.location.href = '../login/cerrar_sesion.php';
        }
    });
    // Devuelve false para evitar el comportamiento predeterminado del enlace
    return false;
}


$(document).ready(function () {
    // Obtener y llenar select de Docentes
    $.getJSON("obtener_datos.php", { tipo: "docentes" }, function (data) {
        llenarSelect(data, "id_docente");
    });

    // Obtener y llenar select de Asignatura
    $.getJSON("obtener_datos.php", { tipo: "asignaturas" }, function (data) {
        llenarSelect(data, "id_asignatura");
    });

    // Obtener y llenar select de Curso
    $.getJSON("obtener_datos.php", { tipo: "cursos" }, function (data) {
        llenarSelect(data, "id_curso");
    });

    function llenarSelect(data, idSelect) {
        var select = $("select[name='" + idSelect + "']");
        $.each(data, function (index, value) {
            select.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
        });
    }
});
$(document).ready(function () {
    $('.calendarioIcon').on('click', function () {
        $(this).siblings('.fecha').datepicker('show');
    });

    $('#formulario').submit(function (event) {
        // Obtén el valor de la fecha
        var fechaIngreso = $('.fecha').val();

        // Verifica si la fecha está vacía
        if (!fechaIngreso) {
            // Evita el envío del formulario
            event.preventDefault();
            // Muestra un mensaje de error o realiza alguna acción adicional si lo deseas
            alert("Por favor, selecciona una fecha de ingreso.");
        }
    });

    $('.fecha').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
});



function buscarTabla() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");
    var noResultMessage = document.getElementById("noResultMessage");
    // Ocultar el mensaje inicialmente
    noResultMessage.style.display = "none";
    var encontrados = false;
    for (i = 0; i < tr.length; i++) {
        // Cambia los índices según las columnas que deseas buscar (empezando desde 0)
        var idUsuarioCol = tr[i].getElementsByTagName("td")[0];
        var nombresCol = tr[i].getElementsByTagName("td")[1];
        var idUsuarioCol = tr[i].getElementsByTagName("td")[2];
        var nombresCol = tr[i].getElementsByTagName("td")[3];
  
        if (idUsuarioCol || nombresCol) {
            var idUsuarioText = idUsuarioCol.textContent || idUsuarioCol.innerText;
            var nombresText = nombresCol.textContent || nombresCol.innerText;
            // Buscar en ambas columnas
            if (idUsuarioText.toLowerCase().indexOf(filter.toLowerCase()) > -1 || nombresText.toLowerCase().indexOf(filter.toLowerCase()) > -1) {
                tr[i].style.display = "";
                encontrados = true;
            } else {
                tr[i].style.display = "none";
            }
        }
    }
    noResultMessage.style.display = encontrados ? "none" : "block";
}
function limpiarBusqueda() {
    var input = document.getElementById("searchInput");
    input.value = ""; // Limpiar el contenido del campo de búsqueda
    // Restaurar la tabla a su estado original
    var table = document.querySelector("table");
    var tr = table.querySelectorAll("tr");
    for (var i = 0; i < tr.length; i++) {
        tr[i].style.display = "";
    }
    // Ocultar el mensaje de "No hay resultados"
    var noResultMessage = document.getElementById("noResultMessage");
    noResultMessage.style.display = "none";
}



//ACTUALIZAR dDOCENTE

function mostrarFormularioActualizar(id, nombre, direccion, celular, email, genero, fecha_ingreso) {
    var formularioActualizar = document.getElementById("formularioActualizar");
    // Llenar los campos del formulario con los datos del usuario seleccionado
    document.getElementById("nombreActualizar").value = nombre;
    document.getElementById("direccionActualizar").value = direccion;
    document.getElementById("celularActualizar").value = celular;
    document.getElementById("emailActualizar").value = email;
    document.getElementById("generoActualizar").value = genero;
    document.getElementById("ingresoActualizar").value = fecha_ingreso;
    document.getElementById("idActualizarInput").value = id;
    document.getElementById("idActualizar").textContent = id;

    formularioActualizar.classList.add('mostrar');
}


// -------CURSO ACTUALIZAR--------
function mostrarCursoActualizar(id, nombre, nivel, periodo_academico) {
    var formularioActualizar = document.getElementById("formularioActualizar");
    // Llenar los campos del formulario con los datos del usuario seleccionado
    document.getElementById("nombreActualizar").value = nombre;
    document.getElementById("nivelActualizar").value = nivel;
    document.getElementById("periodo_academicoActualizar").value = periodo_academico;
    // document.getElementById("generoActualizar").value = genero;
    // document.getElementById("ingresoActualizar").value = fecha_ingreso;
    document.getElementById("idActualizarInput").value = id;
    document.getElementById("idActualizar").textContent = id;

    //  formularioActualizar.classList.add('mostrar');
}


// -------asignatura ACTUALIZAR--------

function mostrarAsignActualizar(id, nombre, descripcion, horas_semana) {
    var formularioActualizar = document.getElementById("formularioActualizar");

    document.getElementById("nombreActualizar").value = nombre;
    document.getElementById("descripcionActualizar").value = descripcion;
    document.getElementById("horasActualizar").value = horas_semana;
    document.getElementById("idActualizarInput").value = id;
    document.getElementById("idActualizar").textContent = id;

    formularioActualizar.classList.add('mostrar');
}


// -------HORARIO ACTUALIZAR--------
function mostrarHorarioActualizar(id) {
    $.ajax({
        type: "GET",
        url: "obtener_datos_actualizar.php",
        data: { id: id },
        dataType: "json",
        success: function (response) {
            if (response.hasOwnProperty('error')) {
                console.error(response.error);
                return;
            }

            llenarSelect(response.docentes, "#docenteActualizar", response.id_docente);
            llenarSelect(response.asignaturas, "#asignaturaActualizar", response.id_asignatura);
            llenarSelect(response.cursos, "#cursoActualizar", response.id_curso);

            $("#diaActualizar").val(response.dia_semana);
            $("#inicioActualizar").val(response.hora_inicio);
            $("#finActualizar").val(response.hora_fin);

            $("#idActualizarInput").val(response.id);

            $("#formularioActualizarModal").modal("show");
        },
        error: function (xhr, status, error) {
            console.error("Error al obtener los datos: " + error);
        }
    });
}

function llenarSelect(data, selector, valorSeleccionado) {
    $(selector).empty(); // Vacía el select

    $.each(data, function (_, item) {
        // Agrega cada opción al select
        $(selector).append(
            $("<option>", {
                value: item.id,
                text: item.nombre,
                selected: (item.id == valorSeleccionado) // Selecciona la opción si coincide con el valor actual
            })
        );
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Verificar si hay un parámetro en la URL llamado 'mensaje'
    const urlParams = new URLSearchParams(window.location.search);
    const mensaje = urlParams.get('mensaje');

    if (mensaje === 'actualizado') {
        Swal.fire({
            text: 'Actualizacion Perfecta!',
            icon: 'success',
            confirmButtonColor: 'blue',
            confirmButtonText: 'Click, para continuar'
        });
    } else if (mensaje === 'ErrorAlActualizado') {
        Swal.fire({
            text: 'Error al actualizar',
            icon: 'error',
            confirmButtonColor: 'red',
            confirmButtonText: 'Cerrar'
        });
    }

    // Agregar confirmación antes de la actualización
    document.getElementById('formularioup').addEventListener('submit', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Confirmar actualización',
            text: '¿Desea actualizar los datos?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: 'red',
            confirmButtonText: 'Sí, actualizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            // Si el usuario confirma, permite que el formulario se envíe
            if (result.isConfirmed) {
                // Envía el formulario manualmente
                document.getElementById('formularioup').submit();
            }
        });
    });
});



// Agregar confirmación antes de la eliminación
document.addEventListener("DOMContentLoaded", function () {
    // Verificar si hay un parámetro en la URL llamado 'mensaje'
    const urlParams = new URLSearchParams(window.location.search);
    const mensaje = urlParams.get('mensaje');

    if (mensaje === 'eliminado') {
        Swal.fire({
            text: 'Usuario eliminado',
            icon: 'success',
            confirmButtonColor: 'blue',
            confirmButtonText: 'Click, para continuar'
        });
    } else if (mensaje === 'ErrorAlEliminar') {
        Swal.fire({
            text: 'Error al eliminar usuario',
            icon: 'error',
            confirmButtonColor: 'red',
            confirmButtonText: 'Cerrar'
        });
    }
});



//-------------------DOCENTE ELIMINAR
// Agregar confirmación antes de la eliminación
function eliminarUsuario(idDocente, nombre) {
    Swal.fire({
        title: "Confirmar eliminación",
        text: `¿Desea eliminar al usuario ${nombre}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: 'red',
        cancelButtonColor: 'blue',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirige al archivo de eliminación después de la segunda alerta
            window.location.href = 'delete.php?id=' + idDocente;
        }
    });
}

//-------------------CURSO ELIMINAR
function eliminarCurso(idCurso, nombre) {
    Swal.fire({
        title: "Confirmar eliminación",
        text: `¿Desea eliminar el Curso ${nombre}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: 'red',
        cancelButtonColor: 'blue',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirige al archivo de eliminación después de la segunda alerta
            window.location.href = 'Cursdelet.php?id=' + idCurso;
        }
    });
}

//-------------------ASIGNATURA ELIMINAR
function eliminarAsign(idAsignatura, nombre) {
    Swal.fire({
        title: "Confirmar eliminación",
        text: `¿Desea eliminar la Asignatura de ${nombre}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: 'red',
        cancelButtonColor: 'blue',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirige al archivo de eliminación después de la segunda alerta
            window.location.href = 'Asigdelet.php?id=' + idAsignatura;
        }
    });
}

//-------------------HORARIO ELIMINAR
function eliminarHoarario(idAsignatura, dia_semana) {
    Swal.fire({
        title: "Confirmar eliminación",
        text: `¿Desea eliminar el horario  ${dia_semana}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: 'red',
        cancelButtonColor: 'blue',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirige al archivo de eliminación después de la segunda alerta
            window.location.href = 'horardelet.php?id=' + idAsignatura;
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("perfilForm").addEventListener("submit", async function (event) {
        event.preventDefault();

        try {
            const response = await fetch("guardar_perfil.php", {
                method: "POST",
                body: new FormData(this),
            });

            if (!response.ok) {
                throw new Error("Error en la solicitud.");
            }

            const data = await response.json();

            const confirmationResult = await Swal.fire({
                title: "Confirmar actualizar",
                text: "¿Desea ACTUALIZAR???",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'blue',
                confirmButtonText: 'Sí, actualizar',
                cancelButtonText: 'Cancelar'
            });

            if (confirmationResult.isConfirmed && data.success) {
                Swal.fire({
                    title: 'Verificando...',
                    text: 'Por favor, espera un momento.',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });

                setTimeout(() => {
                    Swal.fire({
                        text: 'Datos actualizados',
                        icon: 'success',
                        confirmButtonColor: 'blue',
                        confirmButtonText: 'Click, para continuar'
                    });
                }, 1000);
            }
        } catch (error) {
            console.error("Error:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al procesar la solicitud.',
            });
        }
    });
});




// $(document).ready(function () {
//     // Obtén la URL actual
//     var url = window.location.href;

//     // Verifica cada enlace en la barra lateral
//     $('.navbar-nav a').each(function () {
//         // Compara la URL actual con la URL del enlace
//         if (url.indexOf($(this).attr('href')) > -1) {
//             // Agrega la clase 'active' al enlace seleccionado
//             $(this).addClass('active');
//         }
//     });
// });
