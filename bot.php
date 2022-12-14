<?php
if (!isset($_GET['api'])) {
    exit();
}

echo $api;

define('RESPONSE', false);

$jsonPayload = !RESPONSE;
$curlRequestSession = null;

$update = json_decode(file_get_contents('php://input'), true);

function easyVars($update, $prefix = '', $first = true) {
    foreach ($update as $key => $val) {
        $key = $prefix . $key;
        if (is_array($val)) {
            if ($first === true) {
                easyVars($val, '', false);
            } else {
                easyVars($val, $key . '_', false);
            }
        }
        if (!isset($GLOBALS[$key])) {
            $GLOBALS[$key] = $val;
        }
    }
}
easyVars($update);

require_once 'functions.php';
