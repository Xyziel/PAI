<!DOCTYPE html>

<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../../Public/Css/style.css">
    <link rel="stylesheet" href="../../Public/Css/adminPanel.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/953716a7e0.js" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="../../Public/js/navBar.js"></script>
    <script src="../../Public/js/adminPanel.js"></script>
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
    <button type="submit" onclick="getUsers()">Lista użytkowników</button>

    <div class="tableScroll table-wrapper-scroll-y">
        <table class="table table-striped table-dark table-bordered" id="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>ID_USER_DETAILS</th>
                <th>EMAIL</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody class="list">
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id_user']?></td>
                    <td><?= ($user['id_user_details'] == null) ? 'null' : $user['id_user_details']?></td>
                    <td><?= $user['email']?></td>
                    <td><button type="button" id="deleteButton" onclick="deleteUser(<?= $user['id_user']?>)"><i class="fas fa-trash"></i></button></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
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