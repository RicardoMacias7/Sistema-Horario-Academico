function notif(email) {
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            const notification = new Notification(
                'bienvenido',
                {
                    body: 'inicio exitoso, usuario  ' + email,
                    icon: 'https://img.freepik.com/fotos-premium/gato-guerrero_264411-5441.jpg?size=626&ext=jpg&ga=GA1.1.386372595.1698019200&semt=ais'
                    //puedo poner una icono
                });
        }
    });
}

function showRegisterForm() {
    var loginForm = document.getElementById("loginForm");
    var registerForm = document.getElementById("registerForm");
    var toggleLink = document.getElementById("toggleLink");
    var titulo = document.querySelector(".name");
    if (loginForm.style.display === "block") {
        loginForm.style.display = "none";
        registerForm.style.display = "block";
        toggleLink.textContent = "Inicio de Sesión";
        titulo.textContent = "Registrarse";
    } else {
        loginForm.style.display = "block";
        registerForm.style.display = "none";
        toggleLink.textContent = " Registrarse";
        titulo.textContent = "Inicio de Sesión";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const pwShowHide = document.querySelector("#loginForm .pw_hide");
    const pwdInput = document.getElementById("pwd");

    pwShowHide.addEventListener("click", () => {
        if (pwdInput.type === "password") {
            pwdInput.type = "text";
            pwShowHide.classList.replace("uil-eye-slash", "uil-eye");
        } else {
            pwdInput.type = "password";
            pwShowHide.classList.replace("uil-eye", "uil-eye-slash");
        }
    });
    const new_pwShowHide = document.querySelector("#registerForm .pw_hide");
    const new_pwInput = document.getElementById("newpwd");
    new_pwShowHide.addEventListener("click", () => {
        if (new_pwInput.type === "password") {
            new_pwInput.type = "text";
            new_pwShowHide.classList.replace("uil-eye-slash", "uil-eye");
        } else {
            new_pwInput.type = "password";
            new_pwShowHide.classList.replace("uil-eye", "uil-eye-slash");
        }
    });
});


//   function Register() {
//       var name = document.getElementById('nombre').value;
//       var apellido = document.getElementById('apellido').value;
//       var email = document.getElementById('newemail').value;
//       var phone = document.getElementById('telef').value;
//       var new_pwd = document.getElementById('newpwd').value;
//       if (name && apellido && email && phone && new_pwd) {
//           // notif(name, apellido);
//           document.getElementById('nombre').value = '';
//           document.getElementById('apellido').value = '';
//           document.getElementById('newpwd').value = '';
//           document.getElementById('telef').value = '';
//           document.getElementById('newpwd').value = '';
//           Swal.fire({
//               icon: 'success',
//               title: 'Registro exitoso',
//               text: '¡Bienvenido, ' + name + ' ' + apellido + '!',
//               confirmButtonColor: 'blue',
//           }).then(() => {
//               // window.location.href = '../docentes/inicio.php';
//           });
//           return false;
//       } else {
//           Swal.fire({
//               icon: 'error',
//               title: 'Error de Registro',
//               text: 'Debe completar todos los campos obligatorios',
//               confirmButtonColor: 'red',
//               confirmButtonText: 'Entendido'
//           });
//       }
//       return false;
//   }


// function Login() {
    //      var email = document.getElementById('email').value;
    //      var password = document.getElementById('pwd').value;
    //      if (email === 'rik@m.com' && password === 'mac') {
    //          notif(email);
    //          Swal.fire({
    //              icon: 'success',
    //              title: 'Inicio de Sesión Exitoso',
    //              text: '¡Bienvenido, ' + email + '!',
    //              confirmButtonColor: 'blue',
    //          }).then(() => {
    //              window.location.href = '../docentes/inicio.php';
    //          });
    //          return false;
    //      } else {
    //          Swal.fire({
    //              icon: 'error',
    //              title: 'Error de Inicio de Sesión',
    //              text: 'Correo o contraseña incorrectos.',
    //              confirmButtonColor: 'red',
    //              confirmButtonText: 'Volver a itentarlo'
    //          });
    //          return false;
    //      }
    //  }