<?php
// This is the accounts controller

 require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
 // Get the accounts model
 require_once '../model/main-model.php';

$action = filter_input(INPUT_GET,'action');
if ($action == NULL) {
    $action = filter_input(INPUT_POST,'action');
}


switch ($action) {
    case 'Login':
        include '../views/login.php';
        break;
    case 'Register':
        include '../views/register.php';
        echo 'You are in the register case statement.';
        break;
    default:
        include '../views/login.php';
    }


