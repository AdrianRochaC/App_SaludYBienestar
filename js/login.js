// Función para mostrar el formulario de login
function showLoginForm() {
    document.getElementById("loginForm").style.display = "block";
    document.getElementById("registerForm").style.display = "none";
}

// Función para mostrar el formulario de registro
function showRegisterForm() {
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("registerForm").style.display = "block";
}

// Validación del formulario de login
function validateLogin(event) {
    event.preventDefault();

    const username = document.getElementById("loginUsername").value;
    const password = document.getElementById("loginPassword").value;

    // Validación para asegurar que los campos no estén vacíos
    if (username === "" || password === "") {
        document.getElementById("loginWarnings").textContent = "Por favor, ingresa todos los campos.";
        return false;
    }

    // Simulación de validación (en un entorno real, deberías validar contra un servidor)
    if (username === "usuario" && password === "contraseña") {
        window.location.href = "index.html"; // Redirige a la página principal
        return true;
    } else {
        document.getElementById("loginWarnings").textContent = "Usuario o contraseña incorrectos.";
        return false;
    }
}

// Validación del formulario de registro
function validateRegister(event) {
    event.preventDefault();

    const name = document.getElementById("registerName").value;
    const lastName = document.getElementById("registerLastName").value;
    const username = document.getElementById("registerUsername").value;
    const password = document.getElementById("registerPassword").value;
    const confirmPassword = document.getElementById("registerConfirm").value;

    // Validación de contraseñas
    if (password !== confirmPassword) {
        document.getElementById("registerWarnings").textContent = "Las contraseñas no coinciden.";
        return false;
    }

    // Validación de campos vacíos
    if (name === "" || lastName === "" || username === "" || password === "") {
        document.getElementById("registerWarnings").textContent = "Por favor, ingresa todos los campos.";
        return false;
    }

    // Si todo es correcto, se muestra un mensaje de éxito
    alert("¡Registro exitoso! Ahora puedes iniciar sesión.");
    showLoginForm(); // Volver al formulario de login después de un registro exitoso
    return true;
}
