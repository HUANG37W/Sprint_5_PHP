<!-- Account's controller -->
<?php
// ini_set("display_errors", 1);
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';



$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case "Login_page":
        $_SESSION['message'] = '';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/login.php';
        break;
    case 'Login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordCheck = checkPassword($clientPassword);

        // Run basic checks, return if errors
        if (empty($clientEmail) || empty($passwordCheck)) {
            $_SESSION['message'] = '<p class="notice">Please provide a valid email address and password.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;

        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        header('Location: /phpmotors/accounts/?action=Admin');
        // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/admin.php';
        exit;

    case "Register_page":
        $_SESSION['message'] = '';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/register.php';
        break;
    case 'Register':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $checkPassword = checkPassword($clientPassword);
        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if ($existingEmail) {
            $_SESSION['message'] = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/login.php';
            exit;
        }

        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/register.php';
            exit;
        }
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
        if ($regOutcome === 1) {
            $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=Login');
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            header('Location: /phpmotors/accounts/?action=Register');
            exit;
        }
        break;
    case "Admin":
        $_SESSION["message"] = '';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/admin.php';
        break;
    case "Logout":
        session_destroy();
        header('Location: /phpmotors/accounts/');
        break;
    case "Update-page":
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/client-update.php';
        break;
    case "UpdateClient";
        $clientEmail = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $clientFirstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        if ($clientEmail == $_SESSION['clientData']['clientEmail'] && $clientFirstname == $_SESSION['clientData']['clientFirstname'] && $clientLastname == $_SESSION['clientData']['clientLastname']) {
            $_SESSION['message'] = '<p class="notice">Nothing changed.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/client-update.php';
            exit;
        }
        if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
            $existingEmail = checkExistingEmail($clientEmail);
            if ($existingEmail) {
                $_SESSION['message'] = '<p class="notice">That email address already exists.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/client-update.php';
                exit;
            }
        }

        if (empty($clientEmail) || empty($clientFirstname) || empty($clientLastname) || empty($clientId)) {
            $_SESSION['message'] = '<p class="notice">Please fill in all the required fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/client-update.php';
            exit;
        }

        $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
        if ($updateOutcome === 1) {
            $_SESSION['message'] = "<p class='notice'>Thanks for updating $clientFirstname. </p>";
            $clientData = getClient($clientEmail);
            $_SESSION['clientData'] = $clientData;
            header('Location: /phpmotors/accounts/?action=Update-page');
            exit;
        } else {
            $_SESSION['message'] = "<p class='notice'>Sorry $clientFirstname, but the update failed. Please try again.</p>";
            header('Location: /phpmotors/accounts/?action=Update-page');
            exit;
        };
        break;
    case "UpdateClientPassword";
        $clientPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordCheck = checkPassword($clientPassword);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        if (empty($passwordCheck || empty($clientId))) {
            $_SESSION['message'] = "<p class='notice'>Sorry $clientFirstname, try a new password. </p>";
            header('Location: /phpmotors/accounts/?action=Update-page');
            exit;
        }
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        $updateClientPasswordOutcome = updateClientPassword($hashedPassword, $clientId);
        if ($updateClientPasswordOutcome === 1) {
            $_SESSION['message'] = "<p class='notice'>Thanks for updating $clientFirstname's password. </p>";
            header('Location: /phpmotors/accounts/?action=Update-page');
            exit;
        } else {
            $_SESSION['message'] = "<p class='notice'>Sorry $clientFirstname, but the update failed. Please try again.</p>";
            header('Location: /phpmotors/accounts/?action=Update-page');
            exit;
        }

        break;
    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/admin.php';
}

exit;