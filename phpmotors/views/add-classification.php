<!DOCTYPE html>
<html lang="en">
<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/index.css">
    <title>Add Classification</title>
</head>

<body>
    <div id="container">
        <?php echo $header; ?>

        <nav>
            <?php echo $navList; ?>
        </nav>

        <main id="add_classification">
            <h1>Add a Classification</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" id="add_classification-form" method="post">
                <fieldset>
                    <legend>Add Classification</legend>
                    <div>
                        <label for="new-classification">New Classification: </label>
                        <span class="hint">A classification can be no longer than 30 chars!</span>
                        <input type="text" id='new-classification' placeholder="New classification"
                            name="newClassification" required pattern="[\w\W]{1,30}">
                    </div>
                    <div>

                        <input type="submit" name="submit" id="addCBtn" value="Add Classification">
                        <input type="hidden" name="action" value="AddClassification">
                    </div>
                    <div>

                        <span id="addC_to_addV"><a href="/phpmotors/vehicles/index.php?action=AddVehicle_page">Add New
                                Vehicle</a></span>
                        <span id="back"><a href="/phpmotors/vehicles/index.php">Go Back</a></span>
                    </div>
                </fieldset>
            </form>
        </main>

    </div>
</body>

</html>