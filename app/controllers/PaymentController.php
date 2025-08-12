<?php

require_once __DIR__ . '/../models/Database.php'; // Si necesitas interactuar con la DB
// También podrías necesitar un modelo específico para transacciones o pagos
// require_once __DIR__ . '/../models/Transaction.php'; 

class PaymentController
{
    public function handlePayphoneCallback()
    {
        // Obtener parametros enviados por payphone de la URL de respuesta
        $id = isset($_GET["id"]) ? $_GET["id"] : 0;
        $clientTxId = isset($_GET["clientTransactionId"]) ? $_GET["clientTransactionId"] : "";

        // Validar que los parámetros existen y son válidos
        if (empty($id) || empty($clientTxId)) {
            // Manejar error: redirigir o mostrar un mensaje de error
            // Quizás a una página de error o loggear el problema
            header("Location: /public/payment-error?code=missing_params");
            exit();
        }

        // Preparar cabecera para la solicitud
        $headers[] = 'Authorization: Bearer SvktbKo68OUxwwe1bP_6I1Z1ivIVX_en7mcuj17S0J_OzGB_6V0jrJWSBBbi3yJx5IfbRegfc0QLBxND2IslkrZrSlKN5B2dHwnRkVHbw1B6M_Pde9_bAHAyNb-pg-7JhbXqEMyl60wRgsoGmLSRR2hfCrD_JeQyYz8ypY_Igi0N5_1AuRfuBQRFe3ePQP-fpcYskWyahpz-2Tb3ldkfqdPlE0oJesIbWMFcEdTRI22D-uA-HpRvTOUeTpIDitoeHx83WdcXY682TKhR31DTcjQwsgxJ3T9SOqoStbQ0q6uj8_rI5z_Z7PXJ2gIb6oDF1tGIEV_Xk5mWMkA8VZYuwNqqzgg'; // ¡REEMPLAZA ESTO!
        $headers[] = 'Content-Type: application/json';

        // Preparar objeto JSON para solicitud
        $data = array(
            "id" => (int)$id,
            "clientTxId" => $clientTxId
        );
        $objetoJSON = json_encode($data);

        // Iniciar solicitud curl: POST
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://pay.payphonetodoesposible.com/api/button/V2/Confirm");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $objetoJSON);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $curl_response = curl_exec($curl);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE); // Obtener el código de estado HTTP

        curl_close($curl);

        $result = json_decode($curl_response);

        // --- Lógica de Negocio: Procesar la respuesta de PayPhone ---
        // Aquí es donde deberías:
        // 1. Verificar si la confirmación fue exitosa según la respuesta de $result.
        // 2. Actualizar el estado de la transacción en tu base de datos (usando el modelo de Transacción).
        // 3. Manejar errores si la confirmación falla.
        
        // Ejemplo simplificado de cómo pasar datos a una vista o redirigir
        if ($http_status === 200 && isset($result->transactionStatus) && $result->transactionStatus === 'Approved') {
            // Transacción aprobada
            // Guardar en DB si es necesario
            require_once __DIR__ . '/../helpers/View.php';
            View::render(__DIR__ . '/../views/payment_success.php', ['result' => $result]);
        } else {
            // Transacción fallida o error en la confirmación
            // Loggear el error, mostrar un mensaje al usuario
            require_once __DIR__ . '/../helpers/View.php';
            View::render(__DIR__ . '/../views/payment_failure.php', ['result' => $result]);
        }
    }
}