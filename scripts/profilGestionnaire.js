function sha1(str) {
    return CryptoJS.SHA1(str).toString();
}

function toggleEditProfilGestionnaire(button) {
    var email = button.getAttribute('data-email');
    var table = document.querySelector('table'); // Sélectionne la première table trouvée dans le document
    var cells = table.getElementsByTagName('td'); // Récupère tous les éléments <td> dans la table

    // Récupérer les valeurs actuelles des cellules
    var prenom = cells[0].innerHTML;
    var nom = cells[1].innerHTML;
    var nvemail = cells[2].innerHTML;
    var tel = cells[3].innerHTML;
    var nomEntreprise = cells[4].innerHTML;
    var dateDebutUtilisateur = cells[5].innerHTML;
    var dateFinUtilisateur = cells[6].innerHTML;
    var motDePasse = cells[7].innerHTML;
    var ConfirmerMotDePasse = cells[8].innerHTML;

    // Modifier les cellules pour afficher les champs de modification
    cells[0].innerHTML = "<input type='text' value='" + prenom + "'>";
    cells[1].innerHTML = "<input type='text' value='" + nom + "'>";
    cells[2].innerHTML = "<input type='text' value='" + nvemail + "'>";
    cells[3].innerHTML = "<input type='text' value='" + tel + "'>";
    cells[4].innerHTML = "<input type='text' value='" + nomEntreprise + "'>";
    cells[5].innerHTML = "<input type='date' value='" + dateDebutUtilisateur + "'>";
    cells[6].innerHTML = "<input type='date' value='" + dateFinUtilisateur + "'>";
    cells[7].innerHTML = "<input type='text' value='" + motDePasse + "'>";
    cells[8].innerHTML = "<input type='text' value='" + ConfirmerMotDePasse + "'>";

    // Changer le texte du bouton Modifier en Envoyer
    button.innerHTML = "Envoyer";
    button.setAttribute("onclick", "sendDataProfilGestionnaire(this, '" + email + "', '" + motDePasse + "')");
}



function sendDataProfilGestionnaire(button, email, motDePasse2) {


    var table = document.querySelector('table'); // Sélectionne la première table trouvée dans le document
    var cells = table.getElementsByTagName('td'); // Récupère tous les éléments <td> dans la table


    // Récupérer les nouvelles valeurs des champs de modification
    var prenom = cells[0].getElementsByTagName('input')[0].value;
    var nom = cells[1].getElementsByTagName('input')[0].value;
    var nvemail = cells[2].getElementsByTagName('input')[0].value;
    var tel = cells[3].getElementsByTagName('input')[0].value;
    var type = 'Gestionnaire'
    var nomEntreprise = cells[4].getElementsByTagName('input')[0].value;
    var dateDebutUtilisateur = cells[5].getElementsByTagName('input')[0].value;
    var dateFinUtilisateur = cells[6].getElementsByTagName('input')[0].value;
    if (cells[7].getElementsByTagName('input')[0].value == motDePasse2) {
        var motDePasse = cells[7].getElementsByTagName('input')[0].value;
        var ConfirmerMotDePasse = cells[8].getElementsByTagName('input')[0].value;
    } else {
        var motDePasse = sha1(cells[7].getElementsByTagName('input')[0].value);
        var ConfirmerMotDePasse = sha1(cells[8].getElementsByTagName('input')[0].value);
    }
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
            cells[3].innerHTML = tel;
            cells[4].innerHTML = nomEntreprise;
            cells[5].innerHTML = dateDebutUtilisateur;
            cells[6].innerHTML = dateFinUtilisateur;
            cells[7].innerHTML = motDePasse;
            cells[8].innerHTML = ConfirmerMotDePasse;
            // Changer le texte du bouton Envoyer en Modifier
            button.innerHTML = "Modifier";
            button.setAttribute("onclick", "toggleEditProfilGestionnaire(this)");
        }
    };
    // xhttp.open("GET", "pages/modifierUtilisateur.php?email=" + email + "&prenom=" + prenom + "&nom=" + nom + "&type=" + type + "&numeroTel=" + numeroTel + "&niveau
    if (motDePasse != ConfirmerMotDePasse) {
        alert("Les mots de passe ne correspondent pas");
        return;
    }
    typePage = "profil";
    xhttp.open("POST", "action/edit_a_profil.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email + "&prenomUtilisateur=" + prenom + "&nomUtilisateur=" + nom + "&nvemail=" + nvemail + "&type=" + type + "&numeroTel=" + tel + "&nomEntreprise=" + nomEntreprise + "&dateDebutUtilisateur=" + dateDebutUtilisateur + "&dateFinUtilisateur=" + dateFinUtilisateur + "&motDePasse=" + motDePasse + "&typePage=" + typePage);

}
