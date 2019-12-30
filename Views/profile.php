<!DOCTYPE html>

<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="../Public/Css/style.css">
    <link rel="stylesheet" href="../Public/Css/profile.css">
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
    <form action="?page=profile" method="POST">
        <div class="profilePhoto">
            <i class="fas fa-portrait"></i>
            <input type="file" name="avatar"  class="choosePic" accept="image/png, image/jpg">
        </div>
        <div class="infoContainer">
            <div class="leftSide">

                <span>Imię</span>
                <input type="text" name="name" value="<?php
                    if (isset($name)) {
                        print $name;
                    } ?>">
                <span>Nazwisko</span>
                <input type="text" name="surname" value="<?php
                    if (isset($surname)) {
                        print $surname;
                    } ?>">
                <span>Wiek</span>
                <input type="number" name="age" value="<?php
                    if (isset($age)) {
                        print $age;
                    } ?>">
            </div>
            <div class="rightSide">
                <span>Lepsza noga</span>
                <select name="leg">
                    <option <?php if(isset($leg) && $leg == 'Prawa') echo 'selected' ?> value="Prawa">Prawa</option>
                    <option <?php if(isset($leg) && $leg == 'Lewa') echo 'selected' ?> value="Lewa">Lewa</option>
                    <option <?php if(isset($leg) && $leg == 'Obunożny') echo 'selected' ?> value="Obunożny">Obunożny</option>
                </select>
                <span>Ulubiony klub</span>
                <input type="text" name="club" value="<?php
                    if (isset($club)) {
                        print $club;
                    } ?>">
                <span >Dodatkowy opis</span>
                <textarea name="description" datatype="text" class="description" maxlength="400"><?php
                    if (isset($description)) {
                        print $description;
                    } ?>
                </textarea>
            </div>
        </div>
        <div class="saveButton">
            <button type="submit"><span>Zapisz</span></button>
        </div>
    </form>
</div>

<div class="footer">
    <a href="home.php">Strona główna</a>
    <a href="">Kontakt</a>
    <a href="">O aplikacji</a>
    <i class="fas fa-arrow-up" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"></i>
</div>

</body>