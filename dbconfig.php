<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 10.04.16
 * Time: 10:15
 */
//include_once 'bootstrap.php';
session_start();

$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'root';
$db_name = 'minicms';

try
{
    $db_con = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name , $db_user, $db_pass);
    $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo $e->getMessage();
}

include_once 'src/User.php';
$user = new \Models\User($db_con);