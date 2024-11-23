<?php
session_start();

include 'conection.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

// Validar el login en la base de datos
$validar_login = mysqli_query($conexion, "SELECT * FROM register WHERE correo = '$correo' and contrasena = '$contrasena'");

if(mysqli_num_rows($validar_login) > 0){
    $_SESSION['correo'] = $correo;

    // Comprobar si el correo es admin1@gmail.com
    if ($correo == 'admin1@gmail.com') {
        // Redirigir a inventory.php si es admin
        header("Location: sesion_admin.php");
        exit();
    } else {
        // Redirigir a sesion_index.php si no es admin
        header("Location: sesion_index.php");
        exit();
    }
} else {
    echo '
        <script>
            alert("Usuario no existe, verifique credenciales.");
            window.location = "login.php";
        </script>
    ';
    exit();
}
?>
