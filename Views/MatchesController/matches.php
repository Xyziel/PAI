<!DOCTYPE html>

<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mecze</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Public/Css/style.css">
    <link rel="stylesheet" href="../../Public/Css/matches.css">
    <script src="https://kit.fontawesome.com/953716a7e0.js" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="../../Public/js/matchTable.js"></script>
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
    <div class="infoContainer">
        <div class="leftSide">
            <span class="tableSpan">Poszukaj meczy w Twojej okolicy</span>
            <div class="tableScroll table-wrapper-scroll-y">
                <table class="table table-dark table-bordered" id="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="hCity">Miasto</th>
                        <th class="hAddress">Ulica</th>
                        <th>Data</th>
                        <th>Liczba osób</th>
                    </tr>
                    </thead>
                    <tbody class="matchesList">
                    <?php foreach ($matches as $match): ?>
                        <tr>
                            <td class="id"><?= $match['id_match']?></td>
                            <td class="city"><?= $match['city'] ?></td>
                            <td class="address"><?= $match['street']." ".$match['number'] ?></td>
                            <td class="date"><?= $match['date']." ".$match['time'] ?></td>
                            <td class="players"><?= $match['numberOfPlayers'].'/'.$match['players'] ?></td>

                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="buttons">
                <button class="btn btn-secondary" type="submit" onclick="getMatches()">Odśwież</button>
                <button class="btn btn-secondary" id="joinButton" type="submit" onclick="joinTeam()" disabled>Dołącz</button>
                <button class="btn btn-secondary" id="detailButton" type="button" data-toggle="modal" data-target="#myModal" onclick="showDetails()" disabled>Szczegóły</button>
            </div>
        </div>
        <div class="rightSide">
            <span>Chcesz stworzyć mecz i grać na własnych zasadach?</span>
            <i class="fas fa-arrow-down"></i>
            <a href="?page=create_match"><button type="submit">Stwórz mecz!</button></a>
        </div>
    </div>
</div>

<!--Modal-->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Szczegóły meczu:</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="matchDetails">

                </div>
                <div class="playersList">

                </div>
            </div>
        </div>
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