function sha1(str) {
    return CryptoJS.SHA1(str).toString();
}
var MotDePassesgestionnaire = document.getElementById("MotDePasse_Gestionnaire");
var ConfirmerMotDePassesgestionnaire = document.getElementById("Confirmer_MotDePasse_Gestionnaire");
var AncienMotDePassesgestionnaire = document.getElementById("Ancien_MotDePasse_Gestionnaire");

function toggleEditProfilGestionnaire(button) {
    MotDePassesgestionnaire.classList.remove("hide");
    ConfirmerMotDePassesgestionnaire.classList.remove("hide");
    AncienMotDePassesgestionnaire.classList.remove("hide");
    document.getElementById("profil_id").classList.add("smaller_profil");

    var email = button.getAttribute('data-email');
    var mdp = button.getAttribute('data-mdp');

    var table = document.querySelector('table'); // Sélectionne la première table trouvée dans le document
    var cells = table.getElementsByTagName('td'); // Récupère tous les éléments <td> dans la table

    // Récupérer les valeurs actuelles des cellules
    var prenom = cells[0].innerHTML;
    var nom = cells[2].innerHTML;
    var nvemail = cells[4].innerHTML;
    var tel = cells[6].innerHTML;
    var nomEntreprise = cells[8].innerHTML;
    var dateDebutUtilisateur = cells[10].innerHTML;
    var dateFinUtilisateur = cells[12].innerHTML;


    // Modifier les cellules pour afficher les champs de modification
    cells[0].innerHTML = "<input type='text' value='" + prenom + "'>";
    cells[2].innerHTML = "<input type='text' value='" + nom + "'>";
    cells[4].innerHTML = "<input type='text' value='" + nvemail + "'>";
    cells[6].innerHTML = "<input type='text' value='" + tel + "'>";
    cells[8].innerHTML = "<input type='text' value='" + nomEntreprise + "'>";
    cells[10].innerHTML = "<input type='date' value='" + dateDebutUtilisateur + "'>";
    cells[12].innerHTML = "<input type='date' value='" + dateFinUtilisateur + "'>";
    cells[14].innerHTML = "<input type='password' value=''>";
    cells[16].innerHTML = "<input type='password' value=''>";
    cells[18].innerHTML = "<input type='password' value=''>";

    // Changer le texte du bouton Modifier en Envoyer
    button.innerHTML = "Envoyer";
    button.setAttribute("onclick", "validateProfilGestionnaire(this, '" + email + "', '" + mdp + "')");
}



function sendDataProfilGestionnaire(button, email) {


    var table = document.querySelector('table'); // Sélectionne la première table trouvée dans le document
    var cells = table.getElementsByTagName('td'); // Récupère tous les éléments <td> dans la table


    // Récupérer les nouvelles valeurs des champs de modification
    var prenom = cells[0].getElementsByTagName('input')[0].value;
    var nom = cells[2].getElementsByTagName('input')[0].value;
    var nvemail = cells[4].getElementsByTagName('input')[0].value;
    var tel = cells[6].getElementsByTagName('input')[0].value;
    var nomEntreprise = cells[8].getElementsByTagName('input')[0].value;
    var dateDebutUtilisateur = cells[10].getElementsByTagName('input')[0].value;
    var dateFinUtilisateur = cells[12].getElementsByTagName('input')[0].value;
    var AncienMotDePasse = sha1(cells[14].getElementsByTagName('input')[0].value);
    var motDePasse = sha1(cells[16].getElementsByTagName('input')[0].value);
    var ConfirmerMotDePasse = sha1(cells[18].getElementsByTagName('input')[0].value);

    // Envoyer les données à une page PHP pour effectuer la mise à jour
    // Utilisez AJAX ou un formulaire pour soumettre les données à la page PHP
    // Exemple avec AJAX :
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            // Mettre à jour les cellules avec les nouvelles valeurs
            cells[0].innerHTML = prenom;
            cells[2].innerHTML = nom;
            cells[4].innerHTML = nvemail;
            cells[6].innerHTML = tel;
            cells[8].innerHTML = nomEntreprise;
            cells[10].innerHTML = dateDebutUtilisateur;
            cells[12].innerHTML = dateFinUtilisateur;

            // Changer le texte du bouton Envoyer en Modifier
            button.innerHTML = "Modifier";
            button.setAttribute("onclick", "toggleEditProfilGestionnaire(this)");
            MotDePassesgestionnaire.classList.add("hide");
            ConfirmerMotDePassesgestionnaire.classList.add("hide");
            AncienMotDePassesgestionnaire.classList.add("hide");
            document.getElementById("profil_id").classList.remove("smaller_profil");
            //location.reload();
            
        }
    };
    // xhttp.open("GET", "pages/modifierUtilisateur.php?email=" + email + "&prenom=" + prenom + "&nom=" + nom + "&type=" + type + "&numeroTel=" + numeroTel + "&niveau
    if (motDePasse != ConfirmerMotDePasse) {
        alert("Les mots de passe ne correspondent pas");
        return;
    }
    type = "Gestionnaire";
    typePage = "profil";
    xhttp.open("POST", "action/edit_a_profil.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email + "&prenomUtilisateur=" + prenom + "&nomUtilisateur=" + nom + "&nvemail=" + nvemail + "&type=" + type + "&numeroTel=" + tel + "&nomEntreprise=" + nomEntreprise + "&dateDebutUtilisateur=" + dateDebutUtilisateur + "&dateFinUtilisateur=" + dateFinUtilisateur + "&motDePasse=" + motDePasse + "&AncienMotDePasse=" + AncienMotDePasse + "&typePage=" + typePage);

}

