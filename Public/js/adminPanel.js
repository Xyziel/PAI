function getUsers() {
    const apiUrl = "http://localhost:1083";
    const $list = $(".list");

    $.ajax({
        url: apiUrl + "/?page=admin_get_users",
        dataType: "json"
    })

    .done((res) => {
        $list.empty();
        res.forEach(el => {
            $list.append(`<tr>
                         <td>${el.id_user}</td>
                         <td>${el.id_user_details}</td>
                         <td>${el.email}</td>
                         <td><button id="deleteButton" onclick="deleteUser(${el.id_user})"><i class="fas fa-trash"></i></button></td>
                         </tr>`);
        })
    });

}

function deleteUser(id) {
    if (!confirm("Czy chcesz usunąć tego użytkownika?")) {
        return;
    }

    const apiUrl = "http://localhost:1083";

    $.ajax({
        url : apiUrl + '/?page=admin_delete_user',
        method : "POST",
        data : {
            id : id
        },
        success: function() {
            alert('Użytkownik został usunięty!');
            getUsers();
        }
    })
}

