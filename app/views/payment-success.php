<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso</title>
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 50px; }
        .success-container { background-color: #e6ffe6; border: 1px solid #00b300; padding: 20px; border-radius: 5px; max-width: 600px; margin: auto; }
        h1 { color: #00b300; }
        pre { background-color: #f0f0f0; padding: 10px; border-radius: 5px; text-align: left; overflow-x: auto; }
    </style>
</head>
<body>

    <div class="success-container">
        <h1>¡Pago Realizado con Éxito!</h1>
        <p>Gracias por tu compra. La transacción se ha procesado correctamente.</p>
        
        <?php if (isset($data['result'])): ?>
            <p><strong>Detalles de la Transacción:</strong></p>
            <p>ID de Transacción: <strong><?= htmlspecialchars($data['result']->transactionId ?? 'N/A') ?></strong></p>
            <p>Monto: <strong>$<?= number_format(($data['result']->amount ?? 0) / 100, 2) ?></strong></p>
            
            <p>Para fines de depuración, aquí está la respuesta completa de PayPhone:</p>
            <pre><?= htmlspecialchars(json_encode($data['result'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) ?></pre>
        <?php else: ?>
            <p>No se encontraron detalles de la transacción.</p>
        <?php endif; ?>
        
        <p><a href="/public/informacion">Volver a mi perfil</a></p>
    </div>

</body>
</html>