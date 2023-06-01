/*
* cript le mot de passe en SHA1
* @param {string} str - le mot de passe
*/
function sha1(str) {
    return CryptoJS.SHA1(str).toString();
}
/*
* Affiche les champs de modification du profil
* @param {HTMLElement} button - le bouton Modifier
*/
function toggleEditEtudiant(button) {
    var email = button.getAttribute('data-email');
    var row = button.parentNode.parentNode;
    var cells = row.getElementsByTagName('td');

    // Récupérer les valeurs actuelles des cellules
    var prenom = cells[0].innerHTML;
    var nom = cells[1].innerHTML;
    var nvemail = cells[2].innerHTML;
    var type = cells[3].innerHTML;
    var numeroTel = cells[4].innerHTML;
    var niveauEtude = cells[5].innerHTML;
    var ecole = cells[6].innerHTML;
    var ville = cells[7].innerHTML;
    // Modifier les cellules pour afficher les champs de modification
    cells[0].innerHTML = "<input type='text' value='" + prenom + "'>";
    cells[1].innerHTML = "<input type='text' value='" + nom + "'>";
    cells[2].innerHTML = "<input type='text' value='" + nvemail + "'>";
    cells[3].innerHTML = "<input type='text' value='" + type + "'>";
    cells[4].innerHTML = "<input type='text' value='" + numeroTel + "'>";
    cells[5].innerHTML = `
        <div class="radioniveauEtude" style="display: flex;">
            <input type="radio" id="L1" name="niveauEtude" value="L1" ${niveauEtude === 'L1' ? 'checked' : ''}><label for="L1">L1</label>
            <input type="radio" id="L2" name="niveauEtude" value="L2" ${niveauEtude === 'L2' ? 'checked' : ''}><label for="L2">L2</label>
            <input type="radio" id="L3" name="niveauEtude" value="L3" ${niveauEtude === 'L3' ? 'checked' : ''}><label for="L3">L3</label>
            <input type="radio" id="M1" name="niveauEtude" value="M1" ${niveauEtude === 'M1' ? 'checked' : ''}><label for="M1">M1</label>
            <input type="radio" id="M2" name="niveauEtude" value="M2" ${niveauEtude === 'M2' ? 'checked' : ''}><label for="M2">M2</label>
            <input type="radio" id="D" name="niveauEtude" value="D" ${niveauEtude === 'D' ? 'checked' : ''}><label for="D">D</label>
        </div>`;
    cells[6].innerHTML = "<input type='text' value='" + ecole + "'>";
    cells[7].innerHTML = "<input type='text' value='" + ville + "'>";


    // Changer le texte du bouton Modifier en Envoyer
    button.innerHTML = "Envoyer";
    button.setAttribute("onclick", "sendDataEtudiant(this, '" + email + "')");
}

/**
 * récupère les données du formulaire et les envoie à la page action/edit_a_profil.php
 * @param {*} button 
 * @param {*} email 
 *  */
function sendDataEtudiant(button, email) {


    var row = button.parentNode.parentNode;
    var cells = row.getElementsByTagName('td');

    // Récupérer les nouvelles valeurs des champs de modification
    var prenom = cells[0].getElementsByTagName('input')[0].value;
    var nom = cells[1].getElementsByTagName('input')[0].value;
    var nvemail = cells[2].getElementsByTagName('input')[0].value;
    var type = cells[3].getElementsByTagName('input')[0].value;
    var numeroTel = cells[4].getElementsByTagName('input')[0].value;
    var niveauEtudeInputs = cells[5].querySelectorAll('input[name="niveauEtude"]');
    var niveauEtudeValue = '';
    for (var i = 0; i < niveauEtudeInputs.length; i++) {
        if (niveauEtudeInputs[i].checked) {
            niveauEtudeValue = niveauEtudeInputs[i].value;
            break;
        }
    }
    var ecole = cells[6].getElementsByTagName('input')[0].value;
    var ville = cells[7].getElementsByTagName('input')[0].value;


    // Envoyer les données à une page PHP pour effectuer la mise à jour
    // Utilisez AJAX ou un formulaire pour soumettre les données à la page PHP
    // Exemple avec AJAX :
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            // Mettre à jour les cellules avec les nouvelles valeurs
            cells[0].innerHTML = prenom;
            cells[1].innerHTML = nom;
            cells[2].innerHTML = nvemail;
            cells[3].innerHTML = type;
            cells[4].innerHTML = numeroTel;
            cells[5].innerHTML = niveauEtudeValue;
            cells[6].innerHTML = ecole;
            cells[7].innerHTML = ville;

            // Changer le texte du bouton Envoyer en Modifier
            button.innerHTML = "Modifier";
            button.setAttribute("onclick", "toggleEditEtudiant(this)");
        }
    };
    // xhttp.open("GET", "pages/modifierUtilisateur.php?email=" + email + "&prenom=" + prenom + "&nom=" + nom + "&type=" + type + "&numeroTel=" + numeroTel + "&niveau

    xhttp.open("POST", "action/edit_a_profil.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email + "&prenomUtilisateur=" + prenom + "&nomUtilisateur=" + nom + "&nvemail=" + nvemail + "&type=" + type + "&numeroTel=" + numeroTel + "&niveauEtude=" + niveauEtudeValue + "&ecole=" + ecole + "&ville=" + ville );

}
/*
* Affiche les champs de modification du profil
* @param {HTMLElement} button - le bouton Modifier
*/

