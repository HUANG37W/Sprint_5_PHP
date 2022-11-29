<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css">
</head>
<body>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
?>
    <div class="container"> </div>
<main id="home_page">
    <section id="home_page-top">
        <section id="home_page-top-welcome_message">
            <h1>Welome to PHP Motors</h1>
            <section id="home_page-top-welcome_message-blue_part">
                <h2>DMC Delorean</h2>
                <p>3 cup holders
                    Supperman doors
                    Fuzzy dice!</p>
            </section>
        </section>
        <img id="home_page-top-img" src="../images/bird.jpg" alt="Bird">
        <button id="home_page-top-welcome_message-button">Own Today</button>
    </section>
    <section id="home_page-bottom">
        <section id="home_page-bottom-first">
            <h2>DMC Delorean Reviews</h2>
            <ul id="home_page-bottom-first-ul">
                <li>"So fast its almost like traveling in time." (4/5)</li>

                <li>"Coolest ride on the road." (4/5)</li>
                <li>"I'm feeling Marry McFly!" (5/5)</li>
                <li>"The most futuristic ride of our day." (4.5/5)</li>
                <li>"80's livin and I love it!" (5/5)</li>
            </ul>
        </section>
        <section id="home_page-bottom-second">
            <h2>Delorean Upgrades</h2>
            <section id="home_page-bottom-second-boxes">
                <div>
                    <img src="images/upgrades/flux-cap.png" alt="Flux Cap">
                    <a href="#">Flux Capacitor</a>
                </div>
                <div>
                    <img src="images/upgrades/flame.jpg" alt="Flame">
                    <a href="#">Flame Decals</a>
                </div>
                <div>
                    <img src="images/upgrades/bumper_sticker.jpg" alt="Bumper Sticker">
                    <a href="#">Bumper Stickers</a>
                </div>
                <div>
                    <img src="images/upgrades/hub-cap.jpg" alt="Hub Cap">
                    <a href="#">Hub Caps</a>
                </div>
            </section>
        </section>
    </section>

</main>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
?>   
</body>
</html>
