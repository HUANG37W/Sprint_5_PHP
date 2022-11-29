<!DOCTYPE html>
<html lang="en">
<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}
$clientData = $_SESSION["clientData"];
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/index.css">
    <title>Update Client</title>
</head>

<body>

    <div id="container">
        <?php echo $header; ?>

        <nav>
            <?php echo $navList; ?>
        </nav>
        <main id="update-client">
            <h1>Update</h1>
            <?php
            if ($_SESSION['message']) {
                echo $_SESSION['message'];
            }
            ?>
            <form action="/phpmotors/accounts/index.php" id="update_client-form" method="post">
                <fieldset>
                    <legend>Update Client Profile</legend>

                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" required id="email" <?php
                                                                                if (isset($clientData)) {
                                                                                    echo "value='$clientData[clientEmail]'";
                                                                                } ?>>
                    </div>
                    <div>
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" required id="firstname" <?php
                                                                                    if (isset($clientData)) {
                                                                                        echo "value='$clientData[clientFirstname]'";
                                                                                    } ?>>
                    </div>
                    <div>
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" required id="lastname" <?php
                                                                                    if (isset($clientData)) {
                                                                                        echo "value='$clientData[clientLastname]'";
                                                                                    } ?>>
                    </div>
                    <div>

                        <input type="submit" name="submit" id="updateBtn" value="Update Account">
                        <input type="hidden" name="action" value="UpdateClient">
                        <input type="hidden" name="clientId" value="
                        <?php if (isset($clientData)) {
                            echo $clientData['clientId'];
                        } ?>
">
                    </div>
                </fieldset>
            </form>
            <form action="/phpmotors/accounts/index.php" id="update_client_password-form" method="post">
                <fieldset>
                    <legend>Update Password</legend>
                    <div>
                        <label for="password">New Password</label>
                        <input type="password" placeholder="New Passord" id="password" required name="password"
                            pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                        <span class="hint">*By submitting this input, your password will be changed* <br>Passwords must
                            be at
                            least 8 characters and contain at least 1
                            number, 1 capital letter and 1 special character</span>
                    </div>
                    <div>
                        <input type="submit" name="submit" id="updatePasswordBtn" value="Update Password">
                        <input type="hidden" name="action" value="UpdateClientPassword">
                        <input type="hidden" name="clientId" value="
                        <?php if (isset($clientData)) {
                            echo $clientData['clientId'];
                        } ?>">
                    </div>
                </fieldset>
            </form>
        </main>
        <?php echo $footer; ?>

    </div>
</body>

</html>