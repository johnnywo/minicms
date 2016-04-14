<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 08.04.16
 * Time: 17:57
 */
session_start();

require_once(__DIR__ . '/config.php');

require_once(__DIR__ . '/vendor/autoload.php');

locale_set_default('de-AT.utf8');
date_default_timezone_set('Europe/Berlin');

set_error_handler(function ($errNum, $errStr)
{
    switch ($errNum) {
        case E_USER_ERROR:
        case E_USER_NOTICE:
            //echo "Ich bin ein CustomError NOTICE: " . $errStr . "<br>";
        case E_USER_WARNING:
            break;
        default:
            echo "Ich bin irgendein Fehler von CustomError: " . $errStr . "<br>";
            break;
    }
});