function validateProfilGestionnaire(button, email2, mdp) {

    var table = document.querySelector('table'); // Sélectionne la première table trouvée dans le document
    var cells = table.getElementsByTagName('td'); // Récupère tous les éléments <td> dans la table

    // Récupérer les nouvelles valeurs des champs de modification
    var prenom = cells[0].getElementsByTagName('input')[0].value;
    var nom = cells[2].getElementsByTagName('input')[0].value;
    var email = cells[4].getElementsByTagName('input')[0].value;
    var numeroTel = cells[6].getElementsByTagName('input')[0].value;
    var nomEntreprise = cells[8].getElementsByTagName('input')[0].value;
    var dateDebutUtilisateur = cells[10].getElementsByTagName('input')[0].value;
    var dateFinUtilisateur = cells[12].getElementsByTagName('input')[0].value;
    var AncienMotDePasse = sha1(cells[14].getElementsByTagName('input')[0].value);
    var motDePasse = sha1(cells[16].getElementsByTagName('input')[0].value);
    var ConfirmerMotDePasse = sha1(cells[18].getElementsByTagName('input')[0].value);

    var valid = true;

    if (!prenom) { 
        document.getElementById("prenomError").style.display = "block";
        valid = false;
    }
    else {
        document.getElementById("prenomError").style.display = "none";
    }

    if (!nom) {
        document.getElementById("nomError").style.display = "block";
        valid = false;
    }
    else {
        document.getElementById("nomError").style.display = "none";
    }

    if (!email) {
        document.getElementById("emailError").style.display = "block";
        valid = false;
    } else if (email2 != email){
        document.getElementById("emailError").style.display = "none";
        // Vérification du mail via une requête AJAX
        checkEmailExists(email);
    }
    else {
        document.getElementById("emailError").style.display = "none";
    }

  
    if (!numeroTel || numeroTel.length !== 10 || isNaN(numeroTel)) {
        document.getElementById("numeroTelError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("numeroTelError").style.display = "none";
    }

    if (!nomEntreprise) {
        document.getElementById("nomEntrepriseError").style.display = "block";
        valid = false;
    }
    else {
        document.getElementById("nomEntrepriseError").style.display = "none";
    }

    if (!dateDebutUtilisateur) {
        document.getElementById("dateDebutError").style.display = "block";
        valid = false;
    }
    else {
        document.getElementById("dateDebutError").style.display = "none";
    }

    if (!dateFinUtilisateur) {
        document.getElementById("dateFinError").style.display = "block";
        valid = false;
    }
    else {
        document.getElementById("dateFinError").style.display = "none";
    }

    if (AncienMotDePasse != mdp && motDePasse != "da39a3ee5e6b4b0d3255bfef95601890afd80709") {
        document.getElementById("ancienMotDePasseError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("ancienMotDePasseError").style.display = "none";
    }
    
    
    if (motDePasse != ConfirmerMotDePasse) {
        document.getElementById("confirmMotDePasseError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("confirmMotDePasseError").style.display = "none";
    }
    if (valid == true) {
        sendDataProfilGestionnaire(button, email2);
      }
    return valid;
    
    }