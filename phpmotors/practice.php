<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // session_start();
    // $_SESSION['something'] = 'yea';
    // echo $_SESSION['something'], 1;
    // include "./practice2.php";

    setcookie('something', "1", time() + 100);
    ?>
    <button> <a href="./practice2.php">Remove</a></button>
</body>

</html>