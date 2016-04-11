<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 08.04.16
 * Time: 20:00
 */

include_once 'bootstrap.php';

// Database connection:
$db = new mysqli('localhost', 'root', 'root', 'minicms');
if (!$db) {
    throw new Exception($db->connect_error, $db->connect_errno);
}

// Make your model available
include 'src/UserModel.php';

// Create an instance
$userModel = new \Models\UserModel($db);
// Get the list of Users
$userList = $userModel->getAllUsers();
// Get user by Id
$userById = $userModel->getUserById(2);
// Get login information






// Show the view
include 'view.php';

