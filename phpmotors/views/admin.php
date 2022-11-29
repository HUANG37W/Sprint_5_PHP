<?php if ($_SESSION['loggedin'] == false) {
    header("Location: /phpmotors/accounts/?action=Login_page");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/index.css">
    <title>Admin</title>
</head>

<body>

    <div id="container">
        <?php

        require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';
        echo $header;
        ?>

        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>


            <?php
            echo "<h1>" . $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'] . "</h1>";
            echo "<p id='user-login_message'>You are logged in! </p>";
            echo "<ul id='admin-info'><li><label>First Name: </label><span>" . $_SESSION['clientData']['clientFirstname'] . "</span></li><li><label>Email: </label><span>" . $_SESSION['clientData']['clientEmail'] . "</span></li></ul>";
            echo "<h3 id='user-update_heading'>Account Management</h3><p id='user-update_hint'>You can click on the button below to update your account.</p>";

            echo "<a href='/phpmotors/accounts/?action=Update-page' id='user-update_link'>Update my account</a>";

            if ($_SESSION['clientData']['clientLevel'] > 1) {
                echo "<h3 id='admin-management_heading'>Inventory Management</h3><p id='admin-management_hint'>You can click on the button below to manage the inventory.</p>";
                echo "<a href='/phpmotors/vehicles/?action=Vehicle-management' id='admin-management_link'>Vehicle Management</a>";
            }
            ?>

        </main>
        <?php echo $footer; ?>

    </div>
</body>

</html>