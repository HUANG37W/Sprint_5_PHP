<!DOCTYPE html>
<html lang="en">
<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}

$vehicleDropDown = "<select name='classification' id='classification' required><option value=''>None</option>";
foreach ($classificationList as $classificationItem) {
    $vehicleDropDown .= "<option value=" . urlencode($classificationItem['classificationId']);
    if (isset($classification)) {
        if ($classificationItem['classificationId'] == $classification) {
            $vehicleDropDown .= ' selected ';
        }
    } elseif (isset($invInfo['classificationId'])) {
        if ($classificationItem['classificationId'] === $invInfo['classificationId']) {
            $vehicleDropDown .= ' selected ';
        }
    }
    $vehicleDropDown .= ">$classificationItem[classificationName]</option>";
}
$vehicleDropDown .= "</select>";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/index.css">
    <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Modify $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
                echo "Modify $invMake $invModel";
            } ?> | PHP Motors</title>
</head>

<body>
    <div id="container">
        <?php echo $header; ?>

        <nav>
            <?php echo $navList; ?>
        </nav>

        <main id="update_vehicle">

            <h1><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                    echo "Modify $invInfo[invMake] $invInfo[invModel]";
                } elseif (isset($make) && isset($model)) {
                    echo "Modify$make $model";
                } ?></h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" id="update_vehicle-form" method="post">
                <fieldset>
                    <legend>Update Vehicle</legend>

                    <div>
                        <label for="make">Make: </label>
                        <input type="text" id='make' placeholder="Make" name="make" required <?php if (isset($make)) {
                                                                                                    echo "value='$make'";
                                                                                                } elseif (isset($invInfo['invMake'])) {
                                                                                                    echo "value='$invInfo[invMake]'";
                                                                                                } ?>>
                    </div>
                    <div>
                        <label for="model">Model: </label>
                        <input type="text" id='model' placeholder="Model" name="model" required <?php if (isset($model)) {
                                                                                                    echo "value='$model'";
                                                                                                } elseif (isset($invInfo['invModel'])) {
                                                                                                    echo "value='$invInfo[invModel]'";
                                                                                                } ?>>
                    </div>
                    <div>
                        <label for="description">Description: </label>
                        <textarea name="description" id="description" required>
<?php if (isset($description)) {
    echo $description;
} elseif (isset($invInfo['invDescription'])) {
    echo $invInfo['invDescription'];
} ?></textarea>
                    </div>
                    <div id="imageDiv">
                        <label for="image">Image: </label>
                        <input type="text" id='image' name="image" value="/phpmotors/images/no-image.png">
                    </div>
                    <div id="thumbnailDiv">
                        <label for="thumbnail">Thumbnail: </label>
                        <input type="text" id='thumbnail' name="thumbnail" value="/phpmotors/images/no-image.png">
                    </div>
                    <div>
                        <label for="price">Price: </label>
                        <input type="number" step="0.01" id='price' placeholder="Price" name="price" required <?php if (isset($price)) {
                                                                                                                    echo "value='$price'";
                                                                                                                } elseif (isset($invInfo['invPrice'])) {
                                                                                                                    echo "value='$invInfo[invPrice]'";
                                                                                                                } ?>>
                    </div>
                    <div>
                        <label for="stock">Stock: </label>
                        <input type="number" placeholder="Stock" id="stock" name="stock" required <?php if (isset($stock)) {
                                                                                                        echo "value='$stock'";
                                                                                                    } elseif (isset($invInfo['invStock'])) {
                                                                                                        echo "value='$invInfo[invStock]'";
                                                                                                    } ?>>
                    </div>
                    <div>
                        <label for="color">Color: </label>
                        <input type="text" id='color' name="color" <?php if (isset($color)) {
                                                                        echo "value='$color'";
                                                                    } elseif (isset($invInfo['invColor'])) {
                                                                        echo "value='$invInfo[invColor]'";
                                                                    } ?>>
                    </div>
                    <div>
                        <label for="classification">Classification: </label>

                        <?php
                        echo $vehicleDropDown;
                        ?>
                    </div>
                    <div>

                        <input type="submit" name="submit" id="addVBtn" value="Update Vehicle">
                        <input type="hidden" name="action" value="UpdateVehicle">
                        <input type="hidden" name="invId" value="
<?php if (isset($invInfo['invId'])) {
    echo $invInfo['invId'];
} elseif (isset($invId)) {
    echo $invId;
} ?>
">
                    </div>
                    <div>
                        <span id="addV_to_addC"><a
                                href="/phpmotors/vehicles/index.php?action=AddClassification_page">Add
                                New
                                Classification</a></span>
                        <span id="back"><a href="/phpmotors/vehicles/index.php">Go Back</a></span>
                    </div>
                </fieldset>
            </form>
        </main>

    </div>
</body>

</html>