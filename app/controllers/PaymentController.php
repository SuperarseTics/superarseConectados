<?php

require_once __DIR__ . '/../models/Database.php'; 
require_once __DIR__ . '/../helpers/View.php';

class PaymentController
{
    public function handlePayphoneCallback()
    {
        // Obtener parámetros enviados por PayPhone de la URL de respuesta
        $id = isset($_GET["id"]) ? $_GET["id"] : null;
        $clientTxId = isset($_GET["clientTransactionId"]) ? $_GET["clientTransactionId"] : null;

        // Validar que los parámetros existen y son válidos
        if (empty($id) || empty($clientTxId)) {
            // Manejar error: redirigir a una página de error o mostrar un mensaje
            View::render(__DIR__ . '/../views/payment_failure.php', [
                'data' => [
                    'result' => (object)['message' => 'Parámetros de transacción faltantes.']
                ]
            ]);
            exit();
        }

        // Preparar la solicitud de confirmación a PayPhone
        $headers = [
            'Authorization: Bearer SvktbKo68OUxwwe1bP_6I1Z1ivIVX_en7mcuj17S0J_OzGB_6V0jrJWSBBbi3yJx5IfbRegfc0QLBxND2IslkrZrSlKN5B2dHwnRkVHbw1B6M_Pde9_bAHAyNb-pg-7JhbXqEMyl60wRgsoGmLSRR2hfCrD_JeQyYz8ypY_Igi0N5_1AuRfuBQRFe3ePQP-fpcYskWyahpz-2Tb3ldkfqdPlE0oJesIbWMFcEdTRI22D-uA-HpRvTOUeTpIDitoeHx83WdcXY682TKhR31DTcjQwsgxJ3T9SOqoStbQ0q6uj8_rI5z_Z7PXJ2gIb6oDF1tGIEV_Xk5mWMkA8VZYuwNqqzgg', // ¡Usa tu token real!
            'Content-Type: application/json'
        ];
        
        $data_to_send = array(
            "id" => (int)$id,
            "clientTxId" => $clientTxId
        );
        $json_data = json_encode($data_to_send);

        // Iniciar solicitud cURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://pay.payphonetodoesposible.com/api/button/V2/Confirm");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $curl_response = curl_exec($curl);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        $result = json_decode($curl_response);
        
        // La vista de éxito espera un objeto
        $data_for_view = ['data' => ['result' => $result]];

        // --- Lógica de Negocio: Procesar la respuesta de PayPhone ---
        // Evaluar el resultado para decidir qué vista mostrar
        if ($http_status === 200 && isset($result->transactionStatus) && $result->transactionStatus === 'Approved') {
            // Transacción aprobada.
            // Aquí puedes agregar lógica para actualizar tu base de datos si lo necesitas.
            View::render(__DIR__ . 'payment_success.php', $data_for_view);
        } else {
            // Transacción fallida o error en la confirmación.
            // PayPhone devolverá un objeto con el mensaje de error.
            $error_message = $transaction_data->message ?? 'Error desconocido en la transacción.';
            View::render(__DIR__ . 'payment_failure.php', $data_for_view);
        }
    }
}