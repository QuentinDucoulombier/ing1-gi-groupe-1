// Get the modal
var modal = document.getElementById("loginModal");

// Get the modal
var modal2 = document.getElementById("loginModal2");

function openLoginModal() {
    modal.style.display = "block";
}

function openLoginModal2() {
    modal2.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
function closeLoginModal() {
    modal.style.display = "none";
}

// When the user clicks on <span> (x), close the modal
function closeLoginModal2() {
    modal2.style.display = "none";
}

// AJAX login function
function login() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Handle successful login
            var response = this.responseText;
            if (response == "success") {
                closeLoginModal();
                location.reload();

            } else {
                alert("Utilisateur ou mot de passe invalide.");
            }
        }
    };
    xhr.open("POST", "/php/connexion.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var data = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);
    xhr.send(data);
}
function inscrire() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Handle successful login
            var response = this.responseText;
            if (response == "success") {
                closeLoginModal2();
                alert("inscription Validée");
            } else if (response == "utilise") {
                alert("Utilisateur deja pris");
            } else {
                alert("Inscription non validée");
            }
        }
    };

    xhr.open("POST", "/php/inscription.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var username2 = document.getElementById("username2").value;
    var password2 = document.getElementById("password2").value;
    var confirm_password = document.getElementById("confirm_password").value;

    if (password2 === confirm_password) {
        var data = "username2=" + encodeURIComponent(username2) + "&password2=" + encodeURIComponent(password2) + "&confirm_password=" + encodeURIComponent(confirm_password);
        xhr.send(data);
    } else {
        alert("Les mots de passe ne correspondent pas.");
    }
}

function deconnexion() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Handle successful logout
            var response = this.responseText;
            if (response == "success") {
                location.reload(); // Reload the page to clear the session
            } else {
                alert("Erreur lors de la déconnexion.");
            }
        }
    };
    xhr.open("GET", "/php/deconnexion.php", true);
    xhr.send();
}