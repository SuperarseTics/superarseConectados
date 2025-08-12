<?php
// Generar un ID único para la transacción usando la hora actual con milisegundos
list($usec, $sec) = explode(" ", microtime());
$milisegundos = round($usec * 1000);

$tiempo_actual = date("H_i_s", $sec) . '_' . sprintf('%03d', $milisegundos);

$clientTransactionId = "Superarse_" . $tiempo_actual;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <script src="https://cdn.payphonetodoesposible.com/box/v1.1/payphone-payment-box.js" type="module"></script>
    <link href="https://cdn.payphonetodoesposible.com/box/v1.1/payphone-payment-box.css" rel="stylesheet">
</head>

<body>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            ppb = new PPaymentButtonBox({
                token: 'SvktbKo68OUxwwe1bP_6I1Z1ivIVX_en7mcuj17S0J_OzGB_6V0jrJWSBBbi3yJx5IfbRegfc0QLBxND2IslkrZrSlKN5B2dHwnRkVHbw1B6M_Pde9_bAHAyNb-pg-7JhbXqEMyl60wRgsoGmLSRR2hfCrD_JeQyYz8ypY_Igi0N5_1AuRfuBQRFe3ePQP-fpcYskWyahpz-2Tb3ldkfqdPlE0oJesIbWMFcEdTRI22D-uA-HpRvTOUeTpIDitoeHx83WdcXY682TKhR31DTcjQwsgxJ3T9SOqoStbQ0q6uj8_rI5z_Z7PXJ2gIb6oDF1tGIEV_Xk5mWMkA8VZYuwNqqzgg',
                clientTransactionId: '<?= htmlspecialchars($clientTransactionId) ?>',
                amount: 315,
                amountWithoutTax: 200,
                amountWithTax: 100,
                tax: 15,
                currency: "USD",
                storeId: "d3fcb722-dfe9-4e7c-8b33-cf8fbd309006",
                reference: "Pago por cuota de Superarse",
            }).render('pp-button');
        })
    </script>
    <div id="pp-button"></div>
</body>

</html>