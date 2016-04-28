<?php
/**
 * Created by PhpStorm.
 * User: esletzbichler
 * Date: 27.04.16
 * Time: 14:49
 */



if(!isset($_GET['id']) || $_GET['id'] == ''){
    ?>
    <h1>Willkommen auf der Startseite</h1>
<?php
    }
    else
    {
        $id = $_GET['id'];
        $lang_default = 1;
        if(isset($user->getLanguage($_SESSION['user_session'])) ? $user->getLanguage($_SESSION['user_session']) : $lang_default);
        //echo $lang;
        $content->getContent($id, $lang);
        print $content->getTitle();
        print $content->getHtmlContent();
    }


?>