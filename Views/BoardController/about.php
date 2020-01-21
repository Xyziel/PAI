<!DOCTYPE html>

<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O nas</title>
    <link rel="stylesheet" href="../../Public/Css/style.css">
    <link rel="stylesheet" href="../../Public/Css/about.css">
    <script src="https://kit.fontawesome.com/953716a7e0.js" crossorigin="anonymous"></script>
    <script src="../../Public/js/navBar.js"></script>
</head>

<body>
<header class="header">
    <img class="logo" src="../../Public/Images/ball.svg" alt="No photo">
    <span class="mixBall">MixBall</span>
    <button class="menuTrigger" onclick="showNavBar()"><i class="fas fa-bars"></i></button>
    <nav id="navBar" class="navBar">
        <ul>
            <li><a href="?page=home">Strona główna</a></li>
            <li><a href="?page=matches">Mecze</a></li>
            <li><a href="?page=referees">Sędziowie</a></li>
            <li><a href="">Twoje mecze</a></li>
            <li class="gallery"><a href="">Galeria</a></li>
            <li class="about"><a href="?page=about">O aplikacji</a></li>
            <li class="profileIcon"><a href="?page=profile"><img class="icon" src="../../Public/Images/profile.svg" alt="No photo"></a></li>
            <li class="logOut"><a href="?page=logout">Wyloguj</a></li>
        </ul>
    </nav>
</header>

<div class="mainContainer">
    <div class="info">
        <span id="label">O nas...</span><br>
        <span id="about">Aplikacja MixBall powstała z myślą o ludziach lubiących spędzać czas aktywnie, którzy z chęcią podejmą nowe wyzwanie.
                        Apliakcja pozwala na stworzenie meczu w dowolnym miejcu w Polsce, do którego mogą dołączać inni.
                        Możliwe jest również zaproszenie sędziego do spotkania. Drodzy użytkownicy proszę pamiętać,
                        że aplikacja jedynie pomaga zebrać drużynę, ale nie jest odpowiedzialna za przybycie konkretnych osób na spotkanie.</span>
        <span id="question">Jeśli masz jakieś pytanie:</span>
        <a href="?page=contact"><button id="queButton" type="button">Kliknij</button></a>
    </div>
</div>

<div class="footer">
    <a href="?page=home">Strona główna</a>
    <a href="?page=contact">Kontakt</a>
    <a href="?page=about">O aplikacji</a>
    <i class="fas fa-arrow-up" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"></i>
</div>

</body>

</html>