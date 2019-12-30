<!DOCTYPE html>

<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="../Public/Css/style.css">
    <link rel="stylesheet" href="../Public/Css/home.css">
    <script src="https://kit.fontawesome.com/953716a7e0.js" crossorigin="anonymous"></script>
    <script>
        function showNavBar() {
            var x = document.getElementById("navBar");
            if (x.className === "navBar") {
                x.className += "Show";
            }
            else {
                x.className = "navBar";
            }
        }
    </script>
</head>

<body>
<header>
    <img src="../Public/Images/ball.svg" alt="No photo">
    <span class="mixBall">MixBall</span>
    <button class="menuTrigger" onclick="showNavBar()"><i class="fas fa-bars"></i></button>
    <nav id="navBar" class="navBar">
        <ul>
            <li><a href="home.php">Strona główna</a></li>
            <li><a href="">Mecze</a></li>
            <li><a href="">Sędziowie</a></li>
            <li><a href="">Twoje mecze</a></li>
            <li class="gallery"><a href="">Galeria</a></li>
            <li class="about"><a href="">O aplikacji</a></li>
            <li class="profileIcon"><a href="?page=profile"><img class="icon" src="../Public/Images/profile.svg" alt="No photo"></a></li>
            <li class="logOut"><a href="?page=logout">Wyloguj</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="textAndButton">
        <span class="text">Poczuj się jak gwiazdy światowej piłki<br>i zagraj swój własny mecz!</span>
        <button class="button">Dołącz już teraz!</button>

    </div>
</div>

<div class="footer">
    <a href="home.php">Strona główna</a>
    <a href="">Kontakt</a>
    <a href="">O aplikacji</a>
    <i class="fas fa-arrow-up" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"></i>
</div>

</body>

</html>