<?php
// handle_payment.php

// Asegúrate de incluir tu helper de vistas si lo tienes
require_once 'View.php';

// 1. Obtener los parámetros de la URL enviados por PayPhone
$transactionId = $_GET['id'] ?? null;
$clientTransactionId = $_GET['clientTransactionId'] ?? null;

// 2. Si no hay IDs, no podemos verificar nada. Cargar la vista de fracaso
if (!$transactionId) {
    View::render('payment-failure.php', [
        'message' => 'Parámetros de transacción faltantes.'
    ]);
    exit();
}

// 3. Realizar una llamada a la API de PayPhone para confirmar la transacción
// (¡Este paso es vital por seguridad!)
$api_url = "https://pay.payphonetodoesposible.com/api/v1/transaction/transaction/byid/" . urlencode($transactionId);
$headers = [
    'Authorization: Bearer TU_TOKEN_DE_ACCESO', // Reemplaza con tu token real
    'Content-Type: application/json'
];

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$transaction_data = json_decode($response);

// 4. Decidir qué vista mostrar según la respuesta de la API
if ($http_code === 200 && isset($transaction_data->transactionStatus) && $transaction_data->transactionStatus === 'Approved') {
    // Si la API confirma que la transacción fue exitosa
    View::render(__DIR__ . '/payment-success.php', [
        'id' => $transaction_data->transactionId,
        'clientTransactionId' => $transaction_data->clientTransactionId,
        'amount' => $transaction_data->amount
        // ...puedes pasar más datos si los necesitas
    ]);
} else {
    // Si la API devuelve un error o el estado no es 'Approved'
    $error_message = $transaction_data->message ?? 'Error desconocido en la transacción.';
    View::render(__DIR__ . '/payment-failure.php', [
        'message' => $error_message
    ]);
}