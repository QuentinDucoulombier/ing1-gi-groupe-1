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
    xhr.open("POST", "/action/connexion.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var email = document.getElementById("email").value;
    var motDePasse = document.getElementById("motDePasse").value;
    alert(motDePasse);
    var data = "email=" + encodeURIComponent(email) + "&motDePasse=" + encodeURIComponent(motDePasse);
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

    xhr.open("POST", "/action/inscription.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var email = document.getElementById("email2").value;
    var prenomUtilisateur = document.getElementById("prenomUtilisateur").value;
    var nomUtilisateur = document.getElementById("nomUtilisateur").value;
    var numeroTel = document.getElementById("numeroTel").value;
    var niveauEtude = document.getElementById("niveauEtude").value;
    var ecole = document.getElementById("ecole").value;
    var ville = document.getElementById("ville").value;
    var motDePasse = document.getElementById("motDePasse2").value;
    var confirm_motDePasse = document.getElementById("confirm_motDePasse").value;
    // afficher les valeurs

    if (motDePasse === confirm_motDePasse) {
        var data = "email=" + encodeURIComponent(email) + "&prenomUtilisateur=" + encodeURIComponent(prenomUtilisateur) + "&nomUtilisateur=" + encodeURIComponent(nomUtilisateur) + "&numeroTel=" + encodeURIComponent(numeroTel) + "&niveauEtude=" + encodeURIComponent(niveauEtude) + "&ecole=" + encodeURIComponent(ecole) + "&ville=" + encodeURIComponent(ville) + "&motDePasse=" + encodeURIComponent(motDePasse) + "&confirm_motDePasse=" + encodeURIComponent(confirm_motDePasse);
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
    xhr.open("GET", "/action/deconnexion.php", true);
    xhr.send();
}