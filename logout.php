<?php
/**
 * Created by PhpStorm.
 * User: esletzbichler
 * Date: 12.04.16
 * Time: 17:03
 */
require_once 'dbconfig.php';

if ($_GET['logout'] == true)
{
    $logout = $user->logout();
}
else {
    header('Location: home.php');
}