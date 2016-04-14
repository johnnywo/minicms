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
    
    $pageName = filter_input(INPUT_POST, 'pagename');
    $pageTitle = filter_input(INPUT_POST, 'pagetitle');
    $headerTitle = filter_input(INPUT_POST, 'headertitle');
    $siteName = filter_input(INPUT_POST, 'sitename');
    $slogan = filter_input(INPUT_POST, 'slogan');
    $h1 = filter_input(INPUT_POST, 'h1');
    $htmlText = filter_input(INPUT_POST, 'htmltext');

    $content->addContent();
}

