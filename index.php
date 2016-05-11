<?php
/**
 * Created by PhpStorm.
 * User: esletzbichler
 * Date: 27.04.16
 * Time: 14:25
 */

include_once 'dbconfig.php';

include 'partial/header.php';

if(isset($_GET['content']) && $_GET['content'] == 'add'){
    include 'view/addContent.php';
}

include 'view/contentView.php';

include 'partial/footer.php';