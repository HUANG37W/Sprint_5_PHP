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
    }
    $vehicleDropDown .= ">$classificationItem[classificationName]</option>";
}
$vehicleDropDown .= "</select>"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/index.css">
    <title>Add Vehicle</title>
</head>

<body>
    <div id="container">
        <?php echo $header; ?>

        <nav>
            <?php echo $navList; ?>
        </nav>

        <main id="add_vehicle">

            <h1>Add a Vechile</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" id="add_vehicle-form" method="post">
                <fieldset>
                    <legend>Add Vehicle</legend>

                    <div>
                        <label for="make">Make: </label>
                        <input type="text" id='make' placeholder="Make" name="make" required <?php if (isset($make)) {
                                                                                                    echo "value='$make'";
                                                                                                }  ?>>
                    </div>
                    <div>
                        <label for="model">Model: </label>
                        <input type="text" id='model' placeholder="Model" name="model" required <?php if (isset($model)) {
                                                                                                    echo "value='$model'";
                                                                                                }  ?>>
                    </div>
                    <div>
                        <label for="description">Description: </label>
                        <textarea name="description" id="description" required>
<?php if (isset($description)) {
    echo $description;
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
                                                                                                                }  ?>>
                    </div>
                    <div>
                        <label for="stock">Stock: </label>
                        <input type="number" placeholder="Stock" id="stock" name="stock" required <?php if (isset($stock)) {
                                                                                                        echo "value='$stock'";
                                                                                                    }  ?>>
                    </div>
                    <div>
                        <label for="color">Color: </label>
                        <input type="text" id='color' name="color" <?php if (isset($color)) {
                                                                        echo "value='$color'";
                                                                    }  ?>>
                    </div>
                    <div>
                        <label for="classification">Classification: </label>

                        <?php
                        echo $vehicleDropDown;
                        ?>
                    </div>
                    <div>

                        <input type="submit" name="submit" id="addVBtn" value="Add Vehicle">
                        <input type="hidden" name="action" value="AddVehicle">
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