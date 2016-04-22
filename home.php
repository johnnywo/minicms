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
        <label for="url">URL der Seite: <?php print($_SERVER['SERVER_NAME'] . '/' . $_SERVER['REQUEST_URI'] . '/')?></label> <input type="text" name="url">
        <label for="Title">Title Tag der Seite: </label> <input type="text" name="title">
        <label for="meta_description">Meta Description: </label> <input type="text" name="meta_description">
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
        <label for="menu_link_title">Menu Link Title: </label> <input type="text" name="menu_link_title">
        <input type="checkbox" name="menu_link_main_menu" value="true"> in Main Menu
        <input type="checkbox" name="menu_link_footer_menu" value="true"> in Footer Menu
        <br><input class="button" type="submit" name="submit" value="Inhalt erstellen">
    </form>
</div>

<label><a href="logout.php?logout=true"> logout</a></label>


<?php
include 'partial/footer.php';
?>


