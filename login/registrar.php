<?php
include_once "conex.php";

if (isset($_POST['registrar'])) {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['newemail']);
    $telefono = trim($_POST['telef']);
    $newpwd = trim($_POST['newpwd']);
    $direccion = trim($_POST['direccion']);
    $ciudad = trim($_POST['ciudad']);

    if (
        strlen($nombre) >= 1 &&
        strlen($apellido) >= 1 &&
        strlen($email) >= 1 &&
        strlen($telefono) >= 1 &&
        strlen($newpwd) >= 1 &&
        strlen($direccion) >= 1 &&
        strlen($ciudad) >= 1
    ) {
        // Verificar si el correo electrónico ya existe
        $consulta_verificar_email = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
        $stmt_verificar_email = mysqli_prepare($conex, $consulta_verificar_email);
        mysqli_stmt_bind_param($stmt_verificar_email, "s", $email);
        mysqli_stmt_execute($stmt_verificar_email);
        mysqli_stmt_bind_result($stmt_verificar_email, $cantidad_email);
        mysqli_stmt_fetch($stmt_verificar_email);
        mysqli_stmt_close($stmt_verificar_email);

        if ($cantidad_email > 0) {
            ?>
            <script>
                Swal.fire({
                    title: 'Guardando...',
                    text: 'Por favor, espera un momento.',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });
                setTimeout(() => {
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: 'El correo electrónico ya está registrado',
                        confirmButtonColor: 'red',
                    });
                }, 1000);
            </script>
            <?php
        } else {
            // El correo electrónico no está registrado, proceder con la inserción
            $consulta = "INSERT INTO usuarios (nombre, apellido, email, telefono, password, direccion,ciudad) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conex, $consulta);
            $hashedPassword = password_hash($newpwd, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sssssss", $nombre, $apellido, $email, $telefono, $hashedPassword, $direccion, $ciudad);

            if (mysqli_stmt_execute($stmt)) {
                ?>
                <script>
                    Swal.fire({
                        title: 'Guardando...',
                        text: 'Por favor, espera un momento.',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    setTimeout(() => {
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: '¡Bienvenido!',
                            text: 'Se ha registrado exitosamente',
                            confirmButtonColor: 'blue',
                        });
                    }, 1000);
                </script>
                <?php
            } else {
                ?>
                <script>
                    Swal.fire({
                        title: 'Guardando...',
                        text: 'Por favor, espera un momento.',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'Registro fallido',
                            confirmButtonColor: 'red',
                        });
                    }, 1000);
                </script>
                <?php
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'Llenar todos los campos',
                confirmButtonColor: 'red',
            });
        </script>
        <?php
    }
}


if (isset($_POST['iniciar'])) {
    if (
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['password']) >= 1
    ) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $consulta = "SELECT id, nombre, apellido, email, password FROM usuarios WHERE email = ?";
        $stmt = mysqli_prepare($conex, $consulta);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $nombre, $apellido, $email, $hashed_password);
        if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['usuario_id'] = $id;
                $_SESSION['id'] = $id;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['apellido'] = $apellido;
                $_SESSION['email'] = $email;
                ?>
                <script>
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
                            icon: 'success',
                            title: '¡Bienvenido!',
                            text: 'Inicio de sesión exitoso',
                            confirmButtonColor: 'blue',
                        }).then(() => {
                            window.location.href = '../horario/horario.php';
                        });
                    }, 1000);
                </script>
                <?php
                exit();
            } else {
                ?>
                <script>
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
                            icon: 'info',
                            text: 'Contraseña incorrecta',
                            confirmButtonColor: 'blue',
                        });
                    }, 1000);
                </script>
                <?php
            }
        } else {
            ?>
            <script>
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
                        icon: 'warning',
                        text: 'Usuario no encontrado',
                        confirmButtonColor: 'blue',
                    });
                }, 1000);
            </script>
            <?php
        }
        mysqli_stmt_close($stmt);
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'info',
                text: 'Por favor, complete todos los campos',
                confirmButtonColor: 'red',
            });
        </script>
        <?php
    }
}
?>