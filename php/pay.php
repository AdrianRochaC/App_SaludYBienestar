<?php
session_start();

// Verificar si el monto se pasó correctamente desde el formulario
if (isset($_POST['amount'])) {
    // Obtener el monto en centavos
    $totalAmount = $_POST['amount'];  // El monto es en centavos
} else {
    echo "No se recibió el monto correctamente.";
    exit;
}// Para confirmar que el valor se ha recibido
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="Logo/jpeg" href="../img/Logo.jpeg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Pedido</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="../css/pay.css">
    <style>
        /*=============== GOOGLE FONTS ===============*/
@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap");

/*=============== VARIABLES CSS ===============*/
:root {
  /*========== Colors ==========*/
  --first-color: #559EC4;  /* Actualizado con el color #559EC4 */
  --first-color-alt: #316f91;  /* Color alternativo de primer color */
  --title-color: hsl(220, 68%, 4%);
  --white-color: #fff;  /* Blanco para mantener el contraste */
  --header-color: #559EC4;  /* Actualizado con el color #559EC4 */
  --body-color: #D1ECFA;  /* Fondo similar a #D1ECFA */
  --container-color: #fff;  /* Blanco para el contenedor */

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

/*========== Responsive typography ==========*/
@media screen and (min-width: 1150px) {
  :root {
    --big-font-size: 3rem;
    --normal-font-size: 1rem;
    --small-font-size: .875rem;
    --tiny-font-size: .75rem;
  }
}

/*=============== BASE ===============*/
* {
  box-sizing: border-box;
  padding: 0;
  margin: 0;
}

a, ul {
    color: black;
    text-align: center;
    font-size: 18px;
    text-decoration: none;
}

body{
    background-color: #D1ECFA;
}

body,
input,
button {
  font-family: var(--body-font);
  font-size: var(--normal-font-size);
  color: var(--text-color);
}

header {
  background-color: var(--header-color);  /* Usamos el nuevo color de header */
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  color: white;
}

/* Logo */
.logo img {
  width: 150px;
}

/*=============== MAIN PAYMENT FORM STYLES ===============*/
main {
  background-color: var(--body-color);  /* Usamos el color de fondo */
  padding: 40px;
  max-width: 800px;
  margin: auto;
}

h2 {
  text-align: center;
  font-size: 2rem;
  color: var(--first-color);  /* Usamos el color principal */
  margin-bottom: 20px;
}

/* Formulario de pago */
form {
  background-color: var(--white-color);
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  width: 50%; 
  margin-top: 100px; 
  padding: 50px;
}

form label {
  display: block;
  margin: 10px 0;
  font-weight: var(--font-medium);
}

form input {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 1rem;
}

form button {
  width: 50%;
  padding: 12px;
  background-color: var(--first-color);  /* Usamos el color principal */
  color: var(--white-color);
  font-size: 1rem;
  border-radius: 5px;
  cursor: pointer;
  border: none;
  transition: background-color 0.3s;
  margin-top: 20px;
}

form button:hover {
  background-color: var(--first-color-alt);  /* Usamos el color alternativo */
}

/*=============== STRIPE STYLES ===============*/
.StripeElement {
  background-color: white;
  height: 40px;
  padding: 10px 12px;
  border-radius: 4px;
  border: 1px solid transparent;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}


/*=============== CARD ERROR STYLES ===============*/
#card-errors {
  color: #fa755a;
  font-size: 0.9rem;
}

/*=============== TOTAL AMOUNT STYLES ===============*/
#totalPrice {
  font-size: 1.25rem;
  font-weight: var(--font-semi-bold);
  color: var(--first-color);  /* Usamos el color principal */
  text-align: center;
  margin-top: 20px;
}

/*=============== RESPONSIVE DESIGN ===============*/
@media (max-width: 768px) {
  main {
    padding: 20px;
  }

  form input, form button {
    padding: 12px;
  }

  #totalPrice {
    font-size: 1rem;
  }
}

@media (max-width: 480px) {
  header .logo img {
    max-width: 120px;
  }

  form input, form button {
    padding: 10px;
  }
  
  #totalPrice {
    font-size: 0.9rem;
  }
}
    </style>
</head>
<body>
    <center>
    <form method="post" id="payment-form">
        <div class="form-row">
            <label for="card-element">
                Tarjeta de Crédito o Débito
            </label><br><br>
            
            <!-- Campo oculto para el monto, el valor lo recibe del backend -->
            <input type="hidden" name="amount" id="totalAmount" value="<?php echo $totalAmount; ?>"> <!-- El monto en centavos -->
            
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>
        
        <!-- Botón de Envío (Pagar) -->
        <button type="submit">Pagar</button>
    </form>

    </center>

    <script>
    // Crear un cliente de Stripe.
    var stripe = Stripe('pk_test_51QMEe8Guu6bOJxICmGRn3V0f057HKivZQaL8TJwRvWOVK6wnKzhxgDAWj74wbAYCoh8P5HnCdoKY06OVl5JpOzp20055FjU70G');

    // Crear una instancia de Elements.
    var elements = stripe.elements();

    // Estilo personalizado para los elementos de Stripe
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Crear una instancia del elemento de tarjeta.
    var card = elements.create('card', {style: style});

    // Insertar el elemento de la tarjeta en el div correspondiente.
    card.mount('#card-element');

    // Manejar los errores en tiempo real desde el elemento de tarjeta.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Manejar la presentación del formulario.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Informar al usuario si hubo un error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Enviar el token a tu servidor.
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        // Insertar el token en el formulario para enviarlo al servidor
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Una vez que el token se ha enviado, redirigir a la página de éxito
        form.submit();  // Enviar el formulario al servidor
        window.location.href = 'pay-success.php';  // Redirigir a la página de éxito
    }

    </script>

</body>
</html>
