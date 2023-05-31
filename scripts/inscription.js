

function validateForm() {
    var email = document.getElementById("email").value;
    var prenom = document.getElementById("prenomUtilisateur").value;
    var nom = document.getElementById("nomUtilisateur").value;
    var numeroTel = document.getElementById("numeroTel").value;
    var niveauEtude = document.querySelector('input[name="niveauEtude"]:checked');
    var ecole = document.getElementById("ecole").value;
    var ville = document.getElementById("ville").value;
    var motDePasse = document.getElementById("motDePasse").value;
    var confirmMotDePasse = document.getElementById("confirm_motDePasse").value;

    var valid = true;

    if (!email) {
        document.getElementById("emailError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("emailError").style.display = "none";
        // Vérification du mail via une requête AJAX
        checkEmailExists(email);
    }

    if (!prenom) {
        document.getElementById("prenomError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("prenomError").style.display = "none";
    }

    if (!nom) {
        document.getElementById("nomError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("nomError").style.display = "none";
    }

    if (!numeroTel || numeroTel.length !== 10 || isNaN(numeroTel)) {
        document.getElementById("numeroTelError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("numeroTelError").style.display = "none";
    }

    if (!niveauEtude) {
        document.getElementById("niveauEtudeError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("niveauEtudeError").style.display = "none";
    }

    if (!ecole) {
        document.getElementById("ecoleError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("ecoleError").style.display = "none";
    }

    if (!ville) {
        document.getElementById("villeError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("villeError").style.display = "none";
    }

    if (!motDePasse) {
        document.getElementById("motDePasseError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("motDePasseError").style.display = "none";
    }

    if (motDePasse !== confirmMotDePasse) {
        document.getElementById("confirmMotDePasseError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("confirmMotDePasseError").style.display = "none";
    }

    return valid;
}
function checkEmailExists(email) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) {
                var response = this.responseText;
                if (response == "1") {
                    document.getElementById("emailError").innerHTML = "L'e-mail existe déjà dans la base de données.";
                    document.getElementById("emailError").style.display = "block";
                } else {
                    document.getElementById("emailError").style.display = "none";
                }
            } else {
                console.error("Une erreur s'est produite lors de la vérification de l'e-mail.");
                alert("Une erreur s'est produite lors de la vérification de l'e-mail.");
            }
        }
    };

    request.open("POST", "action/check_mail.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("email=" + encodeURIComponent(email));
}