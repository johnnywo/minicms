<?php
/**
 * Created by PhpStorm.
 * User: esletzbichler
 * Date: 12.04.16
 * Time: 09:52
 */

include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
    $user->redirect('login.php');
}
$user_id = $_SESSION['user_session'];

$stmt = $db_con->prepare('SELECT * FROM users LEFT JOIN language ON 
                          users.language_idlanguage=language.idlanguage WHERE user_id = :user_id');
$stmt->execute(array(':user_id' => $user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

$_SESSION['user_language'] = $userRow['idlanguage'];
//var_dump($_SESSION);

include 'partial/header.php';
?>

<div class="header">

</div>
<div class="content">
    Hallo <?php print($userRow['user_name']); ?>!<br />
    Deine bevorzugte Sprache lautet: <b><?php print($userRow['language']) ?></b>
</div>

<div class="row">
    <form method="post" action="controller/contentController.php">
        <label for="pagename">Name der Seite: </label> <input type="text" name="pagename">
        <label for="pagetitle">Titel der Seite: </label> <input type="text" name="pagetitle">
        <label for="headertitle">Header Title: </label> <input type="text" name="headerTitle">
        <label for="sitename">Site Name: </label> <input type="text" name="sitename">
        <label for="slogan">Slogan: </label> <input type="text" name="slogan">
        <label for="h1">H1 Title: </label> <input type="text" name="h1">
        <!--<label for="htmltext">Inhalt: </label> <input type="text" name="htmltext">-->
            <textarea name="htmltext" id="htmltext" rows="10" cols="80">
                This is my textarea to be replaced with CKEditor.
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'htmltext' );
            </script>
        <input type="submit" name="submit" value="Inhalt erstellen">
    </form>
</div>

<label><a href="logout.php?logout=true"> logout</a></label>


<?php
include 'partial/footer.php';
?>


