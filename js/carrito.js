function agregarAlCarrito(nombre, marca, precio) {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];  // Obtener carrito del localStorage, o crear uno vacío si no existe

    // Buscar si el producto ya está en el carrito
    const productoExistente = carrito.find(item => item.nombre === nombre);
    
    if (productoExistente) {
        // Si el producto ya existe, aumentar la cantidad
        productoExistente.cantidad += 1;
    } else {
        // Si no existe, agregarlo con cantidad 1
        carrito.push({ nombre: nombre, marca: marca, precio: parseFloat(precio), cantidad: 1 });
    }

    // Guardar el carrito actualizado en localStorage
    localStorage.setItem('carrito', JSON.stringify(carrito));

    // Mostrar alerta confirmando la adición del producto
    alert(`${nombre} ha sido agregado al carrito.`);
}


function mostrarCarrito() {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    let total = 0;

    // Limpiar el contenido actual de la tabla
    const tbody = document.querySelector('#items');
    tbody.innerHTML = '';  // Limpiar la tabla antes de agregar nuevos productos

    // Agregar cada producto al cuerpo de la tabla
    carrito.forEach((item, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.cantidad}</td>
            <td>${item.nombre}</td>
            <td>${item.marca}</td>
            <td>$${item.precio.toFixed(2)}</td>
            <td><button onclick="eliminarDelCarrito(${index})" class="eliminar">Eliminar</button></td>
        `;
        tbody.appendChild(row);
        total += item.precio * item.cantidad; // Calcular el total considerando la cantidad
    });

    // Actualizar el total en el HTML
    const totalElement = document.getElementById('total');
    totalElement.textContent = total.toFixed(2);

    // Si el carrito está vacío, mostrar un mensaje
    if (carrito.length === 0) {
        const mensaje = document.createElement('tr');
        mensaje.innerHTML = `<td colspan="5">El carrito está vacío.</td>`;
        tbody.appendChild(mensaje);
    }

    // Convertir el total a centavos
    const totalEnCentavos = total * 100;  // Convertir a centavos (así lo requiere Stripe)

    // Asignar el valor calculado en centavos al campo oculto
    const totalCentavos = document.getElementById('totalCentavos');
    totalCentavos.value = totalEnCentavos;  // Actualizar el campo oculto con el total en centavos
}



// Función para vaciar el carrito
function vaciarCarrito() {
    localStorage.removeItem('carrito'); // Elimina el carrito del localStorage
    mostrarCarrito(); // Actualiza la vista del carrito
    alert("El carrito ha sido vaciado.");
}

// Función para eliminar un producto del carrito
function eliminarDelCarrito(index) {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    
    if (index > -1 && index < carrito.length) { // Verificar que el índice sea válido
        carrito.splice(index, 1); // Elimina el producto en la posición 'index'
        localStorage.setItem('carrito', JSON.stringify(carrito)); // Guarda el carrito actualizado
        mostrarCarrito(); // Actualiza la vista del carrito
        alert("Producto eliminado del carrito.");
    } else {
        alert("Error: Producto no encontrado.");
    }
}

// Llamar a la función para mostrar el carrito al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    mostrarCarrito(); // Muestra el carrito al cargar la página
});
