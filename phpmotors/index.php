<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case '':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/home.php';
        break;
    case 'Search-page':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/search.php';
        break;
    case 'Search':
        $searchInput = filter_input(INPUT_GET, 'search-input', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $answer = searchAllDb($searchInput);
        echo $answer;
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/search.php';
        break;
    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/template.php';
        break;
}
exit;