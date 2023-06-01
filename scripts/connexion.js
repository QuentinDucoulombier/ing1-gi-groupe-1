

document.getElementById("modifierForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Empêche l'envoi du formulaire

    // Récupérer les valeurs des champs
    var email = document.getElementById("email").value;
    var motDePasse = document.getElementById("motDePasse").value;

    // Réinitialiser les messages d'erreur
    document.getElementById("emailError").style.display = "none";
    document.getElementById("motDePasseError").style.display = "none";

    // Effectuer une requête AJAX vers le script PHP
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../action/verif_login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = this.responseText;
                if (response == "success") {
                    // Connexion réussie, rediriger vers la page accueil
                    window.location.href = "/?page=accueil";

                } else {
                    // Afficher les messages d'erreur
                    if (response == "error") {
                        document.getElementById("emailError").textContent = "Email ou mot de passe incorrect.";
                        document.getElementById("emailError").style.display = "block";
                    }
                }
            } else {
                // Afficher un message d'erreur générique
                console.log("Erreur lors de la requête AJAX : " + xhr.status);
            }
        }
    };

    // Envoyer les données du formulaire au script PHP
    var data = "email=" + encodeURIComponent(email) + "&motDePasse=" + encodeURIComponent(motDePasse);
    xhr.send(data);
});
