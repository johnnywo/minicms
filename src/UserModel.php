<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 08.04.16
 * Time: 17:52
 */

namespace Models;


class UserModel
{

    protected $db;
    private $login;

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    public function getAllUsers()
    {
        return $this->db->query('SELECT * FROM users');
    }

    public function getUserById($idUs)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE user_id = (?)');
        $stmt->bind_param('i', $idUs);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            return $row;
        }
    }
    
/*    public function loginUser($email, $password)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = (?) AND password = (?)');
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $stmt->bind_result($retUsId);
        $row = $stmt->fetch();
        //$error = 'Anmeldeinformationen nicht korrekt.';

        if($retUsId){
            $this->setLogin(TRUE);
            return $row;
        } else {
            $this->setLogin(FALSE);
            //return $error;
        }
    }*/

    public function loginUser($email, $password)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = (?) AND password = (?)');
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            return $row;
        }
    }
}
