<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="/phpmotors/index.css">
    <title>Search</title>
</head>

<body>

    <div id="container">
        <?php echo $header; ?>

        <nav>
            <?php echo $navList; ?>
        </nav>
        <main id="search">
            <h1>Search</h1>
            <form action="/phpmotors/" id="search-form">
                <input type="text" placeholder="What are you looking for today?" name="search-input">
                <input type="submit" name="submit" id="search-btn" value="Search">
                <input type="hidden" name="action" value="Search">
            </form>
            <!-- <?php
                    echo $answer;
                    ?> -->
        </main>
        <?php echo $footer; ?>

    </div>
</body>

</html>