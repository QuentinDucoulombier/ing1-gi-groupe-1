function sha1(str) {
    return CryptoJS.SHA1(str).toString();
}
var MotDePassesAdmin = document.getElementById("MotDePasse_Admin");
var ConfirmerMotDePassesAdmin = document.getElementById("Confirmer_MotDePasse_Admin");
var AncienMotDePassesAdmin = document.getElementById("Ancien_MotDePasse_Admin");
function toggleEditAdmin(button) {
    MotDePassesAdmin.style.display = 'block';
    ConfirmerMotDePassesAdmin.style.display = 'block';
    AncienMotDePassesAdmin.style.display = 'block';
    var email = button.getAttribute('data-email');
    var mdp = button.getAttribute('data-mdp');
    var table = document.querySelector('table'); // Sélectionne la première table trouvée dans le document
    var cells = table.getElementsByTagName('td'); // Récupère tous les éléments <td> dans la table

    // Récupérer les valeurs actuelles des cellules
    var prenom = cells[0].innerHTML;
    var nom = cells[2].innerHTML;
    var nvemail = cells[4].innerHTML;
    var tel = cells[6].innerHTML;

    // Modifier les cellules pour afficher les champs de modification
    cells[0].innerHTML = "<input type='text' value='" + prenom + "'>";
    cells[2].innerHTML = "<input type='text' value='" + nom + "'>";
    cells[4].innerHTML = "<input type='text' value='" + nvemail + "'>";
    cells[6].innerHTML = "<input type='text' value='" + tel + "'>";
    cells[8].innerHTML = "<input type='password' value=''>";
    cells[10].innerHTML = "<input type='password' value=''>";
    cells[12].innerHTML = "<input type='password' value=''>";

    
    // Changer le texte du bouton Modifier en Envoyer
    button.innerHTML = "Envoyer";
    button.setAttribute("onclick", "validateProfilAdmin(this,'" + email + "', '" + mdp + "')");
}



function sendDataAdmin(button, email) {


    var table = document.querySelector('table'); // Sélectionne la première table trouvée dans le document
    var cells = table.getElementsByTagName('td'); // Récupère tous les éléments <td> dans la table


    // Récupérer les nouvelles valeurs des champs de modification
    var prenom = cells[0].getElementsByTagName('input')[0].value;
    var nom = cells[2].getElementsByTagName('input')[0].value;
    var nvemail = cells[4].getElementsByTagName('input')[0].value;
    var tel = cells[6].getElementsByTagName('input')[0].value;
    var AncienMotDePasse = sha1(cells[8].getElementsByTagName('input')[0].value);
    var motDePasse = sha1(cells[10].getElementsByTagName('input')[0].value);
    var ConfirmerMotDePasse = sha1(cells[12].getElementsByTagName('input')[0].value);


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


            // Changer le texte du bouton Envoyer en Modifier
            button.innerHTML = "Modifier";
            button.setAttribute("onclick", "toggleEditAdmin(this)");
            MotDePassesAdmin.style.display = 'none';
            ConfirmerMotDePassesAdmin.style.display = 'none';
            AncienMotDePassesAdmin.style.display = 'none';
            //location.reload();

        }
    };
    // xhttp.open("GET", "pages/modifierUtilisateur.php?email=" + email + "&prenom=" + prenom + "&nom=" + nom + "&type=" + type + "&numeroTel=" + numeroTel + "&niveau
    if (motDePasse != ConfirmerMotDePasse) {
        alert("Les mots de passe ne correspondent pas");
        return;
    }
    type = "Administrateur";
    typePage = "profil";
    xhttp.open("POST", "action/edit_a_profil.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email + "&prenomUtilisateur=" + prenom + "&nomUtilisateur=" + nom + "&nvemail=" + nvemail + "&numeroTel=" + tel + "&motDePasse=" + motDePasse + "&AncienMotDePasse=" + AncienMotDePasse + "&typePage=" + typePage);

}

function validateProfilAdmin(button, email2, mdp) {

    var table = document.querySelector('table'); // Sélectionne la première table trouvée dans le document
    var cells = table.getElementsByTagName('td'); // Récupère tous les éléments <td> dans la table

    var prenom = cells[0].getElementsByTagName('input')[0].value;
    var nom = cells[2].getElementsByTagName('input')[0].value;
    var email = cells[4].getElementsByTagName('input')[0].value;
    var numeroTel = cells[6].getElementsByTagName('input')[0].value;
    var AncienmotDePasse = sha1(cells[8].getElementsByTagName('input')[0].value);
    var motDePasse = sha1(cells[10].getElementsByTagName('input')[0].value);
    var confirmMotDePasse = sha1(cells[12].getElementsByTagName('input')[0].value);
    
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
        sendDataAdmin(button, email2);
    }
    return valid;

}
