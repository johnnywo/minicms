<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 10.04.16
 * Time: 10:48
 */

require_once 'dbconfig.php';

if($user->is_loggedin()!='')
{
    $user->redirect('home.php');
}

if(isset($_POST['login']))
{
    $uname = $_POST['uname'];
    $umail = $_POST['uname'];
    $upass = $_POST['upass'];

    if($user->login($uname, $umail, $upass))
    {
        $user->redirect('home.php');
    }
    else
    {
        $error = 'Anmeldedaten nicht korrekt!';
    }

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
                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
            }
            ?>

                <input type="text" class="form-control" name="uname" placeholder="Username oder E-mail Adresse" required />

                <input type="password" class="form-control" name="upass" placeholder="Passwort" required />

                <button type="submit" name="btn-login" class="button">
                    <i class="glyphicon glyphicon-log-in"></i>&nbsp;SIGN IN
                </button>

            <br />
            <!--<label>Noch kein Benutzerkonto? <a href="sign-up.php">zur Registrierung</a></label>-->
        </form>


<?php
include 'partial/footer.php';
?>
