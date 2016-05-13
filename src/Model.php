<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 12.05.16
 * Time: 20:38
 */

namespace Models;


class Model
{
    public static function dbCon()
    {
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = 'root';
        $db_name = 'minicms';

        try
        {
            $db_con = new \PDO('mysql:host=' . $db_host . ';dbname=' . $db_name , $db_user, $db_pass);
            $db_con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
            $db_con = FALSE;
        }

        return $db_con;
    }
}