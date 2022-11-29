<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/index.css">
    <title>Vehicle Detail</title>
</head>

<body>

    <div id="container">
        <?php echo $header; ?>

        <nav>
            <?php echo $navList; ?>
        </nav>
        <main id="vehicleDetail">
            <h1>Vehicle Detail</h1>
            <?php
            if (isset($message)) {
                echo $message;
            } else {
                echo $vehicleHTML;
            }
            ?>
        </main>
        <?php echo $footer; ?>

    </div>
</body>

</html>