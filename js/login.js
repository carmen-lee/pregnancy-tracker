
var usernameField = document.getElementById("username");
var passwordField = document.getElementById("password");
var loginBtn = document.getElementById("loginBtn");


let accounts = {
    "john" : "pass",
}

console.log(document.cookie);
checkLoggedIn();

function checkLoggedIn() {
    if (document.cookie.split("=")[1] != "" && document.cookie.split("=")[1] != undefined) {
        // window.location.replace("home.html");
        // console.log(document.cookie)
    }
}

function validateFields() {
    // console.log(usernameField.value);
    // console.log(passwordField.value);
    if (usernameField.value.trim() == "" || passwordField.value.trim() == "") {
        alert("Please enter your Username/Password");
    } 
    else {
        validateUser();
    }
}

function validateUser() {
    console.log("validating user");
    if (accounts[usernameField.value] === passwordField.value) {
            // store cookie
            document.cookie = "user = " + usernameField.value;
            console.log(document.cookie)

            $.post('./php/connect.php', { num: 5 }, function(result) { 
                alert(result); 
             });
            // redirect
            window.location.replace("home.html");
        }
    else {
        alert("Incorrect login. Try again.");
        return;
    }
}

loginBtn.addEventListener("click", function() {
    console.log("login btn clicked");
    validateFields();
})



