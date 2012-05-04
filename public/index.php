<?php

// Debug
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('GW_DEBUG', 1);  // set from 0 to 3

// Set PATHs
define('APP_PATH', realpath(dirname(__FILE__) . '/..'));

require_once(APP_PATH . '/lib/gitwatch.php');

// TEST
//$_REQUEST['payload'] = '{\"pusher_id\":236919,\"branch\":\"master\",\"pusher_name\":\"Attila  Kerekes\",\"uri\":\"git@vranz.beanstalkapp.com:/codingstandards.git\",\"commits\":[{\"message\":\"@improv all\",\"author\":{\"name\":\"Attila Kerekes\",\"email\":\"attila.kerekes@vranz.com\"},\"changed_dirs\":[],\"url\":\"http://vranz.beanstalkapp.com/codingstandards/changesets/b4f598e3\",\"timestamp\":\"2012-05-03T15:25:13Z\",\"id\":\"b4f598e3118d3eb69ba341de590be6b2445bdab1\",\"changed_files\":[[\"sites/home.md\",\"edit\"]]}],\"after\":\"b4f598e3118d3eb69ba341de590be6b2445bdab1\",\"push_is_too_large\":false,\"repository\":{\"private\":true,\"url\":\"http://vranz.beanstalkapp.com/codingstandards\",\"owner\":{\"name\":\"martin repliuc\",\"email\":\"finanz@vranz.com\"},\"name\":\"codingstandards\"},\"before\":\"6dbfd31912ce1951f1ed9a6c3b9df9c69746ef46\",\"ref\":\"refs/heads/master\"}';

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
