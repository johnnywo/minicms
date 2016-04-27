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
        $lang = 2;//$user->getLanguage(2);
        echo $lang;
        $content->getContent($id, $lang);
        print($content->getTitle());
        print $content->getHtmlContent();
    }


?>