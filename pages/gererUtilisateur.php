<?php
if (isset($_SESSION['email'])) {
    //recuperer les infos de tous les utilisateurs
    $infos = getAllUsers();
    //afficher les infos de tous les utilisateurs dans un tableau
    ?>

    <div>
        <h1>Gérer les utilisateurs</h1>
    </div>

    <div class="tableau">
        <h2>Étudiants</h2>
        <table id="tableauEtudiants">
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Type</th>
                <th>Numéro de téléphone</th>
                <th>Niveau d'étude</th>
                <th>Ecole</th>
                <th>Ville</th>
                <th>Mot de passe</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php
            $etudiants = array_filter($infos, function ($info) {
                return $info['type'] === 'Etudiant';
            });

            foreach ($etudiants as $info) {
                echo "<tr>";
                echo "<td>" . $info['prenomUtilisateur'] . "</td>";
                echo "<td>" . $info['nomUtilisateur'] . "</td>";
                echo "<td>" . $info['email'] . "</td>";
                echo "<td>" . $info['type'] . "</td>";
                echo "<td>" . $info['numeroTel'] . "</td>";
                echo "<td>" . $info['niveauEtude'] . "</td>";
                echo "<td>" . $info['ecole'] . "</td>";
                echo "<td>" . $info['ville'] . "</td>";
                echo "<td>" . $info['motDePasse'] . "</td>";
                echo "<td><button class='modifier-btn' data-email='" . $info['email'] . "' onclick='toggleEditEtudiant(this)'>Modifier</button></td>";
                echo "<td><button class='modifier-btn' data-email='" . $info['email'] . "' onclick='supprimerUtilisateur(this)'>Supprimer</button></td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td colspan="11"><button class="ajouter-btn" onclick="ajouterEtudiant()">Ajouter un étudiant</button></td>
            </tr>
        </table>

        <h2>Gestionnaires</h2>
        <table id="tableauGestionnaire">
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Type</th>
                <th>Numéro de téléphone</th>
                <th>Nom de l'entreprise</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Mot de passe</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php
            $gestionnaires = array_filter($infos, function ($info) {
                return $info['type'] === 'Gestionnaire';
            });

            foreach ($gestionnaires as $info) {
                echo "<tr>";
                echo "<td>" . $info['prenomUtilisateur'] . "</td>";
                echo "<td>" . $info['nomUtilisateur'] . "</td>";
                echo "<td>" . $info['email'] . "</td>";
                echo "<td>" . $info['type'] . "</td>";
                echo "<td>" . $info['numeroTel'] . "</td>";
                echo "<td>" . $info['nomEntreprise'] . "</td>";
                // if (isset($info['dateDebutUtilisateur'])) {
                //     echo "<td>" . date('d F Y', strtotime($info['dateDebutUtilisateur'])) . "</td>";
                // } else {
                //     echo "<td></td>";
                // }
                echo "<td>" . $info['dateDebutUtilisateur'] . "</td>";
                // if (isset($info['dateFinUtilisateur'])) {
                //     echo "<td>" . date('d F Y', strtotime($info['dateFinUtilisateur'])) . "</td>";
                // } else {
                //     echo "<td></td>";
                // }
                echo "<td>" . $info['dateFinUtilisateur'] . "</td>";
                echo "<td>" . $info['motDePasse'] . "</td>";
                echo "<td><button class='modifier-btn' data-email='" . $info['email'] . "' onclick='toggleEditGestionnaire(this)'>Modifier</button></td>";
                echo "<td><button class='modifier-btn' data-email='" . $info['email'] . "' onclick='supprimerUtilisateur(this)'>Supprimer</button></td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td colspan="11"><button class="ajouter-btn" onclick="ajouterGestionnaire()">Ajouter un gestionnaire</button></td>
            </tr>
        </table>
    </div>



    <?php
} else {
    echo 'error';
    //     header('Location: /index.php');
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
<script>

    function sha1(str) {
        return CryptoJS.SHA1(str).toString();
    }

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
        var motDePasse = cells[8].innerHTML;

        // Modifier les cellules pour afficher les champs de modification
        cells[0].innerHTML = "<input type='text' value='" + prenom + "'>";
        cells[1].innerHTML = "<input type='text' value='" + nom + "'>";
        cells[2].innerHTML = "<input type='text' value='" + nvemail + "'>";
        cells[3].innerHTML = "<input type='text' value='" + type + "'>";
        cells[4].innerHTML = "<input type='text' value='" + numeroTel + "'>";
        cells[5].innerHTML = "<input type='text' value='" + niveauEtude + "'>";
        cells[6].innerHTML = "<input type='text' value='" + ecole + "'>";
        cells[7].innerHTML = "<input type='text' value='" + ville + "'>";
        cells[8].innerHTML = "<input type='text' value='" + motDePasse + "'>";

        // Changer le texte du bouton Modifier en Envoyer
        button.innerHTML = "Envoyer";
        button.setAttribute("onclick", "sendDataEtudiant(this, '" + email + "', '" + motDePasse + "')");
    }


    function sendDataEtudiant(button, email, motDePasse2) {


        var row = button.parentNode.parentNode;
        var cells = row.getElementsByTagName('td');

        // Récupérer les nouvelles valeurs des champs de modification
        var prenom = cells[0].getElementsByTagName('input')[0].value;
        var nom = cells[1].getElementsByTagName('input')[0].value;
        var nvemail = cells[2].getElementsByTagName('input')[0].value;
        var type = cells[3].getElementsByTagName('input')[0].value;
        var numeroTel = cells[4].getElementsByTagName('input')[0].value;
        var niveauEtude = cells[5].getElementsByTagName('input')[0].value;
        var ecole = cells[6].getElementsByTagName('input')[0].value;
        var ville = cells[7].getElementsByTagName('input')[0].value;
        if (cells[8].getElementsByTagName('input')[0].value == motDePasse2) {
            var motDePasse = cells[8].getElementsByTagName('input')[0].value;
        } else {
            var motDePasse = sha1(cells[8].getElementsByTagName('input')[0].value);
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
                cells[3].innerHTML = type;
                cells[4].innerHTML = numeroTel;
                cells[5].innerHTML = niveauEtude;
                cells[6].innerHTML = ecole;
                cells[7].innerHTML = ville;
                cells[8].innerHTML = motDePasse;

                // Changer le texte du bouton Envoyer en Modifier
                button.innerHTML = "Modifier";
                button.setAttribute("onclick", "toggleEditEtudiant(this)");
            }
        };
        // xhttp.open("GET", "pages/modifierUtilisateur.php?email=" + email + "&prenom=" + prenom + "&nom=" + nom + "&type=" + type + "&numeroTel=" + numeroTel + "&niveau

        xhttp.open("POST", "action/edit_a_profil.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("email=" + email + "&prenomUtilisateur=" + prenom + "&nomUtilisateur=" + nom + "&nvemail=" + nvemail + "&type=" + type + "&numeroTel=" + numeroTel + "&niveauEtude=" + niveauEtude + "&ecole=" + ecole + "&ville=" + ville + "&motDePasse=" + motDePasse);

    }

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
        var motDePasse = cells[8].innerHTML;

        // Modifier les cellules pour afficher les champs de modification
        cells[0].innerHTML = "<input type='text' value='" + prenom + "'>";
        cells[1].innerHTML = "<input type='text' value='" + nom + "'>";
        cells[2].innerHTML = "<input type='text' value='" + nvemail + "'>";
        cells[3].innerHTML = "<input type='text' value='" + type + "'>";
        cells[4].innerHTML = "<input type='text' value='" + numeroTel + "'>";
        cells[5].innerHTML = "<input type='text' value='" + nomEntreprise + "'>";
        cells[6].innerHTML = "<input type='date' value='" + dateDebutUtilisateur + "'>";
        cells[7].innerHTML = "<input type='date' value='" + dateFinUtilisateur + "'>";
        cells[8].innerHTML = "<input type='text' value='" + motDePasse + "'>";

        // Changer le texte du bouton Modifier en Envoyer
        button.innerHTML = "Envoyer";
        button.setAttribute("onclick", "sendDataGestionnaire(this, '" + email + "', '" + motDePasse + "')");
    }


    function sendDataGestionnaire(button, email, motDePasse2) {
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
        if (cells[8].getElementsByTagName('input')[0].value == motDePasse2) {
            var motDePasse = cells[8].getElementsByTagName('input')[0].value;
        } else {
            var motDePasse = sha1(cells[8].getElementsByTagName('input')[0].value);
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
                cells[3].innerHTML = type;
                cells[4].innerHTML = numeroTel;
                cells[5].innerHTML = nomEntreprise;
                cells[6].innerHTML = dateDebutUtilisateur;
                cells[7].innerHTML = dateFinUtilisateur;
                cells[8].innerHTML = motDePasse;

                // Changer le texte du bouton Envoyer en Modifier
                button.innerHTML = "Modifier";
                button.setAttribute("onclick", "toggleEditGestionnaire(this)");
            }
        };


        xhttp.open("POST", "action/edit_a_profil.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("email=" + email + "&prenomUtilisateur=" + prenom + "&nomUtilisateur=" + nom + "&nvemail=" + nvemail + "&type=" + type + "&numeroTel=" + numeroTel + "&nomEntreprise=" + nomEntreprise + "&dateDebutUtilisateur=" + dateDebutUtilisateur + "&dateFinUtilisateur=" + dateFinUtilisateur + "&motDePasse=" + motDePasse);
    }
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
        celluleNiveauEtude.innerHTML = '<input type="text" id="nouveauNiveauEtude" value="">';

        var celluleEcole = nouvelleLigne.insertCell();
        celluleEcole.innerHTML = '<input type="text" id="nouvelleEcole" value="">';

        var celluleVille = nouvelleLigne.insertCell();
        celluleVille.innerHTML = '<input type="text" id="nouvelleVille" value="">';

        var celluleMotDePasse = nouvelleLigne.insertCell();
        celluleMotDePasse.innerHTML = '<input type="password" id="nouveauMotDePasse" value="">';

        var celluleActions = nouvelleLigne.insertCell();
        celluleActions.innerHTML = '<button onclick="sauvegarderNouvelEtudiant()">Enregistrer</button>';
    }
    function sauvegarderNouvelEtudiant() {
        // Récupérer les valeurs des champs
        var nouveauPrenom = document.getElementById('nouveauPrenom').value;
        var nouveauNom = document.getElementById('nouveauNom').value;
        var nouvelEmail = document.getElementById('nouvelEmail').value;
        var nouveauType = 'Etudiant';
        var nouveauNumeroTel = document.getElementById('nouveauNumeroTel').value;
        var nouveauNiveauEtude = document.getElementById('nouveauNiveauEtude').value;
        var nouvelleEcole = document.getElementById('nouvelleEcole').value;
        var nouvelleVille = document.getElementById('nouvelleVille').value;
        var nouveauMotDePasse = document.getElementById('nouveauMotDePasse').value;
        alert(nouveauPrenom);

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
                } else {
                    // Une erreur s'est produite lors de la requête
                    console.error('Une erreur s\'est produite lors de l\'ajout de l\'étudiant.');
                }
            }
        };
        xhr.send('prenomUtilisateur=' + nouveauPrenom + '&nomUtilisateur=' + nouveauNom + '&email=' + nouvelEmail + '&type=' + nouveauType + '&numeroTel=' + nouveauNumeroTel + '&niveauEtude=' + nouveauNiveauEtude + '&ecole=' + nouvelleEcole + '&ville=' + nouvelleVille + '&motDePasse=' + nouveauMotDePasse);
        
    }
    function ajouterGestionnaire(){
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
        celluleDateDebutUtilisateur.innerHTML = '<input type="text" id="nouvelleDateDebutUtilisateur" value="">';

        var celluleDateFinUtilisateur = nouvelleLigne.insertCell();
        celluleDateFinUtilisateur.innerHTML = '<input type="text" id="nouvelleDateFinUtilisateur" value="">';

        var celluleMotDePasse = nouvelleLigne.insertCell();
        celluleMotDePasse.innerHTML = '<input type="password" id="nouveauMotDePasse" value="">';

        var celluleActions = nouvelleLigne.insertCell();
        celluleActions.innerHTML = '<button onclick="sauvegarderNouveauGestionnaire()">Enregistrer</button>';
    }
    function sauvegarderNouveauGestionnaire(){
        // Récupérer les valeurs des champs
        var nouveauPrenom = document.getElementById('nouveauPrenom').value;
        var nouveauNom = document.getElementById('nouveauNom').value;
        var nouvelEmail = document.getElementById('nouvelEmail').value;
        var nouveauType = 'Gestionnaire';
        var nouveauNumeroTel = document.getElementById('nouveauNumeroTel').value;
        var nouveauNomEntreprise = document.getElementById('nouveauNomEntreprise').value;
        var nouvelleDateDebutUtilisateur = document.getElementById('nouvelleDateDebutUtilisateur').value;
        var nouvelleDateFinUtilisateur = document.getElementById('nouvelleDateFinUtilisateur').value;
        var nouveauMotDePasse = document.getElementById('nouveauMotDePasse').value;
        alert(nouveauPrenom);

        // Créer un objet contenant les données à envoyer
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action/ajouterUtilisateur.php', true);
        xhr.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // La requête a été traitée avec succès
                    console.log('Gestionnaire ajouté avec succès !');
                } else {
                    // Une erreur s'est produite lors de la requête
                    console.error('Une erreur s\'est produite lors de l\'ajout du gestionnaire.');
                }
            }
        };
        xhr.send('prenomUtilisateur=' + nouveauPrenom + '&nomUtilisateur=' + nouveauNom + '&email=' + nouvelEmail + '&type=' + nouveauType + '&numeroTel=' + nouveauNumeroTel + '&nomEntreprise=' + nouveauNomEntreprise + '&dateDebutUtilisateur=' + nouvelleDateDebutUtilisateur + '&dateFinUtilisateur=' + nouvelleDateFinUtilisateur + '&motDePasse=' + nouveauMotDePasse);
    }




</script>