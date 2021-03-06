<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 10.04.16
 * Time: 10:25
 */

namespace Models;


class User
{
    /**
     * @var \PDO
     */
    private $db;
    

    function __construct($db_con)
    {
        $this->db = $db_con;
    }

    public function register($ulang, $uname, $umail, $upass)
    {
        try
        {
            $new_password = password_hash($upass, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare('INSERT INTO users(language_idlanguage, user_name, user_email, user_pass) VALUES (:ulang, :uname, :umail, :upass)');

            $stmt->bindparam(':ulang', $ulang);
            $stmt->bindparam(':uname', $uname);
            $stmt->bindparam(':umail', $umail);
            $stmt->bindparam(':upass', $new_password);
            $stmt->execute();
            return true;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function login($uname, $umail, $upass)
    {
        try
        {
            $stmt = $this->db->prepare('SELECT * FROM users WHERE user_name = :uname OR user_email = :umail');
            $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
            $userRow = $stmt->fetch(\PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0)
            {
                if(password_verify($upass, $userRow['user_pass']))
                {
                    $_SESSION['user_session'] = $userRow['user_id'];
                    $_SESSION['user_name'] = $userRow['user_name'];
                    $_SESSION['user_language'] = $userRow['language_idlanguage'];
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
    }

    
    public function getLanguage($user_id)
    {
        try
        {
            $stmt = $this->db->prepare('SELECT * FROM users LEFT JOIN language ON 
                          users.language_idlanguage=language.idlanguage WHERE user_id = :user_id');
            $stmt->execute(array(':user_id' => $user_id));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['user_language'] = $userRow['idlanguage'];
            
            

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    
    public function getLanguageList()
    {
        try{
            $stmt = $this->db->prepare('SELECT * FROM language');
            $stmt->execute();
            $langRow = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            //print_r($langRow);
            return $langRow;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        header('Location: login.php?logged-out');
        return true;
    }
}