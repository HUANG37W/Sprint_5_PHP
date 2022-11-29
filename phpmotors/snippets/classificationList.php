<?php
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// // Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

$classificationList = getClassifications();


$vehicleDropDown = "<select name='classification' id='classification' required><option>None</option>";
foreach ($classificationList as $classificationItem) {
    $vehicleDropDown .= "<option value=" . urlencode($classificationItem['classificationId']);
    if (isset($classification)) {
        if ($classificationItem['classificationId'] === $classification) {
            $vehicleDropDown .= ' selected ';
        }
    }
    $vehicleDropDown .= ">$classificationItem[classificationName]</option>";
}
$vehicleDropDown .= "</select>";