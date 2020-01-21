<!DOCTYPE html>

<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt</title>
    <link rel="stylesheet" href="../../Public/Css/style.css">
    <link rel="stylesheet" href="../../Public/Css/contact.css">
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
            <li><a href="">Sędziowie</a></li>
            <li><a href="">Twoje mecze</a></li>
            <li class="gallery"><a href="">Galeria</a></li>
            <li class="about"><a href="?page=about">O aplikacji</a></li>
            <li class="profileIcon"><a href="?page=profile"><img class="icon" src="../../Public/Images/profile.svg" alt="No photo"></a></li>
            <li class="logOut"><a href="?page=logout">Wyloguj</a></li>
        </ul>
    </nav>
</header>

<div class="mainContainer">
    <div class="labels">
        <span id="stmtUp">Masz pytanie?</span><br><br>
        <span id="stmtDown">Wyślij wiadomość, a my postaramy się odpowiedzieć tak szybko jak to tylko możliwe</span>
    </div>
    <div class="contAndForm">
        <div id="cont">
            <span id="contact">Kontakt:</span>
            <span id="email">mixballcompany@gmail.com</span>
        </div>
        <form action="?page=send_email" method="POST">
            <div id="form">
                <span id="topic">Temat:</span>
                <input type="text" name="subject">
                <span>Twoja wiadomość:</span>
                <textarea id="message" name="message" datatype="text"></textarea>
                <button id="sendButton" type="submit">Wyślij</button>
            </div>
        </form>
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