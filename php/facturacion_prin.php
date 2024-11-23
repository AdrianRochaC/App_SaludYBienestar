<?php
// Conexión a la base de datos (ya sea en este archivo o en un archivo externo)
include 'conection.php';

// Obtener los productos desde la base de datos
$sql = "SELECT * FROM products";
$result = $conexion->query($sql);

// Guardar productos en un array
$productos = [];
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Facturación</title>
    <link rel="stylesheet" href="../css/facturacion.css">
    <link rel="icon" type="Logo/png" href="../img/Logo.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <a href="sesion_admin.php"><img src="../img/logo.png" alt="Logo"></a>
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

    <section id="facturacion">
        <h2>Generar Factura</h2>

        <!-- Formulario para agregar productos a la venta -->
        <form action="facturacion.php" method="POST" id="facturaForm">
        <div>
                <!-- Campos para que el administrador ingrese los datos del cliente -->
                <label for="nombre_cliente">Nombre del Cliente:</label>
                <input type="text" id="nombre_cliente" name="nombre_cliente" required><br><br>

                <label for="empresa_cliente">Empresa:</label>
                <input type="text" id="empresa_cliente" name="empresa_cliente" required><br><br>

                <label for="codigo_cliente">Código Cliente:</label>
                <input type="text" id="codigo_cliente" name="codigo_cliente" required><br><br>
            </div>
            <div id="productos"></div> <!-- Aquí se irán agregando los productos -->

            <button type="button" id="agregarProducto">Agregar Producto</button><br><br>

            <label for="total">Total: </label>
            <input type="text" id="total" name="total" readonly><br><br>

            <button type="submit" name="generarFactura" target="blank">Generar Factura</button>
        </form>

    </section>

    <script>
        $(document).ready(function() {
            let productoCount = 0;
            
            // Función para agregar campos de producto
            $('#agregarProducto').click(function() {
                productoCount++;
                
                let options = '';
                // Aquí agregamos las opciones dinámicamente usando el array de productos de PHP
                <?php foreach ($productos as $producto): ?>
                    options += `<option value="<?= $producto['id'] ?>" data-precio="<?= $producto['price'] ?>"><?= $producto['nombre'] ?></option>`;
                <?php endforeach; ?>

                $('#productos').append(`
                    <div class="producto">
                        <label for="producto_${productoCount}">Producto:</label>
                        <select name="producto_${productoCount}" id="producto_${productoCount}" class="productoSelect">
                            <option value="">Seleccione Producto</option>
                            ${options}
                        </select><br>
                        <label for="cantidad_${productoCount}">Cantidad:</label>
                        <input type="number" name="cantidad_${productoCount}" id="cantidad_${productoCount}" min="1"><br>
                        <label for="precio_${productoCount}">Precio:</label>
                        <input type="text" name="precio_${productoCount}" id="precio_${productoCount}" readonly><br><br>
                    </div>
                `);
            });

            // Cuando se cambia el producto, actualizamos el precio
            $(document).on('change', '.productoSelect', function() {
                let precio = $(this).find(':selected').data('precio');
                let cantidad = $(this).closest('.producto').find('input[type="number"]').val();
                $(this).closest('.producto').find('input[type="text"]').val(precio);
                calcularTotal();
            });

            // Cuando se cambia la cantidad, recalcular el precio
            $(document).on('input', 'input[type="number"]', function() {
                calcularTotal();
            });

            // Función para calcular el total
            function calcularTotal() {
                let total = 0;
                $('.producto').each(function() {
                    let precio = $(this).find('input[type="text"]').val();
                    let cantidad = $(this).find('input[type="number"]').val();
                    if (precio && cantidad) {
                        total += (precio * cantidad);
                    }
                });
                $('#total').val(total.toFixed(2));
            }
        });
    </script>
</body>
</html>
