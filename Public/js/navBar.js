function showNavBar() {
    var x = document.getElementById("navBar");
    if (x.className === "navBar") {
        x.className += "Show";
    }
    else {
        x.className = "navBar";
    }
}