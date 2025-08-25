<?php

require_once __DIR__ . '/../helpers/View.php';

class PaymentController {

    public function showPaymentPage() {
        // Pasa las variables de la URL a la vista
        $data = [
            'cantidad' => $_GET['cantidad'] ?? 0.0,
            'referencia' => $_GET['referencia'] ?? "Pago de Superarse",
            'status' => $_GET['status'] ?? null
        ];

        View::render(__DIR__ . '/../views/pagos.php', $data);
    }
}