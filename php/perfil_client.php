<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="icon" type="Logo/png" href="../img/Logo.png">
    <link rel="stylesheet" href="../css/perfil_client.css">
    <style>
        /*=============== GOOGLE FONTS ===============*/
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap");

        /*=============== VARIABLES CSS ===============*/
        :root {
            /*========== Colors ==========*/
            --first-color: #559EC4;
            /* Color principal */
            --first-color-alt: #316f91;
            /* Color alternativo */
            --title-color: hsl(220, 68%, 4%);
            --white-color: #ffffff;
            /* Blanco */
            --header-color: #559EC4;
            /* Color del header */
            --body-color: #D1ECFA;
            /* Color del cuerpo */
            --container-color: hsl(220, 50%, 97%);

            /*========== Font and typography ==========*/
            --body-font: "Montserrat", system-ui;
            --big-font-size: 1.5rem;
            --normal-font-size: .938rem;
            --small-font-size: .813rem;
            --tiny-font-size: .688rem;

            /*========== Font weight ==========*/
            --font-regular: 400;
            --font-medium: 500;
            --font-semi-bold: 600;

            /*========== z index ==========*/
            --z-tooltip: 10;
            --z-fixed: 100;
        }

        /*=============== BASE ===============*/
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body,
        input,
        button {
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            color: var(--title-color);
        }

        header {
            background-color: var(--header-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
        }

        /* Logo */
        .logo img {
            height: 60px;
            width: auto;
        }

        /* Estilos para la imagen de perfil */
        .perfil-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }

        /* Formulario */
        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            max-width: 500px;
            margin: 0 auto;
            background-color: var(--white-color);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Contenedor del formulario con la foto */
        .form-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            width: 100%;
        }

        /* Cambiar tamaño de los inputs */
        form input {
            width: 250px;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        /* Botón de enviar */
        form button {
            width: 100%;
            padding: 10px;
            background-color: var(--first-color);
            color: var(--white-color);
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: var(--first-color-alt);
        }

        /* Título */
        h2 {
            font-size: 24px;
            text-align: center;
            color: var(--first-color);
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <a href="sesion_index.php"><img src="../img/Logo.png" alt=""></a>
        </div>
        <nav>
            <a href="cerrar_sesion.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                </svg>
            </a>
        </nav>
    </header>

    <main>
        <h2>Perfil</h2>

        <form action="actualizar_perfil.php" method="POST">
            <div class="form-container">
                <!-- Foto de perfil -->
                <img src="../img/perfil.png" alt="Foto de perfil" class="perfil-img">

                <div>
                    <label for="nombre_completo">Nombre Completo:</label>
                    <input type="text" id="nombre_completo" name="nombre_completo" value="<?php echo isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo'] : ''; ?>" required>
                    <br>

                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" id="correo" name="correo" value="<?php echo isset($_SESSION['correo']) ? $_SESSION['correo'] : ''; ?>" required>
                    <br>

                    <label for="telefono">Número de Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" value="<?php echo isset($_SESSION['telefono']) ? $_SESSION['telefono'] : ''; ?>" required>
                    <br>

                    <label for="pais">País o Ciudad:</label>
                    <input type="text" id="pais" name="pais" value="<?php echo isset($_SESSION['pais']) ? $_SESSION['pais'] : ''; ?>" required>
                    <br>

                    <button type="submit">Actualizar Perfil</button>
                </div>
            </div>
        </form>
    </main>

</body>

</html>