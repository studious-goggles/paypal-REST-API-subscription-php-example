<?php
session_start();

$composerAutoload = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($composerAutoload)) {
    //If the project is used as its own project, it would use rest-api-sdk-php composer autoloader.
    $composerAutoload = __DIR__ . '/vendor/autoload.php';
    if (!file_exists($composerAutoload)) {
        echo "The 'vendor' folder is missing. You must run 'composer update' to resolve application dependencies.\nPlease see the README for more information.\n";
        exit(1);
    }
}
require $composerAutoload;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Exception\PayPalConnectionException;

// Suppress DateTime warnings, if not set already
date_default_timezone_set(@date_default_timezone_get());
// Adding Error Reporting for understanding errors properly
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Add your client ID and secret from https://developer.paypal.com/developer/applications/
// SANDBOX
$clientId = 'ABC12346';
$clientSecret = 'ABC123';
/* LIVE
$clientId = 'ABC12346';
$clientSecret = 'ABC123';
*/

$apiContext = getApiContext($clientId, $clientSecret);
return $apiContext;

function getApiContext($clientId, $clientSecret) {

    $apiContext = new ApiContext(
        new OAuthTokenCredential(
            $clientId,
            $clientSecret
        )
    );

    $apiContext->setConfig(
        array(
            'mode' => 'sandbox', // use 'live' in live environment
            'log.LogEnabled' => true,
            'log.FileName' => 'PayPal.log',
            'log.LogLevel' => 'DEBUG', // use 'info' level in live environment
            'cache.enabled' => true
        )
    );

    return $apiContext;

}

// function to get base url to create cancel and return urls
function getBaseUrl() {
    if (PHP_SAPI == 'cli') {
        $trace=debug_backtrace();
        $relativePath = substr(dirname($trace[0]['file']), strlen(dirname(dirname(__FILE__))));
        echo "Warning: This sample may require a server to handle return URL. Cannot execute in command line. Defaulting URL to http://localhost$relativePath \n";
        return "http://localhost" . $relativePath;
    }
    $protocol = 'http';
    if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on')) {
        $protocol .= 's';
    }
    $host = $_SERVER['HTTP_HOST'];
    $request = $_SERVER['PHP_SELF'];
    return dirname($protocol . '://' . $host . $request);
}



?>
