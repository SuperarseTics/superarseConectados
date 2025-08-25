<?php
// Generar un ID único para la transacción usando la hora actual con milisegundos
list($usec, $sec) = explode(" ", microtime());
$milisegundos = round($usec * 1000);

$tiempo_actual = date("H_i_s", $sec) . '_' . sprintf('%03d', $milisegundos);

$clientTransactionId = "Superarse_" . $tiempo_actual;

$cantidad = isset($cantidad) ? floatval($cantidad) : 0.0;
$amount = max(0, $cantidad);
$amountWithoutTax = $amount;
$tax = 0.0;
$referencia = isset($referencia) ? htmlspecialchars($referencia) : "Pago de Superarse";
$status = isset($status) ? $status : null;

// --- LÓGICA PARA MOSTRAR CONTENIDO SEGÚN EL ESTADO DE LA TRANSACCIÓN ---
if ($status === 'success') {
    // Si el estado es 'success', mostramos la página de éxito
    $payphone_id = $_GET['id'] ?? 'N/A';
    $client_transaction_id = $_GET['clientTransactionId'] ?? 'N/A';

    echo "<h1>¡Pago Exitoso! ✅</h1>";
    echo "<p>ID de Transacción de PayPhone: " . htmlspecialchars($payphone_id) . "</p>";
    echo "<p>ID de tu Transacción: " . htmlspecialchars($client_transaction_id) . "</p>";
    exit();
} elseif ($status === 'failure') {
    // Si el estado es 'failure', mostramos la página de fracaso
    echo "<h1>¡El pago ha fallado! 😞</h1>";
    echo "<p>Por favor, inténtalo de nuevo.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasarela de pagos - Superarse</title>
    <link rel="icon" type="image/png" href="/superarseconectados/assets/logos/logoSuperarse.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.payphonetodoesposible.com/box/v1.1/payphone-payment-box.js" type="module"></script>
    <link href="https://cdn.payphonetodoesposible.com/box/v1.1/payphone-payment-box.css" rel="stylesheet">

    <link rel="stylesheet" href="/superarseconectados/css/style.css">
</head>

<body>
    <header class="text-white text-center py-3 shadow-sm">
        <div class="container">
            <p class="lead mb-0">Plataforma de Pagos - Superarse</p>
        </div>
    </header>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const ppb = new PPaymentButtonBox({
                token: '8W-4m1qWExjBDCoReWHZUSh4B1tNHuK8EGOviJbt4gI6j4pZ_HOxNVRYjevU9CJ-huw21fTmZz0qDOiA_NmzaA0bsVbcYWArG3SkIR3FLnC3qqE_REmuiKy9DefawP-No8nZ-EguZiWBSQHR7CDLiBNgacy7u45Ht2XsO1THDbo6lJS2VnpfmfS1VdCCALbTY7Z8iFFpXJp6IFGFC8NawUZIcVlrMAKSjHc1NF_e1wxgvZ4K8Jg1LKX6MSzsRJ9yloDEB1rWBroX2Lsze61au-D1L_e0-fV6XTwiUKi6vJRoEmNs7soTqEYrBjb6FM9hbmEEpxAzinOjkodgMQWkdT8lSuw',
                clientTransactionId: '<?= htmlspecialchars($clientTransactionId) ?>',
                amount: <?= $amount ?>,
                amountWithoutTax: <?= $amountWithoutTax ?>,
                tax: <?= $tax ?>,
                currency: "USD",
                storeId: "d3fcb722-dfe9-4e7c-8b33-cf8fbd309006",
                reference: '<?= htmlspecialchars($referencia) ?>',

                // Redirección para éxito
                successUrl: '/superarseconectados/app/controllers/handle_payment.php',
                failureUrl: '/superarseconectados/app/controllers/handle_payment.php'
            }).render('pp-button');
        });
    </script>

    <div class="container-fluid" id="pp-button"></div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2025 Instituto Superarse. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>