function toggleEditGestionnaire(button) {
    var email = button.getAttribute('data-email');
    var row = button.parentNode.parentNode;
    var cells = row.getElementsByTagName('td');

    // Récupérer les valeurs actuelles des cellules
    var prenom = cells[0].innerHTML;
    var nom = cells[1].innerHTML;
    var nvemail = cells[2].innerHTML;
    var type = cells[3].innerHTML;
    var numeroTel = cells[4].innerHTML;
    var nomEntreprise = cells[5].innerHTML;
    var dateDebutUtilisateur = cells[6].innerHTML;
    var dateFinUtilisateur = cells[7].innerHTML;

    // Modifier les cellules pour afficher les champs de modification
    cells[0].innerHTML = "<input type='text' value='" + prenom + "'>";
    cells[1].innerHTML = "<input type='text' value='" + nom + "'>";
    cells[2].innerHTML = "<input type='text' value='" + nvemail + "'>";
    cells[3].innerHTML = "<input type='text' value='" + type + "'>";
    cells[4].innerHTML = "<input type='text' value='" + numeroTel + "'>";
    cells[5].innerHTML = "<input type='text' value='" + nomEntreprise + "'>";
    cells[6].innerHTML = "<input type='date' value='" + dateDebutUtilisateur + "'>";
    cells[7].innerHTML = "<input type='date' value='" + dateFinUtilisateur + "'>";

    // Changer le texte du bouton Modifier en Envoyer
    button.innerHTML = "Envoyer";
    button.setAttribute("onclick", "sendDataGestionnaire(this, '" + email + "')");
}

/*
* récupère les données du formulaire et les envoie à la page action/edit_a_profil.php
* @param {HTMLElement} button - le bouton Envoyer
* @param {string} email - l'email de l'utilisateur
* @param {string} mdp - le mot de passe de l'utilisateur
*/
function sendDataGestionnaire(button, email) {
    var row = button.parentNode.parentNode;
    var cells = row.getElementsByTagName('td');

    // Récupérer les nouvelles valeurs des champs de modification
    var prenom = cells[0].getElementsByTagName('input')[0].value;
    var nom = cells[1].getElementsByTagName('input')[0].value;
    var nvemail = cells[2].getElementsByTagName('input')[0].value;
    var type = cells[3].getElementsByTagName('input')[0].value;
    var numeroTel = cells[4].getElementsByTagName('input')[0].value;
    var nomEntreprise = cells[5].getElementsByTagName('input')[0].value;
    var dateDebutUtilisateur = cells[6].getElementsByTagName('input')[0].value;
    var dateFinUtilisateur = cells[7].getElementsByTagName('input')[0].value;

    // Envoyer les données à une page PHP pour effectuer la mise à jour
    // Utilisez AJAX ou un formulaire pour soumettre les données à la page PHP
    // Exemple avec AJAX :
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            // Mettre à jour les cellules avec les nouvelles valeurs
            cells[0].innerHTML = prenom;
            cells[1].innerHTML = nom;
            cells[2].innerHTML = nvemail;
            cells[3].innerHTML = type;
            cells[4].innerHTML = numeroTel;
            cells[5].innerHTML = nomEntreprise;
            cells[6].innerHTML = dateDebutUtilisateur;
            cells[7].innerHTML = dateFinUtilisateur;


            // Changer le texte du bouton Envoyer en Modifier
            button.innerHTML = "Modifier";
            button.setAttribute("onclick", "toggleEditGestionnaire(this)");
        }
    };


    xhttp.open("POST", "action/edit_a_profil.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email + "&prenomUtilisateur=" + prenom + "&nomUtilisateur=" + nom + "&nvemail=" + nvemail + "&type=" + type + "&numeroTel=" + numeroTel + "&nomEntreprise=" + nomEntreprise + "&dateDebutUtilisateur=" + dateDebutUtilisateur + "&dateFinUtilisateur=" + dateFinUtilisateur );
}
/*
* supprime un utilisateur
* @param {HTMLElement} button - le bouton Supprimer
*/
function supprimerUtilisateur(button) {
    var email = button.getAttribute('data-email');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            // Supprimer la ligne du tableau
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    };
    xhttp.open("POST", "action/supprimerUtilisateur.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email);
}

