<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error en el Pago</title>
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 50px; }
        .error-container { background-color: #ffe6e6; border: 1px solid #e60000; padding: 20px; border-radius: 5px; max-width: 600px; margin: auto; }
        h1 { color: #e60000; }
        pre { background-color: #f0f0f0; padding: 10px; border-radius: 5px; text-align: left; overflow-x: auto; }
    </style>
</head>
<body>

    <div class="error-container">
        <h1>¡Ha Ocurrido un Error!</h1>
        <p>No pudimos procesar tu pago. Por favor, intenta de nuevo o contacta a soporte.</p>
        
        <?php if (isset($data['result'])): ?>
            <p><strong>Detalles del Error:</strong></p>
            <p>Estado de la Transacción: <strong><?= htmlspecialchars($data['result']->transactionStatus ?? 'N/A') ?></strong></p>
            <p>Código de Error: <strong><?= htmlspecialchars($data['result']->transactionCode ?? 'N/A') ?></strong></p>
            <p>Mensaje: <strong><?= htmlspecialchars($data['result']->message ?? 'N/A') ?></strong></p>

            <p>Para fines de depuración, aquí está la respuesta completa de PayPhone:</p>
            <pre><?= htmlspecialchars(json_encode($data['result'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) ?></pre>
        <?php else: ?>
            <p>No se encontraron detalles del error.</p>
        <?php endif; ?>

        <p><a href="/public/informacion">Volver a mi perfil</a></p>
    </div>

</body>
</html>