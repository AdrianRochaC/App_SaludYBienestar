// register.js
document.getElementById('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario

    const name = document.getElementById('name').value;
    const lastName = document.getElementById('last_name').value;
    const date = document.getElementById('date').value;
    const email = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confirm').value;
    const warnings = document.getElementById('warnings');

    warnings.innerHTML = ""; // Limpiar advertencias

    // Validación del correo electrónico
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        warnings.innerHTML += "El correo electrónico no es válido.<br>";
    }

    // Validación de la contraseña
    const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // Al menos 8 caracteres, letras y números
    if (!passwordPattern.test(password)) {
        warnings.innerHTML += "La contraseña debe tener al menos 8 caracteres y contener letras y números.<br>";
    }

    // Validación de coincidencia de contraseñas
    if (password !== confirm) {
        warnings.innerHTML += "Las contraseñas no coinciden.<br>";
    }

    // Si no hay advertencias, puedes proceder a enviar el formulario
    if (warnings.innerHTML === "") {
        // Enviar datos al servidor
        fetch('/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name,
                lastName,
                date,
                email,
                password
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en el registro');
            }
            return response.json();
        })
        .then(data => {
            alert("Registro exitoso. Serás redirigido al inicio de sesión.");
            window.location.href = "login.html"; // Cambia a la URL de tu página de inicio de sesión
        })
        .catch(error => {
            warnings.innerHTML += "Error: " + error.message + "<br>";
        });
    }
});