var button1 = document.getElementById('ajouter-btn1');
var button2 = document.getElementById('ajouter-btn2');
/*
* Ajoute un étudiant
*/
function ajouterEtudiant() {
    // Créer une référence au tableau HTML
    var tableauEtudiants = document.getElementById('tableauEtudiants');

    // Créer une nouvelle ligne
    var nouvelleLigne = tableauEtudiants.insertRow();

    // Ajouter des cellules vides dans la nouvelle ligne
    var cellulePrenom = nouvelleLigne.insertCell();
    cellulePrenom.innerHTML = '<input type="text" id="nouveauPrenom" value="">';

    var celluleNom = nouvelleLigne.insertCell();
    celluleNom.innerHTML = '<input type="text" id="nouveauNom" value="">';

    var celluleEmail = nouvelleLigne.insertCell();
    celluleEmail.innerHTML = '<input type="text" id="nouvelEmail" value="">';

    var celluleType = nouvelleLigne.insertCell();
    celluleType.innerHTML = '<input type="text" id="nouveauType" value="Etudiant">';

    var celluleNumeroTel = nouvelleLigne.insertCell();
    celluleNumeroTel.innerHTML = '<input type="text" id="nouveauNumeroTel" value="">';

    var celluleNiveauEtude = nouvelleLigne.insertCell();
    celluleNiveauEtude.innerHTML = 
    `<div class="radioniveauEtude" style="display: flex;">
        <input type="radio" id="L1" name="niveauEtude" value="L1" ><label for="L1">L1</label>
        <input type="radio" id="L2" name="niveauEtude" value="L2" ><label for="L2">L2</label>
        <input type="radio" id="L3" name="niveauEtude" value="L3" ><label for="L3">L3</label>
        <input type="radio" id="M1" name="niveauEtude" value="M1" ><label for="M1">M1</label>
        <input type="radio" id="M2" name="niveauEtude" value="M2" ><label for="M2">M2</label>
        <input type="radio" id="D" name="niveauEtude" value="D" ><label for="D">D</label>
    </div>`;

    var celluleEcole = nouvelleLigne.insertCell();
    celluleEcole.innerHTML = '<input type="text" id="nouvelleEcole" value="">';

    var celluleVille = nouvelleLigne.insertCell();
    celluleVille.innerHTML = '<input type="text" id="nouvelleVille" value="">';

    var celluleActions = nouvelleLigne.insertCell();
    celluleActions.innerHTML = '<button onclick="sauvegarderNouvelEtudiant()">Enregistrer</button>';

    button1.style.display = 'none';
    button2.style.display = 'none';
}   
/*
* Sauvegarde un nouvel étudiant
*/
function sauvegarderNouvelEtudiant() {
    // Récupérer les valeurs des champs
    var nouveauPrenom = document.getElementById('nouveauPrenom').value;
    var nouveauNom = document.getElementById('nouveauNom').value;
    var nouvelEmail = document.getElementById('nouvelEmail').value;
    var nouveauType = 'Etudiant';
    var nouveauNumeroTel = document.getElementById('nouveauNumeroTel').value;
    var nouveauNiveauEtude = document.querySelector('input[name="niveauEtude"]:checked').value;
    var nouvelleEcole = document.getElementById('nouvelleEcole').value;
    var nouvelleVille = document.getElementById('nouvelleVille').value;
    var nouveauMotDePasse = 'root';
    // Créer un objet contenant les données à envoyer


    // Effectuer la requête AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'action/ajouterUtilisateur.php', true);
    xhr.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // La requête a été traitée avec succès
                console.log('Étudiant ajouté avec succès !');
                location.reload();
            } else {
                // Une erreur s'est produite lors de la requête
                console.error('Une erreur s\'est produite lors de l\'ajout de l\'étudiant.');
            }
        }
    };
    xhr.send('prenomUtilisateur=' + nouveauPrenom + '&nomUtilisateur=' + nouveauNom + '&email=' + nouvelEmail + '&type=' + nouveauType + '&numeroTel=' + nouveauNumeroTel + '&niveauEtude=' + nouveauNiveauEtude + '&ecole=' + nouvelleEcole + '&ville=' + nouvelleVille + '&motDePasse=' + nouveauMotDePasse);

}
/*
* Ajoute un gestionnaire
*/

