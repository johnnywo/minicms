<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 08.04.16
 * Time: 20:13
 */

/*foreach ($userList as $row):
    printf('%s %s<br>', $row['firstname'], $row['lastname']);
endforeach;*/

//printf('Hallo, %s %s', $userById['firstname'], $userById['lastname']);
if(isset($_POST['email'])){

    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'pass');
    //var_dump($_POST['email']);
    //var_dump($_POST['pass']);
    $userLogin = $userModel->loginUser($email, $password);
    if($userModel->getLogin() === TRUE){
        print('<p>Login erfolgreich</p>');
    }   else{
        print('<p>Login fehlgeschlagen</p>');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>Login</h1>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <p>E-Mail:<br>
        <input type="text" id="email" name="email"></p>
    <p>Passwort:<br>
        <input type="text" id="pass" name="pass"</p>
    <p><input type="submit" value="Anmelden"></p>
</form>
<?php


// printf('<p>SQL: %s</p>', $sql);
?>
</body>
</html>