<?php
/**
 * Created by PhpStorm.
 * User: esletzbichler
 * Date: 27.04.16
 * Time: 14:25
 */

require_once (__DIR__ . '/bootstrap.php');

$user = new \Models\User(\Models\Model::dbCon());
$content = new \Models\Content(\Models\Model::dbCon());

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if('/index.php' === $uri || isset($_GET['id'])) {
    include_once 'partial/header.php';
    include_once 'templates/contentView.php';
} elseif('/index.php/add/content' === $uri) {
        include_once 'partial/header.php';
        include_once 'templates/addContent.php';
} else {
    header('HTTP/1.1 404 Not Found');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
}

//@todo complete switch instead of if elseif else

switch ($_GET) {
    case 'id':
        echo 'bla';
        break;
    case 'sign-up':
        echo: 'bla';
        break;

}

include 'partial/footer.php';