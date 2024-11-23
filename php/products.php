<?php
if (isset($_POST['addProduct'])) {
    // Asegurarse de que los campos son enviados por el formulario
    if (isset($_POST['tipo'], $_POST['nombre'], $_POST['marca'], $_POST['price'], $_POST['stock'])) {
        // Obtener los valores del formulario
        $tipo = $_POST['tipo'];
        $nombre = $_POST['nombre'];
        $marca = $_POST['marca'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        // Incluir la conexión a la base de datos
        include 'conection.php';

        // Preparar la consulta para insertar los datos en la base de datos
        $sql = "INSERT INTO products (tipo, nombre, marca, price, stock) 
                VALUES ('$tipo', '$nombre', '$marca', '$price', '$stock')";

        // Ejecutar la consulta
        if ($conexion->query($sql) === TRUE) {
            echo "<script>alert('Producto agregado exitosamente'); window.location='sesion_admin.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }

        // Cerrar la conexión
        $conexion->close();
    }
}

// Eliminar un producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteProduct'])) {
    $id = $_POST['id'];
    
    $sql = "DELETE FROM products WHERE id = $id";
    if ($conexion->query($sql) === TRUE) {
        echo '
            <script>
                alert("Producto eliminado correctamente");
                window.location = "inventory.php"
            </script>
        ';
    } else {
        echo "Error: " . $conexion->error;
    }
}
?>
