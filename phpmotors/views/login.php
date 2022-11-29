<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/index.css">
    <title>Login</title>
</head>

<body>

    <div id="container">
        <?php echo $header; ?>

        <nav>
            <?php echo $navList; ?>
        </nav>
        <main id="login">
            <h1>Welcome!</h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <form action="/phpmotors/accounts/" id="login-form" method="post">
                <fieldset>
                    <legend>Sign In</legend>
                    <div>
                        <label for="login-form-email">Email: </label>
                        <input type="email" id='login-form-email' placeholder="email@com" name="clientEmail" required
                            <?php if (isset($clientEmail)) {
                                                                                                                            echo "value='$clientEmail'";
                                                                                                                        }  ?>>
                    </div>
                    <div>
                        <label for="login-form-password">Password: </label>
                        <span class="hint">Passwords must be at least 8 characters and contain at least 1
                            number, 1 capital letter and 1 special character</span>
                        <input type="password" id='login-form-password' placeholder="passw@rd" name="clientPassword"
                            required autocomplete="on"
                            pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                    </div>
                    <input type="submit" name="submit" id="loginbtn" value="Login">
                    <input type="hidden" name="action" value="Login">
                    <div id="login-form-to_sign_up">No account?<a
                            href="/phpmotors/accounts/index.php?action=Register_page">Sign-up!</a></div>
                </fieldset>
            </form>
        </main>
        <?php echo $footer; ?>
    </div>
</body>

</html>