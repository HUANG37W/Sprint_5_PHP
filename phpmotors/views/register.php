<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/index.css">
    <title>Register</title>
</head>

<body>

    <div id="container">
        <?php echo $header; ?>

        <nav>
            <?php echo $navList; ?>
        </nav>
        <main id="register">
            <h1>Welcome!</h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <form action="/phpmotors/accounts/index.php" id="register-form" method="post">
                <fieldset>
                    <legend>Register</legend>
                    <div>
                        <label for="register-form-fname">Firstname: </label>
                        <input type="text" id='register-form-fname' required placeholder="first" name="clientFirstname"
                            <?php if (isset($clientFirstname)) {
                                                                                                                            echo "value='$clientFirstname'";
                                                                                                                        }  ?>>
                    </div>
                    <div>
                        <label for="register-form-lname">Lastname: </label>
                        <input type="text" id='register-form-lname' required placeholder="last" name="clientLastname"
                            <?php if (isset($clientLastname)) {
                                                                                                                            echo "value='$clientLastname'";
                                                                                                                        }  ?>>
                    </div>
                    <div>
                        <label for="register-form-email">Email: </label>
                        <input type="email" id='register-form-email' required placeholder="email@com" name="clientEmail"
                            <?php if (isset($clientEmail)) {
                                                                                                                                echo "value='$clientEmail'";
                                                                                                                            }  ?>>
                    </div>
                    <div>
                        <label for="register-form-password">Password: </label>
                        <span class="hint">Passwords must be at least 8 characters and contain at least 1
                            number, 1 capital letter and 1 special character</span>
                        <!-- <script>
                        const requirements = document.getElementsByClassName('input_requirement')
                        console.log(requirements[0].innerHTML)
                        // requirements.forEach(requirement => {
                        //     requirement.style.color = 'red'
                        // })
                        </script> -->
                        <input type="password" id='register-form-password' required placeholder="passw@rd"
                            autocomplete="on" name="clientPassword"
                            pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                    </div>
                    <input type="submit" name="submit" id="regbtn" value="Register">
                    <input type="hidden" name="action" value="Register">

                    <div id="register-form-to_login">Have account?<a
                            href="/phpmotors/accounts/index.php?action=Login_page">Login!</a></div>
                </fieldset>
            </form>
        </main>
        <?php echo $footer; ?>

    </div>
</body>

</html>