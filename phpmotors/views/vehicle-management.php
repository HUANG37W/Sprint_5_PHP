<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/index.css">
    <script src="../js/inventory.js" defer></script>

    <title>Management</title>
</head>

<body>
    <div id="container">
        <?php echo $header; ?>

        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>
            <div id="vehicle_controller">
                <h1>Vehicle Controller</h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                if (isset($classificationList)) {
                    echo '<label for="classificationList">Vehicles By Classification</label>';
                    echo $classificationList;
                    echo '<p>Choose a classification to see those vehicles</p>';
                }
                ?>
                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>
                <table id="inventoryDisplay"></table>

                <div id='vehicle_controller-buttons'>

                    <div><a href="/phpmotors/vehicles/index.php?action=AddClassification_page">Add New a
                            Classification!</a></div>
                    <div><a href="/phpmotors/vehicles/index.php?action=AddVehicle_page">Add New a Vehicle!</a></div>
                </div>

            </div>
        </main>
        <?php echo $footer; ?>

    </div>
</body>

</html>
<?php unset($_SESSION['message']); ?>