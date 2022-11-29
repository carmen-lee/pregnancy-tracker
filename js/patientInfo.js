
var welcomeLabel = document.getElementById("home-welcomeLabel");
var logoutBtn = document.getElementById("logoutBtn");

console.log(document.cookie);

function checkCookie() {
    var user = document.cookie.split("=")[1];
    user = user.split(";")[0]; // bug with cookie
    if (user == '' || user == undefined) {
        alert("Please login");
        window.location.replace("login.html");
    }
    else {
        welcomeLabel.innerHTML = "Welcome Back, " + user;
    }
}

checkCookie();

logoutBtn.addEventListener("click", function() {
    console.log("logout button clicked");
    //erase username cookie
    document.cookie = "user="

    // console.log("clicked");
    window.location.replace("login.html");

})