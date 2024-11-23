<?php

include 'conection.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$confirmar = $_POST['confirmar'];

// Validación de la contraseña (debe tener al menos 8 caracteres, una mayúscula, un número, pero sin caracteres especiales)
if (!preg_match('/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $contrasena)) {
    echo '
        <script>
            alert("La contraseña no es segura. Debe tener al menos 8 caracteres, una mayúscula y un número, pero no se permiten caracteres especiales.");
            window.location = "login.php";
        </script>
    ';
    exit();
}

// Verificar si la contraseña y la confirmación coinciden
if ($contrasena !== $confirmar) {
    echo '
        <script>
            alert("Las contraseñas no coinciden.");
            window.location = "login.php";
        </script>
    ';
    exit();
}

// Encriptar las contraseñas
$contrasena = hash('sha512', $contrasena);
$confirmar = hash('sha512', $confirmar);

// Verificar que el correo no exista en la base de datos
$verificar_correo = mysqli_query($conexion, "SELECT * FROM register WHERE correo = '$correo'");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo '
        <script>
            alert("Este correo ya está en uso.");
            window.location = "login.php";
        </script>
    ';
    exit();
}

// Realizar la inserción en la base de datos
$query = "INSERT INTO register (nombre, apellido, correo, contrasena, confirmar) VALUES
            ('$nombre', '$apellido', '$correo', '$contrasena', '$confirmar')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '
        <script>
            alert("Usuario almacenado exitosamente!");
            window.location = "login.php";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Inténtalo de nuevo, usuario no almacenado exitosamente.");
            window.location = "login.php";
        </script>
    ';
}

mysqli_close($conexion);

?>
