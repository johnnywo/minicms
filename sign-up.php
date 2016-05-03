<?php
/**
 * Created by PhpStorm.
 * User: esletzbichler
 * Date: 12.04.16
 * Time: 09:10
 */

require_once 'dbconfig.php';

/*if($user->is_loggedin());
{
    $user->redirect('addContent.php');
}*/

if(isset($_POST['sign-up']))
{
    $uname = trim(filter_input(INPUT_POST, 'uname'));
    $umail = trim(filter_input(INPUT_POST, 'umail'));
    $upass = trim(filter_input(INPUT_POST, 'upass'));
    $ulang = filter_input(INPUT_POST, 'ulang');
    
    if($uname == '')
    {
        $error[] = 'Bitte gib einen Usernamen an!';
    }
    elseif ($umail == '') 
    {
        $error[] = 'Bitte gib deine E-Mail Adresse an!';
    }
    elseif (!filter_var($umail, FILTER_VALIDATE_EMAIL))
    {
        $error[] = 'Bitte eine gültige E-Mail Adresse eingeben!';
    }
    elseif ($upass == '')
    {
        $error[] = 'Bitte ein Passwort angegeben!';
    }
    elseif (strlen($upass) < 6)
    {
        $error[] = 'Bitte geben Sie ein Passwort mit mindestens 6 Zeichen an!';
    }
    elseif (!isset($ulang))
    {
        $error[] = 'Bitte deine bevorzugte Sprache angeben.';
    }
    else
    {
        try
        {
            $stmt = $db_con->prepare('SELECT user_name, user_email FROM users WHERE user_name = :uname OR user_email = :umail');
            $stmt->execute(array(':uname' => $uname, ':umail' => $umail));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row['user_name'] == $uname)
            {
                $error[] = 'Sorry, dieser Username ist bereits vorhanden!';
            }
            elseif ($row['user_email'] == $umail)
            {
                $error[] = 'Sorry, diese E-Mail Adresse ist bereits vorhanden!';
            }
            else {
                if ($user->register($ulang, $uname, $umail, $upass))
                {
                    $user->redirect('sign-up.php?joined');
                }
            }
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

include 'partial/header.php';
?>

<form method="post">
    <h2>Neues Benutzerkonto registrieren.</h2>
    <?php
    if(isset($error))
    {
        foreach($error as $error)
        {
            ?>
            <div class="callout alert">
                <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
            </div>
            <?php
        }
    }
    else if(isset($_GET['joined']))
    {
        ?>
        <div class="callout success">
            <i class="glyphicon glyphicon-log-in"></i> &nbsp; Registrierung erfolgreich! <a href='login.php'>jetzt einloggen</a>
        </div>
        <?php
    }
    ?>
        <input type="text" class="form-control" name="uname" placeholder="dein Username" value="<?php if(isset($error)){echo $uname;}?>" />




        <input type="text" class="form-control" name="umail" placeholder="deine E-Mail Adresse" value="<?php if(isset($error)){echo $umail;}?>" />


        <input type="password" class="form-control" name="upass" placeholder="dein Passwort" />

    <p>Sprache:</p>

    <?php
    foreach ($user->getLanguageList() as $index => $item) {
        printf('<input type="radio" name="ulang" value="%d"> %s<br>', $item['idlanguage'], $item['language']);
    }
    ?>
    <br>
    <input class="button" type="submit" name="sign-up" value="jetzt registrieren!" />

    <br />
    <label>Hast du bereits einen Account? <a href="login.php">einloggen</a></label>
</form>

<?php
include 'partial/footer.php';
?>

