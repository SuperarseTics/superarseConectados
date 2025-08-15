<?php if (isset($data['result'])): ?>
    <?php
        $payphone_id = $data['result']->transactionId ?? 'N/A';
        $client_transaction_id = $data['result']->clientTransactionId ?? 'N/A';
        $amount = $data['result']->amount ?? 0;
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        </head>
    <body>
        <div class="success-container">
            <h1>¡Pago Realizado con Éxito! ✅</h1>
            <p>Gracias por tu compra. La transacción se ha procesado correctamente.</p>
            <p><strong>Detalles de la Transacción:</strong></p>
            <p>ID de Transacción: <strong><?= htmlspecialchars($payphone_id) ?></strong></p>
            <p>ID de tu Transacción: <strong><?= htmlspecialchars($client_transaction_id) ?></strong></p>
            <p>Monto: <strong>$<?= number_format($amount / 100, 2) ?></strong></p>
            <p><a href="/public/informacion">Volver a mi perfil</a></p>
        </div>
    </body>
    </html>
<?php else: ?>
    <h1>Error en el Proceso de Pago</h1>
    <p>No se pudo obtener la información de la transacción.</p>
<?php endif; ?>