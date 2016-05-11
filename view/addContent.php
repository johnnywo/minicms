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
/*$user_id = $_SESSION['user_session'];

$stmt = $db_con->prepare('SELECT * FROM users LEFT JOIN language ON 
                          users.language_idlanguage=language.idlanguage WHERE user_id = :user_id');
$stmt->execute(array(':user_id' => $user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);*/

include 'partial/header.php';
?>

<div class="header" xmlns="http://www.w3.org/1999/html">

</div>
<div class="row column">
    Hallo <?php print($_SESSION['user_name']); ?>, füge neuen Inhalt hinzu:
</div>

<div class="row column">
    <form method="post" action="../controller/contentController.php" enctype="multipart/form-data">
        <label for="Image">Header Bild: </label><input type="file" name="customImg">
        <label for="Title">Title Tag der Seite: </label><input type="text" name="title">
        <label for="meta_description">Meta Description: </label><input type="text" name="meta_description">
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



<!--<form enctype="multipart/form-data"
      action="<?php /*print($_SERVER['PHP_SELF']) */?>"
      method="post">
    <p>Datei: <input type="file" name="customImg"></p>
    <p><input type="submit" name="upload" value="Datei hinaufladen"></p>
    <?php /*print_r($_FILES); */?>
</form>

</body>
</html>-->

<label class="row column"><a href="../logout.php?logout=true"> logout</a></label>


<?php
include 'partial/footer.php';
?>


