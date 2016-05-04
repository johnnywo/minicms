<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 10.04.16
 * Time: 10:48
 */

require_once 'dbconfig.php';

if($user->is_loggedin() != '')
{
    $user->redirect('index.php');
}

if(isset($_POST['login']))
{
    $uname = $_POST['uname'];
    $umail = $_POST['uname'];
    $upass = $_POST['upass'];

    if($user->login($uname, $umail, $upass))
    {
        $user->redirect('index.php');
    }
    else
    {
        $error = 'Anmeldedaten nicht korrekt!';
    }

}

if(isset($_GET['logged-out'])) {
    print('<div class="callout notice">Du bist nun abgemeldet.</div>');
}

include 'partial/header.php';
?>


        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <h2>Anmeldung.</h2><hr />
            <?php
            if(isset($error))
            {
                ?>
                <div class="callout alert">
                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                </div>
                <?php
            }
            ?>

                <input type="text" class="form-control" name="uname" placeholder="Username oder E-mail Adresse" required />

                <input type="password" class="form-control" name="upass" placeholder="Passwort" required />

                <input type="submit" name="login" value="Login" />

            <br />
            <label>Noch kein Benutzerkonto? <a href="sign-up.php">zur Registrierung</a></label>
        </form>


<?php
//var_dump($_SESSION);
include 'partial/footer.php';
?>
