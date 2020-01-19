<!DOCTYPE html>

<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stwórz mecz</title>
    <link rel="stylesheet" href="../Public/Css/style.css">
    <link rel="stylesheet" href="../Public/Css/createMatch.css">
    <script src="https://kit.fontawesome.com/953716a7e0.js" crossorigin="anonymous"></script>
    <script src="../Public/js/navBar.js"></script>
</head>

<body>
<header class="header">
    <img class="logo" src="../Public/Images/ball.svg" alt="No photo">
    <span class="mixBall">MixBall</span>
    <button class="menuTrigger" onclick="showNavBar()"><i class="fas fa-bars"></i></button>
    <nav id="navBar" class="navBar">
        <ul>
            <li><a href="?page=home">Strona główna</a></li>
            <li><a href="?page=matches">Mecze</a></li>
            <li><a href="?page=referees">Sędziowie</a></li>
            <li><a href="">Twoje mecze</a></li>
            <li class="gallery"><a href="">Galeria</a></li>
            <li class="about"><a href="">O aplikacji</a></li>
            <li class="profileIcon"><a href="?page=profile"><img class="icon" src="../Public/Images/profile.svg" alt="No photo"></a></li>
            <li class="logOut"><a href="?page=logout">Wyloguj</a></li>
        </ul>
    </nav>
</header>

<div class="mainContainer">
    <div class="mainLabel">
        <span>Stwórz mecz!</span>
    </div>
    <div class="formAndPic">
        <form action="?page=create_match" method="POST">
            <div class="matchForm">
                <span>Ulica:</span>
                <input type="text" name="street">
                <span>Numer:</span>
                <input id="num" type="number" name="number">
                <span>*Miasto:</span>
                <input type="text" name="city" required>
                <span>*Data:</span>
                <input type="date" name="date" required>
                <span>*Godzina:</span>
                <input type="time" name="time" required>
                <span>*Liczba zawodników:</span>
                <input type="number" name="players" required>
                <span>Sędzia:</span>
                <select name="referees">
                    <option value="Brak">Brak</option>
                    <?php foreach ($referees as $referee): ?>
                        <option value="<?= $referee['name'].' ', $referee['surname']?>"><?= $referee['name'].' ', $referee['surname']?></option>
                    <?php endforeach ?>
                </select>
                <i class="info">* - pole jest wymagane</i>
                <button type="submit">Utwórz</button>
            </div>
        </form>
        <div class="picture">
            <img src="../Public/Images/football.svg">
        </div>
    </div>
</div>

<div class="footer">
    <a href="?page=home">Strona główna</a>
    <a href="?page=contact">Kontakt</a>
    <a href="">O aplikacji</a>
    <i class="fas fa-arrow-up" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"></i>
</div>
</body>

</html>