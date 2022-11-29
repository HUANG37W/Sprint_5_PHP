<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';

$classificationList = getClassifications();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {

    case 'AddClassification_page':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/add-classification.php';
        break;

    case 'AddClassification':
        $newClassification = trim(filter_input(INPUT_POST, 'newClassification', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        if (empty($newClassification)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/add-classification.php';
            exit;
        }

        $addCNewOutcome = insertClassification($newClassification);

        if ($addCNewOutcome === 1) {
            header("Location: /phpmotors/vehicles/index.php");
            exit;
        } else {
            $addCNewOutcome = "<p>Sorry, but the action failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/add-classification.php';
            exit;
        }
        break;

    case 'AddVehicle_page':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/add-vehicle.php';
        break;

    case 'AddVehicle':
        $make = trim(filter_input(INPUT_POST, 'make', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $model = trim(filter_input(INPUT_POST, 'model', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $image = trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $thumbnail = trim(filter_input(INPUT_POST, 'thumbnail'));
        $price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION,));
        $stock = trim(filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT));
        $color = trim(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classification = trim(filter_input(INPUT_POST, 'classification', FILTER_SANITIZE_NUMBER_INT));
        if (empty($make) || empty($model) || empty($description) || empty($image) || empty($thumbnail) || empty($price) || empty($stock) || empty($color) || empty($classification)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/add-vehicle.php';
            exit;
        }

        $addVNewOutcome = insertVehicle($make, $model, $description, $image, $thumbnail, $price, $stock, $color, $classification);

        if ($addVNewOutcome === 1) {
            $message = "New vechile info has been added to the database.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/add-vehicle.php';
            exit;
        } else {
            $message = "<p>Sorry, but the action failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/add-vehicle.php';
            exit;
        }
        break;
    case 'Vehicle-management':
        $classificationList = buildClassificationList($classifications);

        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/vehicle-management.php';
        break;
    case 'getInventoryItems':
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray);
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/vehicle-update.php';
        exit;
        break;
    case 'UpdateVehicle':
        $classification = filter_input(INPUT_POST, 'classification', FILTER_SANITIZE_NUMBER_INT);
        $make = trim(filter_input(INPUT_POST, 'make', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $model = trim(filter_input(INPUT_POST, 'model', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $image = trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $thumbnail = trim(filter_input(INPUT_POST, 'thumbnail'));
        $price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION,));
        $stock = trim(filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT));
        $color = trim(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($classification) || empty($make) || empty($model) || empty($description) || empty($image) || empty($thumbnail) || empty($price) || empty($stock) || empty($color) || empty($invId)) {
            $message = '<p>Please complete all information for the update item! Double check the classification of the item.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/vehicle-update.php';
            exit;
        }
        $updateResult = updateVehicle($make, $model, $description, $image, $thumbnail, $price, $stock, $color, $classification, $invId);
        if ($updateResult) {
            $message = "<p>Congratulations, the $make $model was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Error. The vehicle was not updated.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/vehicle-update.php';
            exit;
        }
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/vehicle-delete.php';
        exit;
        break;
    case 'DeleteVehicle':
        $invMake = filter_input(INPUT_POST, 'make', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $make $model was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $make $model was not
            deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);
        if (!count($vehicles)) {
            $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/classification.php';
        break;
    case 'VehicleDetail':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Fetch the vehicles by invId from the DB 
        $inventoryArray = getInvItemInfo($invId);
        // Convert the array to a JSON object and send it back 
        if (!$inventoryArray) {
            $message = "<p>The vehicle info is not found!</p>";
        } else {
            $vehicleHTML = generateVehicleHTML($inventoryArray);
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/vehicle-detail.php';
        break;
    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/admin.php';
}
exit;