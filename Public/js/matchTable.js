function select() {
    var table = document.getElementById("table");

    for(var i = 1; i < table.rows.length; i++)
    {
        table.rows[i].onclick = function () {
            $("tr").css("background", "none");
            $(this).css("background", "#919191");
            document.getElementById("joinButton").disabled = false;
            document.getElementById("detailButton").disabled = false;
        }
    }
}

$(document).ready((fun) => select());

function getMatches() {
    const apiUrl = "http://localhost:1083";
    const $list = $(".matchesList");

    $.ajax({
        url: apiUrl + "/?page=matches_refresh",
        dataType: "json"
    })

    .done((res) => {
        $list.empty();

        document.getElementById("joinButton").disabled = true;
        document.getElementById("detailButton").disabled = true;
        $(document).ready((fun) => select());

        res.forEach(el => {
            if ((el.number) == null) {
                el.number = "";
            }
            $list.append(`<tr>
                        <td class="id">${el.id_match}</td>
                        <td class="city">${el.city}</td>
                        <td class="address">${el.street} ${el.number}</td>
                        <td class="date">${el.date} ${el.time}</td>
                        <td class="players">${el.numberOfPlayers}/${el.players}</td>
                        
                        </tr>`);
        });
        console.log($list);
    });
}

function joinTeam() {

    if (!confirm("Chcesz dołączyć do spotkania?")) {
        return;
    }

    const apiUrl = "http://localhost:1083";
    var id;

    var table = document.getElementById("table");
    for(var i = 1; i < table.rows.length; i++)
    {
        if (table.rows[i].style.background !== "none") {
            id = table.rows[i].cells[0].innerHTML;
        }
    }

    $.ajax({
        url: apiUrl + "/?page=add_to_match",
        method: "POST",
        data: {
            id : id
        },
        success: function () {
            alert("Udało się dołączyć do spotkania");
            getMatches();
        },
        error: function () {
            alert("Już dołączyłeś do tego spotkania");
            getMatches();
        }
    });
}

function showDetails() {
    const apiUrl = "http://localhost:1083";
    const $matchDetails = $(".matchDetails");
    const $playersList = $(".playersList");

    $matchDetails.empty();
    $playersList.empty();
    var id;
    var table = document.getElementById("table");
    for(var i = 1; i < table.rows.length; i++)
    {
        if (table.rows[i].style.background !== "none") {
            id = table.rows[i].cells[0].innerHTML;
            console.log(id);
        }
    }

    $.ajax({
        url: apiUrl + "/?page=match_details",
        dataType: "json",
        method: "POST",
        data: {
            id : id
        }
    })

    .done((match) => {
        for (var i = 0; i < match.players; i++) {
            if (match[i] != null) {
                $playersList.append(`<span>${match[i].name} ${match[i].surname}</span><br>`)
            }
        }
        $matchDetails.append(`<span>Id: ${match.id_match}</span><br>
                            <span>Adres: ${match.street} ${match.number}</span><br>
                            <span>Miasto: ${match.city}</span><br>
                            <span>Data: ${match.date}</span><br>
                            <span>Godzina: ${match.time}</span><br>
                            <span>Liczba osób: ${match.numberOfPlayers}/${match.players}</span><br>
                            <span>Zapisane osoby:</span><br>`)
    });
}

function showProfile(id) {

}