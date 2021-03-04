<?php

/**
 * The only purpose for this file its bootstrap the classes and generate a single point
 * to instanciate the PlacetoPay class.
 */
require_once __DIR__ . '/vendor/autoload.php';

use Dnetix\Redirection\PlacetoPay;

/**
 * Instanciates the PlacetoPay object providing the login and tranKey, also the url that will be
 * used for the service.
 * @return PlacetoPay
 */
function placetopay() {

    return new PlacetoPay([
        'login' => '6dd490faf9cb87a9862245da41170ff2',
        'tranKey' => '024h1IlD',
       // 'url' => 'https://test.placetopay.com/redirection/api/session/',
        'url' => 'https://dev.placetopay.com/redirection/',
        'type' => getenv('P2P_TYPE') ?: PlacetoPay::TP_REST,
    ]);
}
