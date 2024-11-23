<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="icon" type="image/png" href="../img/Logo.png">
    <link rel="stylesheet" href="../css/perfil.css">
    <style>
        /* Estilos generales */
body {
    font-family: Arial, sans-serif;
    background-color: #F3F8FB; /* Tono más suave */
    color: #333;
    margin: 0;
    padding: 0;
}

/* Header */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #559EC4;
    padding: 15px 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

header .logo img {
    height: 150px; /* Aumentar el tamaño de la imagen del logo */
    width: auto;
}

nav {
    display: flex;
    align-items: center;
}

nav .search input {
    padding: 8px 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-right: 10px;
    width: 200px;
}

nav .search button {
    border-radius: 5px;
    cursor: pointer;
    padding: 8px;
}

nav a {
    margin-left: 15px;
    font-size: 20px;
    color: black;
    text-decoration: none;
}

/* Contenido principal */
main {
    padding: 40px 20px;
}

#contenido {
    background-color: #ffffff; /* Fondo blanco para una apariencia limpia */
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.perfil-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px; /* Ajuste para que los elementos tengan espacio entre ellos */
    width: 100%;
    text-align: left; /* Para que el texto del perfil esté alineado a la izquierda */
}

.info-perfil {
    max-width: 600px; /* Aumentamos el ancho máximo */
    font-size: 1.2rem;
    line-height: 1.6;
}

.info-perfil h2,
.info-perfil h3 {
    margin: 10px 0;
    color: #333;
    font-size: 1.4rem;
}

.info-perfil p {
    margin: 5px 0;
    color: #666;
}

.imagen-perfil img {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Redes sociales */
/* Redes sociales */
#redesSociales {
    background-color: #559EC4;
    padding: 15px 0;
    display: flex;
    justify-content: center;
    gap: 30px;
    border-top: 2px solid #fff;
}

#redesSociales a {
    font-size: 40px;
    color: black;  /* Color negro para los íconos */
    transition: transform 0.3s ease, color 0.3s ease; /* Agregar transición para el cambio de color */
}

#redesSociales a:hover {
    transform: scale(1.2);
    color: #559EC4; /* Cambiar a azul claro al pasar el cursor */
}

i.bi-facebook:hover {
    color: #3b5998; /* Color de Facebook al pasar el cursor */
}

i.bi-instagram:hover {
    color: #E1306C; /* Color de Instagram al pasar el cursor */
}

i.bi-whatsapp:hover {
    color: #25D366; /* Color de WhatsApp al pasar el cursor */
}


/* Estilos responsivos */
@media screen and (max-width: 768px) {
    header {
        flex-direction: column;
        align-items: flex-start;
    }

    nav .search input {
        width: 180px;
    }

    .perfil-container {
        flex-direction: column;
        text-align: center;
    }

    .imagen-perfil img {
        width: 150px;
        height: 150px;
    }

    .info-perfil h2, .info-perfil h3 {
        font-size: 1.2rem;
    }

    #redesSociales {
        flex-direction: column;
        gap: 20px;
    }
}

@media screen and (max-width: 480px) {
    nav .search input {
        width: 150px;
    }

    .perfil-container {
        padding: 10px;
    }

    .imagen-perfil img {
        width: 120px;
        height: 120px;
    }

    .info-perfil h2, .info-perfil h3 {
        font-size: 1rem;
    }
}

    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="sesion_admin.php"><img src="../img/Logo.png" alt="Droguería Salud y Bienestar"></a>
        </div>
        <nav>
            <form class="search">
                <a href="cerrar_sesion.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                </svg></a>
            </form>
        </nav>
    </header>

    <main>
        <section id="contenido">
            <div class="perfil-container">
                <div class="info-perfil">
                    <h2>Nombre: Oscar</h2>
                    <h3>Apellido: Romero</h3>
                    <p>Correo: oscar.romero@example.com</p>
                    <p>Dirección: Calle Falsa 123, Ciudad</p>
                    <p>Teléfono: +34 600 123 456</p>
                    <p>Cargo: Gerente Drogueria</p>
                </div>
                <div class="imagen-perfil">
                    <img src="../img/perfil.png" alt="Imagen de Perfil">
                </div>
            </div>
        </section>
    </main>
    <center>
        <section id="redesSociales">
            <a href="https://es-la.facebook.com/login/" target="blank"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/?hl=es" target="blank"><i class="bi bi-instagram"></i></a>
            <a href="https://web.whatsapp.com/" target="blank"><i class="bi bi-whatsapp"></i></a>
        </section>
    </center>
</body>
</html>
