<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Proceso de Pago</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/src/js/script.js"></script>
    <style>
    .checkout-form {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f9f9f9;
    }

    .checkout-form input,
    .checkout-form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .checkout-form button {
        width: 100%;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    .hidden {
        display: none;
    }
    </style>
    <script>
    function togglePaymentOptions() {
        const metodoPago = document.getElementById('metodo_pago').value;
        const tarjetaOptions = document.getElementById('tipo_tarjeta');
        const paypalOptions = document.getElementById('tipo_paypal');

        tarjetaOptions.classList.add('hidden');
        paypalOptions.classList.add('hidden');

        if (metodoPago === 'tarjeta') {
            tarjetaOptions.classList.remove('hidden');
        } else if (metodoPago === 'paypal') {
            paypalOptions.classList.remove('hidden');
        }
    }
    </script>
</head>



<body>
    <div class="checkout-form p-4">
        <h1>Formulario de Pago</h1>

        <form id="formularioPago" method="post" action="/Controllers/orden_control.php">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required>

            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" required>

            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" required>

            <label for="direccion">Dirección de Entrega</label>
            <input type="text" name="direccion" required>

            <label for="metodo_pago">Método de Pago</label>
            <select name="metodo_pago" id="metodo_pago" onchange="togglePaymentOptions()" required>
                <option value="">Seleccionar</option>
                <option value="paypal">PayPal</option>
                <option value="tarjeta">Tarjeta de Crédito</option>
            </select>

            <div id="tipo_tarjeta" class="hidden">
                <label for="tipo_tarjeta">Tipo de Tarjeta</label>
                <select name="tipo_tarjeta" required>
                    <option value="visa">Visa</option>
                    <option value="mastercard">MasterCard</option>
                    <option value="AmericanExpress">AmericanExpress</option>
                    <option value="otros">Otros</option>
                </select>
            </div>

            <div id="tipo_paypal" class="hidden">
                <label for="tipo_paypal">Tipo de PayPal</label>
                <select name="tipo_paypal" required>
                    <option value="paypal_america">PayPal América</option>
                    <option value="paypal_usa">PayPal USA</option>
                </select>
            </div>

            <label for="numero_cuenta">Número de Cuenta</label>
            <input type="text" name="numero_cuenta" required>

            <label for="metodo_entrega">Método de Entrega</label>
            <select name="metodo_entrega" required>
                <option value="domicilio">Domicilio</option>
                <option value="recoger">Recoger en tienda</option>
            </select>

            <label for="fecha_entrega">Fecha de Entrega</label>
            <input type="date" name="fecha_entrega" required>

            <label for="hora_entrega">Hora de Entrega</label>
            <input type="time" name="hora_entrega" required>

            <label for="tipo_envio">Tipo de Envío</label>
            <select name="tipo_envio" required>
                <option value="normal">Normal</option>
                <option value="express">Express</option>
            </select>

            <button type="submit" onclick="ConfirmarPago()">Confirmar Pago</button>
        </form>
    </div>

    <?php include '../src/components/modal_confirmar.php';
    
    ?>


</body>

</html>