<?php
    require 'paypal/autoload.php';

define('URL_SITIO','http://pagina_web_1.xd/');     

// Instalacion de la API de Paypal
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AYrhg19S3Zickyz1DyUsBVK_3-BDb_vcUrADs3LhX8iJuOG8vIpJH06pXIWaEad6R4MxHCxF1iSuMH_M', //Cliente ID
        'ENWbXDqiVixVXZwD3dsjV_c6eOqQ8KLTnVFtGkllwxT2WPB3_B8Je77K8WS8WfZ0-7nH2AbphA3kpkp7' //Secret
    )
);