function ajouterGestionnaire() {
    var tableauGestionnaire = document.getElementById('tableauGestionnaire');
    var nouvelleLigne = tableauGestionnaire.insertRow();

    var cellulePrenom = nouvelleLigne.insertCell();
    cellulePrenom.innerHTML = '<input type="text" id="nouveauPrenom" value="">';

    var celluleNom = nouvelleLigne.insertCell();
    celluleNom.innerHTML = '<input type="text" id="nouveauNom" value="">';

    var celluleEmail = nouvelleLigne.insertCell();
    celluleEmail.innerHTML = '<input type="text" id="nouvelEmail" value="">';

    var celluleType = nouvelleLigne.insertCell();
    celluleType.innerHTML = '<input type="text" id="nouveauType" value="Gestionnaire">';

    var celluleNumeroTel = nouvelleLigne.insertCell();
    celluleNumeroTel.innerHTML = '<input type="text" id="nouveauNumeroTel" value="">';

    var celluleNomEntreprise = nouvelleLigne.insertCell();
    celluleNomEntreprise.innerHTML = '<input type="text" id="nouveauNomEntreprise" value="">';

    var celluleDateDebutUtilisateur = nouvelleLigne.insertCell();
    celluleDateDebutUtilisateur.innerHTML = '<input type="date" id="nouvelleDateDebutUtilisateur" value="">';

    var celluleDateFinUtilisateur = nouvelleLigne.insertCell();
    celluleDateFinUtilisateur.innerHTML = '<input type="date" id="nouvelleDateFinUtilisateur" value="">';


    var celluleActions = nouvelleLigne.insertCell();
    celluleActions.innerHTML = '<button onclick="sauvegarderNouveauGestionnaire(this)">Enregistrer</button>';

    button2.style.display = 'none';
    button1.style.display = 'none';
}
/*
* Sauvegarde un nouveau gestionnaire
*/
function sauvegarderNouveauGestionnaire() {
    // Récupérer les valeurs des champs
    var nouveauPrenom = document.getElementById('nouveauPrenom').value;
    var nouveauNom = document.getElementById('nouveauNom').value;
    var nouvelEmail = document.getElementById('nouvelEmail').value;
    var nouveauType = 'Gestionnaire';
    var nouveauNumeroTel = document.getElementById('nouveauNumeroTel').value;
    var nouveauNomEntreprise = document.getElementById('nouveauNomEntreprise').value;
    var nouvelleDateDebutUtilisateur = document.getElementById('nouvelleDateDebutUtilisateur').value;
    var nouvelleDateFinUtilisateur = document.getElementById('nouvelleDateFinUtilisateur').value;
    var nouveauMotDePasse = 'root';

    // Créer un objet contenant les données à envoyer
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'action/ajouterUtilisateur.php', true);
    xhr.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // La requête a été traitée avec succès
                console.log('Gestionnaire ajouté avec succès !');
                location.reload();
            } else {
                // Une erreur s'est produite lors de la requête
                console.error('Une erreur s\'est produite lors de l\'ajout du gestionnaire.');
            }
        }
    };
    xhr.send('prenomUtilisateur=' + nouveauPrenom + '&nomUtilisateur=' + nouveauNom + '&email=' + nouvelEmail + '&type=' + nouveauType + '&numeroTel=' + nouveauNumeroTel + '&nomEntreprise=' + nouveauNomEntreprise + '&dateDebutUtilisateur=' + nouvelleDateDebutUtilisateur + '&dateFinUtilisateur=' + nouvelleDateFinUtilisateur + '&motDePasse=' + nouveauMotDePasse);
}



