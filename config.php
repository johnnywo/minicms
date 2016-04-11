<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 09.04.16
 * Time: 13:09
 */

defined('ENV') || define('ENV', (getenv('ENV') ? getenv('ENV') : 'production'));
define("PATHAPP", realpath(__DIR__ . "/../"));

ini_set('log_errors', 'On');
ini_set('error_log', PATHAPP . "/log/error.log");


if(ENV === "development") {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
} else {
    ini_set('display_errors', 'Off');
}