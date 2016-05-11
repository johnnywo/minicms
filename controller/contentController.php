<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 14.04.16
 * Time: 21:00
 */
include_once(__DIR__ . '/../dbconfig.php');


if(isset($_POST['submit']))
{
    var_dump($_POST);
    print_r($_FILES);
    $language = $_SESSION['user_language'];
    
    $url = filter_input(INPUT_POST, 'url');
    $title = filter_input(INPUT_POST, 'title');
    $meta_description = filter_input(INPUT_POST, 'meta_description');
    $h1 = filter_input(INPUT_POST, 'h1');
    $htmlText = filter_input(INPUT_POST, 'htmltext');
    $menu_link_title = filter_input(INPUT_POST, 'menu_link_title');
    $menu_link_main_menu = false;
    $menu_link_footer_menu = false;


    if(isset($_POST['menu_link_main_menu']))
        $menu_link_main_menu = TRUE;
    
    if(isset($_POST['menu_link_footer_menu']))
        $menu_link_footer_menu = TRUE;

    if(isset($_FILES['customImg']['error']) && $_FILES['customImg']['error'] == 0) {
        $image_path = UPLOADIR . basename($_FILES['customImg']['name']);
        var_dump($image_path);
        move_uploaded_file($_FILES['customImg']['tmp_name'],
                            UPLOADIR . $_FILES['customImg']['name']);
    } else {
        echo 'something went wrong with Image upload.';
    }

    $content->addContent($title, $language, $title, $meta_description, $h1, $htmlText, $menu_link_title, $menu_link_main_menu, $menu_link_footer_menu, $image_path);
}




