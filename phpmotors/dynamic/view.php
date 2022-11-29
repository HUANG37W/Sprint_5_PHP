<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/phpmotors/dynamic/controller.php" id="form" method="get">
        <div>
            <label for="selection">Id: </label>
            <?php
            echo $dropdown;
            ?>
        </div>
        <?php
        echo $products;
        ?>
        <input type="submit" name="submit" id="idBtn" value="get info">
        <input type="hidden" name="action" value="">
    </form>

</body>

</html>