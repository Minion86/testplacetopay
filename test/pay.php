<?php
require_once __DIR__ . '/bootstrap.php';
session_start();
//$placetopay = new Dnetix\Redirection\PlacetoPay([
//    'login' => '6dd490faf9cb87a9862245da41170ff2',
//    'tranKey' => '024h1IlD',
//    'url' => 'https://test.placetopay.com/redirection/api/session/',
//    'rest' => [
//        'timeout' => 45, // (optional) 15 by default
//        'connect_timeout' => 30, // (optional) 5 by default
//    ]
//]);

if (!empty($_SESSION["cart_item"])) {

    $reference = 'TEST_' . time();
    $items = array();
    $total = 0;
    foreach ($_SESSION["cart_item"] as $k => $v) {
        $total += $_SESSION["cart_item"][$k]["cantidad"] * $_SESSION["cart_item"][$k]["precio"];

        $temp = array(
            'sku' => $_SESSION["cart_item"][$k]['codigo'],
            'name' => $_SESSION["cart_item"][$k]['nombre'],
            'category' => '',
            'qty' => $_SESSION["cart_item"][$k]['cantidad'],
            'price' => $_SESSION["cart_item"][$k]['precio'],
            'tax' => 0
        );

        array_push($items, $temp);
    }

// Request Information
    $request = [
        'locale' => 'es_CO',
//    'payer' => [
//        'name' => 'Kellie Gerhold',
//        'surname' => 'Yost',
//        'email' => 'flowe@anderson.com',
//        'documentType' => 'CC',
//        'document' => '1848839248',
//        'mobile' => '3006108300',
//        'address' => [
//            'street' => '703 Dicki Island Apt. 609',
//            'city' => 'North Randallstad',
//            'state' => 'Antioquia',
//            'postalCode' => '46292',
//            'country' => 'US',
//            'phone' => '363-547-1441 x383',
//        ],
//    ],
//    'buyer' => [
//        'name' => 'Kellie Gerhold',
//        'surname' => 'Yost',
//        'email' => 'flowe@anderson.com',
//        'documentType' => 'CC',
//        'document' => '1848839248',
//        'mobile' => '3006108300',
//        'address' => [
//            'street' => '703 Dicki Island Apt. 609',
//            'city' => 'North Randallstad',
//            'state' => 'Antioquia',
//            'postalCode' => '46292',
//            'country' => 'US',
//            'phone' => '363-547-1441 x383',
//        ],
//    ],
        'payment' => [
            'reference' => $reference,
            'description' => 'Compra',
            'amount' => [
//            'taxes' => [
//                [
//                    'kind' => 'ice',
//                    'amount' => 56.4,
//                    'base' => 470,
//                ],
//                [
//                    'kind' => 'valueAddedTax',
//                    'amount' => 89.3,
//                    'base' => 470,
//                ],
//            ],
//            'details' => [
//                [
//                    'kind' => 'shipping',
//                    'amount' => 47,
//                ],
//                [
//                    'kind' => 'tip',
//                    'amount' => 47,
//                ],
//                [
//                    'kind' => 'subtotal',
//                    'amount' => 940,
//                ],
//            ],
                'currency' => 'USD',
                'total' => $total,
            ],
            'items' => json_encode($items),
//        'shipping' => [
//            'name' => 'Kellie Gerhold',
//            'surname' => 'Yost',
//            'email' => 'flowe@anderson.com',
//            'documentType' => 'CC',
//            'document' => '1848839248',
//            'mobile' => '3006108300',
//            'address' => [
//                'street' => '703 Dicki Island Apt. 609',
//                'city' => 'North Randallstad',
//                'state' => 'Antioquia',
//                'postalCode' => '46292',
//                'country' => 'US',
//                'phone' => '363-547-1441 x383',
//            ],
//        ],
            'allowPartial' => false,
        ],
        'expiration' => date('c', strtotime('+1 hour')),
        'ipAddress' => '127.0.0.1',
        'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36',
        'returnUrl' => 'http://localhost/test/success.php',
        'cancelUrl' => 'http://localhost/test/',
        'skipResult' => false,
        'noBuyerFill' => false,
        'captureAddress' => false,
        'paymentMethod' => null,
    ];

    try {
        $placetopay = placetopay();
        $response = $placetopay->request($request);

        if ($response->isSuccessful()) {

            header("Location: " . $response->processUrl());
            die();
        } else {
            // There was some error so check the message
            $response->status()->message();
        }
        var_dump($response);
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
} else {
    ?>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <div class="no-records">El carrito está vacío</div>
    <?php
}
?>
