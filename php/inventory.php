<?php

    session_start();

    if(!isset($_SESSION['correo'])){
        echo '
            <script>
                alert("Debes iniciar sesion como administrador");
                window.location = "login.php";
            </script>
        ';
    }

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="icon" type="Logo/png" href="../img/Logo.png">
    <link rel="stylesheet" href="../css/inventory.css">
</head>
<body>
    <header>
    <div class="logo">
      <a href="sesion_admin.php"><img src="../img/Logo.png" alt="Droguería Salud y Bienestar"></a>
  </div>
  <nav>
      <form class="search">
          <a href="perfil1.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
          </svg></a>
          <a href="cerrar_sesion.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
          </svg></a>
      </form>
  </nav>
    </header>

    <section id="contenido">
        <h2>Agregar Producto</h2><br>
        <form action="products.php" method="POST">
    <input type="text" name="tipo" placeholder="Tipo del Producto" required>
    <input type="text" name="nombre" placeholder="Nombre del Producto" required>
    <input type="text" name="marca" placeholder="Marca" required>
    <input type="number" name="price" placeholder="Precio" required>
    <input type="number" name="stock" placeholder="Stock" required>
    <br><center>
    <button type="submit" name="addProduct">Agregar Producto</button><br></center>
</form>

        </center>
    <section>
       <br> <h2>Inventario</h2>
       <table id="productTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="productList">
        <?php
            include 'conection.php';
            $sql = "SELECT * FROM products";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["tipo"] . "</td>
                            <td>" . $row["nombre"] . "</td>
                            <td>" . $row["marca"] . "</td>
                            <td>" . $row["price"] . "</td>
                            <td>" . $row["stock"] . "</td>
                            <td>
                                <form action='php/products.php' method='POST'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <button type='submit' name='deleteProduct' class='delete' style='width:100%'>Eliminar</button>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay productos disponibles</td></tr>";
            }

            $conexion->close();
        ?>
    </tbody>
</table>

    </section>
    </section>
</body>
</html>