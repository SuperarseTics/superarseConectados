<?php
    $payphone_id = $data['result']->transactionId ?? 'N/A';
    $client_transaction_id = $data['result']->clientTransactionId ?? 'N/A';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    </head>
<body>
    <div class="error-container">
        <h1>¡Ha Ocurrido un Error! 😞</h1>
        <p>No pudimos procesar tu pago. Por favor, intenta de nuevo o contacta a soporte.</p>
        <p>ID de Transacción: <strong><?= htmlspecialchars($payphone_id) ?></strong></p>
        <p>ID de tu Transacción: <strong><?= htmlspecialchars($client_transaction_id) ?></strong></p>
        <p><a href="/public/informacion">Volver a mi perfil</a></p>
    </div>
</body>
</html>