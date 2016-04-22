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
    $language = $_SESSION['user_language'];
    
    $url = filter_input(INPUT_POST, 'url');
    $url_clean = $content->slugify($url);
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


    $content->addContent($title, $language, $url_clean, $title, $meta_description, $h1, $htmlText, $menu_link_title, $menu_link_main_menu, $menu_link_footer_menu);
}


