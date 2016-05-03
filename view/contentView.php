<?php
/**
 * Created by PhpStorm.
 * User: esletzbichler
 * Date: 27.04.16
 * Time: 14:49
 */

// überprüfen, ob URL Parameter hat oder leer, falls leer Startseite anzeigen.

$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
switch ($lang){
    case "de":
        $lang = 1; // deutsch
        break;
    case "en":
        $lang = 2; // english
        break;
    default:
        $lang = 1; // deutsch
        break;
}

if($user->is_loggedin()) {
    $lang = intval($_SESSION['user_language']);
    $user_name = printf('<span>Hallo %s!</span>', $_SESSION['user_name']);
}

$content->getMainMenu($lang);

if(!isset($_GET['id']) || $_GET['id'] == ''){
    ?>
    <h1>Willkommen auf der Startseite</h1>
<?php
    }

// sonst aus der ID und zugehörigen Sprache Inhalte ausgeben:
    else
    {
        $id = $_GET['id'];

        //var_dump($lang);
        if($content->getContent($id, $lang) === null){
            $lang_deusch = 1;
            $lang_english = 2;
            $replace_content = $content->getContent($id, $lang_deusch) === !null ? $content->getContent($id, $lang_english) === !null : 'nichts gefunden.';
            print $replace_content;
            //print('<p>Dieser Inhalt wurde noch nicht übersetzt / This content was not translated until now.</p>');

        } else {
            $content->getContent($id, $lang);
        }
        print('<h1>' . $content->getTitle() . '</h1>');
        print $content->getHtmlContent();

    }

//printf(''$user->logout();
$content->contentList(1);

?>