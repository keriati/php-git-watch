<?php

// Debug
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('GW_DEBUG', 1);  // set from 0 to 3

// Set PATHs
define('APP_PATH', realpath(dirname(__FILE__) . '/..'));

require_once(APP_PATH . '/lib/gitwatch.php');

// Parse Config
$config = parse_ini_file(APP_PATH . '/config/config.ini', true);

// Get payload
if (isset($_REQUEST['payload'])) {
    $payload = json_decode(str_replace('\\"', '"', $_REQUEST['payload']));
    if($payload === null) {
        die('error: could not process payload!');
    }
    // Run App!
    $app = new gitWatch($config);
    $app->processPayload($payload);
} else {
    die('Error: no payload!');
}
