<?php
session_start();
include 'conection.php'; // Conexión a la base de datos (este archivo debe tener tu configuración de la base de datos)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario // Asumimos que el id del perfil está almacenado en la sesión
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $pais = $_POST['pais'];

    // Comprobar si el correo ya existe
    $query = "SELECT * FROM perfil WHERE correo = '$correo'";
    $result = mysqli_query($conexion, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Si el correo ya existe, hacer un UPDATE de los datos
        $update_query = "UPDATE perfil SET nombre_completo = '$nombre_completo', telefono = '$telefono', direccion = '$pais' WHERE correo = '$correo'";

        if (mysqli_query($conexion, $update_query)) {
            // Actualización exitosa, actualizar la sesión con los nuevos datos
            $_SESSION['nombre_completo'] = $nombre_completo;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['pais'] = $pais;
            echo "<script>alert('Perfil actualizado correctamente.'); window.location.href = 'perfil_client.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar el perfil.'); window.location.href = 'perfil_client.php';</script>";
        }
    } else {
        // Si el correo no existe, hacer un INSERT de los nuevos datos
        $insert_query = "INSERT INTO perfil (nombre_completo, correo, telefono, direccion) VALUES ('$nombre_completo', '$correo', '$telefono', '$pais')";

        if (mysqli_query($conexion, $insert_query)) {
            // Insertar datos correctamente, actualizar sesión
            $_SESSION['nombre_completo'] = $nombre_completo;
            $_SESSION['correo'] = $correo;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['pais'] = $pais;
            echo "<script>alert('Perfil creado correctamente.'); window.location.href = 'perfil_client.php';</script>";
        } else {
            echo "<script>alert('Error al crear el perfil.'); window.location.href = 'perfil_client.php';</script>";
        }
    }
}

?>
