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
    $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
/*$stmt = $db_con->prepare('SELECT * FROM users WHERE user_id = :user_id');
$stmt->execute(array(':user_id' => $user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);*/

$stmt = $db_con->prepare('SELECT * FROM users LEFT JOIN language ON 
                          users.language_idlanguage=language.idlanguage WHERE user_id = :user_id');
$stmt->execute(array(':user_id' => $user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

include 'partial/header.php';
?>

<div class="header">

</div>
<div class="content">
    Hallo <?php print($userRow['user_name']); ?>!<br />
    Deine bevorzugte Sprache lautet: <b><?php print($userRow['language']) ?></b>
</div>

<label><a href="logout.php?logout=true"> logout</a></label>


<?php
include 'partial/footer.php';
?>


