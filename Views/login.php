<!DOCTYPE html>

<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="../Public/Css/loginTemp.css">
    <link rel="stylesheet" href="../Public/Css/loginForm.css">
    <script src="https://kit.fontawesome.com/953716a7e0.js" crossorigin="anonymous"></script>
</head>

<body>
<div class="mainContainer">
    <span class="mainLabel">Dołącz do drużyny i graj!</span>
    <div class="logoAndForm">
        <div class="logo">
            <img src="../Public/Images/ball.svg" alt="No photo">
            <span class="appName">MixBall</span>
        </div>
        <div class="form">
            <div class="text">
                <span class="login">Zaloguj się</span>
            </div>
            <form action="?page=login" method="POST">
                <span class="message" <?php if(isset($color)) echo "style='color:$color'"?>>
                    <?php
                        if (isset($messages)) {
                            echo $messages;
                        }
                    ?>
                </span>
                <span class="email">E-mail:</span>
                <input name="email" type="email" required>
                <span class="password">Hasło:</span>
                <input name="password" type="password" required>
                <button type="submit"><i class="fas fa-arrow-right"></i></button>
            </form>
            <span class="info">Nie masz jeszcze konta? <a href="?page=registration">Załóż je!</a></span>
        </div>
    </div>

    <div class="lowerGroup">
        <img class="leftPhoto" src="../Public/Images/man-user.svg" alt="No photo">
        <span class="leftText">Załóż konto</span>
        <img class="middlePhoto" src="../Public/Images/soccer.svg" alt="No photo">
        <span class="middleText">Zapisz się na mecz</span>
        <img class="rightPhoto" src="../Public/Images/football-player-attempting-to-kick-ball.svg" alt="No photo">
        <span class="rightText">Przyjeżdżaj i graj</span>
    </div>
</div>
</body>

</html>