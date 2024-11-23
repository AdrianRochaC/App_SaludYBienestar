<?php
session_start();

// Verifica si el carrito está vacío o si no existe sesión activa
if (!isset($_SESSION['correo'])) {
    echo '<script>
            alert("Debes iniciar sesión para agregar productos al carrito");
            window.location = "login.php";
          </script>';
    exit;
}

// Calcula el total del carrito
$total = 0;
if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto) {
        $total += $producto['precio'] * $producto['cantidad'];
    }
}

// Convertir a centavos para Stripe (multiplicamos por 100)
$totalEnCentavos = intval($total * 100); // Total en centavos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="icon" type="Logo/png" href="../img/Logo.png">
    <script src="../js/carrito.js" defer></script> <!-- Vincula el archivo carrito.js -->
    <link rel="stylesheet" href="../css/carrito.css">
    <style>
        /* General */
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");

html {
    background-color: #559EC4;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box; /* Añadir esta propiedad para un control adecuado del padding y margin */
}

body {
    font-family: Arial, sans-serif;
    background-color: #D1ECFA;
    margin: 20px;
}

/* Header */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    background-color: #559EC4;
    padding: 10px 20px;
    border-radius: 10px;
}

/* Logo */
.logo img {
    height: 60px;
    width: auto;
}

/* Barra de búsqueda */
.search {
    display: flex;
    align-items: center;
}

.search input {
    padding: 8px;
    border-radius: 5px;
}

.search button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0 10px;
}

.search button svg {
    fill: #000;
    width: 20px;
    height: 20px;
}

/* Contenido */
section#contenido {
    width: 100%;
    margin: auto;
    background-color: #D1ECFA;
    padding: 20px;
    border-radius: 10px;
    border: none;
}

/* Título */
h2 {
    font-size: 24px;
    text-align: center;
    color: #559EC4;
}

/* Tabla del carrito */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #559EC4;
    color: white;
    font-size: 1rem;
}

td {
    font-size: 0.95rem;
}

table tr:hover {
    background-color: #f7f7f7;
}

table .eliminar {
    padding: 7px 20px;
    border: none;
    border-radius: 5px;
    background-color: #559EC4;
    color: white;
    cursor: pointer;
    box-shadow: 1px solid #000;
}

table .eliminar:hover {
    background-color: #316f91;
}

/* Botón "Vaciar carrito" */
#boton2 {
    height: 40px;
    width: 120px;
    background-color: #559EC4;
    color: white;
    border-radius: 15px;
    border: none;
    margin-top: 20px;
    cursor: pointer;
}

#boton2:hover {
    background-color: #316f91;
}

/* Estilos de los productos */
#items {
    width: 100%;
}

/* Estilos de los formularios */
form {
    text-align: center;
    margin-top: 20px;
}

form input[type="hidden"] {
    display: none;
}

form button {
    height: 40px;
    width: 200px;
    background-color: #559EC4;
    color: white;
    border-radius: 15px;
    border: none;
    cursor: pointer;
    font-size: 16px;
}

form button:hover {
    background-color: #316f91;
}

form p {
    font-size: 18px;
    font-weight: bold;
    color: #559EC4;
    margin-top: 10px;
}

/* Contenedor de elementos */
.container {
    width: 100%;
    overflow-x: auto;
}
    </style> <!-- Vincula el archivo CSS -->
</head>
<body>
<main><CENTER>
      <br><br>
   <img <img id="titulo" src="../img/tituloCarrito.png"><!-- Título de la sección -->
    </CENTER>
    <section id="contenido">
        <div>
            <center>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Precio</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="items">
                        <!-- Aquí se agregarán los productos dinámicamente -->
                    </tbody>
                </table>
                <h2>Total a Pagar: $<span id="total"><?php echo number_format($total, 2); ?></span></h2>
                <button id="boton2" onclick="vaciarCarrito()">Vaciar Carrito</button>
                <!-- Formulario de pago -->
                <form action="pay.php" method="POST">
    <input type="hidden" name="amount" value="<?php echo $totalEnCentavos; ?>"> <!-- El monto en centavos -->
    <button type="submit">Proceder al pago</button>
</form>

            </center>
        </div>
    </section>
  </main>
</body>
</html>
