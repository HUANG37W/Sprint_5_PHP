<!-- Account's controller -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/dynamic/model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';

$vehicleInfos = getVehicleInfo();

$dropdown = "<select name='selection'><option value=0>All</option>";

foreach ($vehicleInfos as $vehicleInfo) {
    $dropdown .= "<option value=$vehicleInfo[invId]>$vehicleInfo[invId]</option>";
}

$dropdown .= "</select>";

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case '':
        $selection = filter_input(INPUT_GET, 'selection');
        $vehicleInfos = getVehicleInfo($selection);

        $products = "<table>";

        foreach ($vehicleInfos as $vehicleInfo) {
            $products .= "<tr><th>$vehicleInfo[invId]</th><th>$vehicleInfo[invMake]</th><th>$vehicleInfo[invModel]</th><th>$vehicleInfo[invPrice]</th></tr>";
        }

        $products .= "</table>";
        if (empty($selection)) {
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/dynamic/view.php';
            exit;
        } else {

            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/dynamic/view.php';
            exit;
        }
        break;
}