<?php
include 'conection.php';
require('../fpdf/fpdf.php'); // Asegúrate de tener la librería FPDF (puedes descargarla desde http://www.fpdf.org/)

if (isset($_POST['generarFactura'])) {
    $productos = [];
    $total = 0;
    $fecha = date('Y-m-d H:i:s');

    // Obtener los datos del cliente desde el formulario
    $nombre_cliente = $_POST['nombre_cliente'];
    $empresa_cliente = $_POST['empresa_cliente'];
    $codigo_cliente = $_POST['codigo_cliente'];

    // Obtener productos y cantidades
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'producto_') === 0 && !empty($value)) {
            $productoId = $value;
            $cantidad = $_POST['cantidad_' . substr($key, 9)];
            $sql = "SELECT * FROM products WHERE id = $productoId";
            $result = $conexion->query($sql);
            $producto = $result->fetch_assoc();
            $productos[] = [
                'id' => $productoId,
                'nombre' => $producto['nombre'],
                'precio' => $producto['price'],
                'cantidad' => $cantidad,
                'subtotal' => $producto['price'] * $cantidad
            ];
            $total += $producto['price'] * $cantidad;
        }
    }

    // Generar factura en PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Factura');
    $pdf->Ln(10);

    // Datos del cliente
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(50, 10, "Cliente: $nombre_cliente");
    $pdf->Ln(5);
    $pdf->Cell(50, 10, "Empresa: $empresa_cliente");
    $pdf->Ln(5);
    $pdf->Cell(50, 10, "Codigo Cliente: $codigo_cliente");
    $pdf->Ln(10);

    // Detalles de la factura
    $pdf->SetFont('Arial', 'B', 10); // Títulos de la tabla de productos
    $pdf->Cell(50, 10, 'Producto');
    $pdf->Cell(30, 10, 'Precio');
    $pdf->Cell(30, 10, 'Cantidad');
    $pdf->Cell(30, 10, 'Subtotal');
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 10); // Datos de los productos
    foreach ($productos as $producto) {
        $pdf->Cell(50, 10, $producto['nombre']);
        $pdf->Cell(30, 10, $producto['precio']);
        $pdf->Cell(30, 10, $producto['cantidad']);
        $pdf->Cell(30, 10, $producto['subtotal']);
        $pdf->Ln();
    }

    // Mostrar el total
    $pdf->Ln(10);
    $pdf->Cell(50, 10, 'Total:');
    $pdf->Cell(30, 10, $total);

    // Guardar factura en base de datos
    $stmt = $conexion->prepare("INSERT INTO facturas (productos, total, fecha, nombre_cliente, empresa_cliente, codigo_cliente) VALUES (?, ?, ?, ?, ?, ?)");
    $productosJson = json_encode($productos);
    $stmt->bind_param('ssssss', $productosJson, $total, $fecha, $nombre_cliente, $empresa_cliente, $codigo_cliente);
    $stmt->execute();

    // Descargar PDF
    $pdf->Output('I', 'factura.pdf');
}
?>
