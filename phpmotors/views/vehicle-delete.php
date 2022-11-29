<!DOCTYPE html>
<html lang="en">
<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}

// $vehicleDropDown = "<select name='classification' id='classification' required><option value=''>None</option>";
// foreach ($classificationList as $classificationItem) {
//     $vehicleDropDown .= "<option value=" . urlencode($classificationItem['classificationId']);
//     if (isset($classification)) {
//         if ($classificationItem['classificationId'] == $classification) {
//             $vehicleDropDown .= ' selected ';
//         }
//     } elseif (isset($invInfo['classificationId'])) {
//         if ($classificationItem['classificationId'] === $invInfo['classificationId']) {
//             $vehicleDropDown .= ' selected ';
//         }
//     }
//     $vehicleDropDown .= ">$classificationItem[classificationName]</option>";
// }
// $vehicleDropDown .= "</select>";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/index.css">
    <title><?php if (isset($invInfo['invMake'])) {
                echo "Delete $invInfo[invMake] $invInfo[invModel]";
            } ?> | PHP Motors</title>
</head>

<body>
    <div id="container">
        <?php echo $header; ?>

        <nav>
            <?php echo $navList; ?>
        </nav>

        <main id="delete_vehicle">

            <h1><?php if (isset($invInfo['invMake'])) {
                    echo "Delete $invInfo[invMake] $invInfo[invModel]";
                } ?></h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" id="delete_vehicle-form" method="post">
                <fieldset>
                    <legend>Delete Vehicle</legend>

                    <div>
                        <label for="make">Vehicle Make</label>
                        <input type="text" readonly name="make" id="make" <?php
                                                                            if (isset($invInfo['invMake'])) {
                                                                                echo "value='$invInfo[invMake]'";
                                                                            } ?>>
                    </div>
                    <div>
                        <label for="model">Vehicle Model</label>
                        <input type="text" readonly name="model" id="model" <?php
                                                                            if (isset($invInfo['invModel'])) {
                                                                                echo "value='$invInfo[invModel]'";
                                                                            } ?>>
                    </div>
                    <div>
                        <label for="description">Vehicle Description</label>
                        <textarea name="description" readonly id="description"><?php
                                                                                if (isset($invInfo['invDescription'])) {
                                                                                    echo $invInfo['invDescription'];
                                                                                }
                                                                                ?></textarea>
                    </div>

                    <!-- <div>
                        <label for="classification">Classification: </label>

                        <?php
                        echo $vehicleDropDown;
                        ?>
                    </div> -->
                    <div>

                        <input type="submit" name="submit" id="addVBtn" value="Delete Vehicle">
                        <input type="hidden" name="action" value="DeleteVehicle">
                        <input type="hidden" name="invId" value="
                        <?php if (isset($invInfo['invId'])) {
                            echo $invInfo['invId'];
                        } ?>
">
                    </div>
                </fieldset>
            </form>
        </main>

    </div>
</body>

</html>