/**
 * cript les mots de passe en SHA1
 * @param {string} str - le mot de passe
 */
function sha1(str) {
    return CryptoJS.SHA1(str).toString();
}
// variables qui contiennent les champs de mot de passe
var MotDePassesEtudiant = document.getElementById("MotDePasse_Etudiant");
var ConfirmerMotDePassesEtudiant = document.getElementById("Confirmer_MotDePasse_Etudiant");
var AncienMotDePassesEtudiant = document.getElementById("Ancien_MotDePasse_Etudiant");

/*
* Affiche les champs de modification du profil
* @param {HTMLElement} button - le bouton Modifier
    */
function toggleEditProfilEtudiant(button) {
    MotDePassesEtudiant.classList.remove("hide");
    ConfirmerMotDePassesEtudiant.classList.remove("hide");
    AncienMotDePassesEtudiant.classList.remove("hide");

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
    var niveauEtude = cells[8].innerHTML;
    var ecole = cells[10].innerHTML;
    var ville = cells[12].innerHTML;


    // Modifier les cellules pour afficher les champs de modification
    cells[0].innerHTML = "<input type='text' value='" + prenom + "'>";
    cells[2].innerHTML = "<input type='text' value='" + nom + "'>";
    cells[4].innerHTML = "<input type='text' value='" + nvemail + "'>";
    cells[6].innerHTML = "<input type='text' value='" + tel + "'>";
    cells[8].innerHTML = `
        <div class="radioniveauEtude">
            <input type="radio" id="L1" name="niveauEtude" value="L1" ${niveauEtude === 'L1' ? 'checked' : ''}><label for="L1">L1</label>
            <input type="radio" id="L2" name="niveauEtude" value="L2" ${niveauEtude === 'L2' ? 'checked' : ''}><label for="L2">L2</label>
            <input type="radio" id="L3" name="niveauEtude" value="L3" ${niveauEtude === 'L3' ? 'checked' : ''}><label for="L3">L3</label>
            <input type="radio" id="M1" name="niveauEtude" value="M1" ${niveauEtude === 'M1' ? 'checked' : ''}><label for="M1">M1</label>
            <input type="radio" id="M2" name="niveauEtude" value="M2" ${niveauEtude === 'M2' ? 'checked' : ''}><label for="M2">M2</label>
            <input type="radio" id="D" name="niveauEtude" value="D" ${niveauEtude === 'D' ? 'checked' : ''}><label for="D">D</label>
        </div>`;
    cells[10].innerHTML = "<input type='text' value='" + ecole + "'>";
    cells[12].innerHTML = "<input type='text' value='" + ville + "'>";
    cells[14].innerHTML = "<input type='password' value=''>";
    cells[16].innerHTML = "<input type='password' value=''>";
    cells[18].innerHTML = "<input type='password' value=''>";

    // Changer le texte du bouton Modifier en Envoyer
    button.innerHTML = "Envoyer";
   button.setAttribute("onclick", "validateProfilEtudiant(this,'" + email + "', '" + mdp + "')");

}
/*
* récupère les données du formulaire et les envoie à la page action/edit_a_profil.php
* @param {HTMLElement} button - le bouton Envoyer
* @param {string} email - l'email de l'utilisateur
*/
function sendDataProfilEtudiant(button, email) {


    var table = document.querySelector('table'); // Sélectionne la première table trouvée dans le document
    var cells = table.getElementsByTagName('td'); // Récupère tous les éléments <td> dans la table

    
    // Récupérer les nouvelles valeurs des champs de modification
    var prenom = cells[0].getElementsByTagName('input')[0].value;
    var nom = cells[2].getElementsByTagName('input')[0].value;
    var nvemail = cells[4].getElementsByTagName('input')[0].value;
    var tel = cells[6].getElementsByTagName('input')[0].value;
    var niveauEtudeInputs = cells[8].querySelectorAll('input[name="niveauEtude"]');
    var niveauEtudeValue = '';
    for (var i = 0; i < niveauEtudeInputs.length; i++) {
        if (niveauEtudeInputs[i].checked) {
            niveauEtudeValue = niveauEtudeInputs[i].value;
            break;
        }
    }
    var ecole = cells[10].getElementsByTagName('input')[0].value;
    var ville = cells[12].getElementsByTagName('input')[0].value;
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
            cells[8].innerHTML = niveauEtudeValue;
            cells[10].innerHTML = ecole;
            cells[12].innerHTML = ville;


            // Changer le texte du bouton Envoyer en Modifier
            button.innerHTML = "Modifier";
            button.setAttribute("onclick", "toggleEditProfilEtudiant(this)");

            MotDePassesEtudiant.classList.add("hide");
            ConfirmerMotDePassesEtudiant.classList.add("hide");
            AncienMotDePassesEtudiant.classList.add("hide");
            location.reload();

            document.getElementById("profil_id").classList.remove("smaller_profil");

        }
    };
    // xhttp.open("GET", "pages/modifierUtilisateur.php?email=" + email + "&prenom=" + prenom + "&nom=" + nom + "&type=" + type + "&numeroTel=" + numeroTel + "&niveau
    if (motDePasse != ConfirmerMotDePasse) {
        alert("Les mots de passe ne correspondent pas");
        return;
    }
    type = "Etudiant";
    typePage = "profil";
    xhttp.open("POST", "action/edit_a_profil.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email + "&prenomUtilisateur=" + prenom + "&nomUtilisateur=" + nom + "&type=" + type + "&nvemail=" + nvemail + "&numeroTel=" + tel + "&niveauEtude=" + niveauEtudeValue + "&ecole=" + ecole + "&ville=" + ville + "&motDePasse=" + motDePasse + "&AncienMotDePasse=" + AncienMotDePasse + "&typePage=" + typePage);
}
/*
* Vérifie que les champs du formulaire sont valides
* @param {HTMLElement} button - le bouton Envoyer
* @param {string} email - l'email de l'utilisateur
* @param {string} mdp - le mot de passe de l'utilisateur
*/
function validateProfilEtudiant(button, email2, mdp){


    var table = document.querySelector('table'); // Sélectionne la première table trouvée dans le document
    var cells = table.getElementsByTagName('td'); // Récupère tous les éléments <td> dans la table


    var prenom = cells[0].getElementsByTagName('input')[0].value;
    var nom = cells[2].getElementsByTagName('input')[0].value;
    var email = cells[4].getElementsByTagName('input')[0].value;
    var numeroTel = cells[6].getElementsByTagName('input')[0].value;
    var niveauEtudeInputs = cells[8].querySelectorAll('input[name="niveauEtude"]');
    var niveauEtudeValue = '';
    for (var i = 0; i < niveauEtudeInputs.length; i++) {
        if (niveauEtudeInputs[i].checked) {
            niveauEtudeValue = niveauEtudeInputs[i].value;
            break;
        }
    }
    var ecole = cells[10].getElementsByTagName('input')[0].value;
    var ville = cells[12].getElementsByTagName('input')[0].value;
    var AncienmotDePasse = sha1(cells[14].getElementsByTagName('input')[0].value);
    var motDePasse = sha1(cells[16].getElementsByTagName('input')[0].value);
    var confirmMotDePasse = sha1(cells[18].getElementsByTagName('input')[0].value);
    var valid = true;
if (!email) {
    document.getElementById("emailError").style.display = "block";
    valid = false;
} else if (email2 != email){
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

if (!niveauEtudeValue) {
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

if (AncienmotDePasse != mdp && motDePasse != "da39a3ee5e6b4b0d3255bfef95601890afd80709") {
    document.getElementById("ancienMotDePasseError").style.display = "block";
    valid = false;
} else {
    document.getElementById("ancienMotDePasseError").style.display = "none";
}


if (motDePasse != confirmMotDePasse) {
    document.getElementById("confirmMotDePasseError").style.display = "block";
    valid = false;
} else {
    document.getElementById("confirmMotDePasseError").style.display = "none";
}
if (valid == true) {
    sendDataProfilEtudiant(button, email2);
  }
return valid;

}
