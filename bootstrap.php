<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 08.04.16
 * Time: 17:57
 */
session_start();

require_once(__DIR__ . '/config.php');

locale_set_default('de-AT.utf8');
date_default_timezone_set('Europe/Berlin');

spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'src\\';

    // base directory for the namespace prefix
    $base_dir = 'src';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

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


