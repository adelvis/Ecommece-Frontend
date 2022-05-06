<?php


require_once __DIR__ . '/vendor/autoload.php';




use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;



$table = "commerce";

$answer = ModelCart::mdlViewTarifa($table);


$modoPaypal = $answer["modoPaypal"];

$clientIdPaypal = $answer["clientIdPaypal"];

$keySecretPaypal = $answer["keySecretPaypal"];


$apiContext = new ApiContext(
        new OAuthTokenCredential(
            $clientIdPaypal,
            $keySecretPaypal
        )
);



$apiContext->setConfig(
    array(
        'mode' => $modoPaypal,
        'log.LogEnabled' => true,
        'log.FileName' => '../PayPal.log',
        'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
        'http.CURLOPT_CONNECTTIMEOUT' => 30
        
    )
);

