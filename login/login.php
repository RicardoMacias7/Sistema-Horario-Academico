
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fef7f7">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="icon" href="../img/GA.jpg" type="image/png"> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="logixn.js"></script>
    <title>Login</title>
</head>
<body>

    <div class="wrapper">
        <div class="logo">
            <img src="../img/gaa.jpg" alt="">
        </div>
        <div class="text-center mt-4 name texto-con-reflejo">
            Inicio de Sesión
        </div>
 
        <form class="p-3 mt-3" id="loginForm" name="loginForm" method="POST">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-address-book"></span>
                <input type="email" name="email" id="email" placeholder="Correo" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Contraseña" required>
                <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="remenber">
                <label><input type="checkbox">Recordarme</label>
                <a href="#">¿Contraseña olvidada?</a>
            </div>
            <button class="btn mt-3" type="submit" name="iniciar">Entrar</button>
        </form>
        <?php
    include_once "registrar.php";
    ?>
        <!-- <form class="p-3 mt-3" id="registerForm" name="registerForm" style="display: none;" onsubmit="return Register()"
            method="POST" action="registro.php"> -->
        <form class="p-3 mt-3" id="registerForm" name="registerForm" style="display: none;" method="POST">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                <i class='bx bx-user'></i>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="apellido" id="apellido" placeholder="Apellido" required>
                <i class='bx bx-user'></i>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-address-book"></span>
                <input type="email" name="newemail" id="newemail" placeholder="Correo" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-phone"></span>
                <input type="tel" pattern="[0-9]*" name="telef" id="telef" placeholder="Teléfono" required>
                <i class='bx bxs-phone'></i>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="newpwd" id="newpwd" placeholder="Contraseña" required>
                <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="bi bi-geo-alt-fill"></span>
                <input type="text" name="direccion" id="direccion" placeholder="Direccion" required>
                <i class='bx bxs-location-plus'></i>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" required>
                <i class='bx bxs-city' ></i>
            </div>
            <button class="btn mt-3" type="submit" name="registrar">Registrarse</button>
        </form>
        <br>
        <div class="text-center fs-6 text-a">
            <a href="#" id="toggleLink" onclick="showRegisterForm()">Registrarse</a>
        </div>
    </div>
 
</body>

</html>