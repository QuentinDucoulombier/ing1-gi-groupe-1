<!DOCTYPE html>

<?php
if (isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    // recuperer les données de l'utilisateur connecté a partir de son email


    $infos = getUser($email);
    $prenomUtilisateur = $infos[0]['prenomUtilisateur'];

    ?>

    <html lang="en">
    <!--
    <head>
        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/css/profil.css" />
        <script defer src="../scripts/profil.js"></script>


        <title>Profil</title>
    </head>
-->

    <table>
        <tr>
            <th>Prénom</th>
            <td><?php echo $infos[0]['prenomUtilisateur']; ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?php echo $infos[0]['nomUtilisateur']; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $infos[0]['email']; ?></td>
        </tr>
        <tr>
            <th>Numéro de téléphone</th>
            <td><?php echo $infos[0]['numeroTel']; ?></td>
        </tr>
        <tr>
            <th>Niveau d'étude</th>
            <td><?php echo $infos[0]['niveauEtude']; ?></td>
        </tr>
        <tr>
            <th>Ecole</th>
            <td><?php echo $infos[0]['ecole']; ?></td>
        </tr>
        <tr>
            <th>Ville</th>
            <td><?php echo $infos[0]['ville']; ?></td>
        </tr>

        <tr>
            <th>Mot de passe</th>
            <td><?php echo $infos[0]['motDePasse']; ?></td>
        </tr>
        <tr>
            <th>Confirmer mot de passe</th>
            <td><?php echo $infos[0]['motDePasse']; ?></td>
        </tr>
        <tr>
            <th>Modifier</th>
            <td><button onclick="toggleEditEtudiant(this)" data-email="<?php echo $infos[0]['email']; ?>">Modifier</button></td>
        </tr>
    </table>



    </html>


    <?php
} else {
    echo 'error';
    //     header('Location: /index.php');
}
?>
 <script defer src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <script>
        function sha1(str) {
            return CryptoJS.SHA1(str).toString();
        }

        function toggleEditEtudiant(button) {
            var email = button.getAttribute('data-email');
            var table = document.querySelector('table'); // Sélectionne la première table trouvée dans le document
            var cells = table.getElementsByTagName('td'); // Récupère tous les éléments <td> dans la table

            // Récupérer les valeurs actuelles des cellules
            var prenom = cells[0].innerHTML;
            var nom = cells[1].innerHTML;
            var nvemail = cells[2].innerHTML;
            var tel = cells[3].innerHTML;
            var niveauEtude = cells[4].innerHTML;
            var ecole = cells[5].innerHTML;
            var ville = cells[6].innerHTML;
            var motDePasse = cells[7].innerHTML;
            var ConfirmerMotDePasse = cells[8].innerHTML;

            // Modifier les cellules pour afficher les champs de modification
            cells[0].innerHTML = "<input type='text' value='" + prenom + "'>";
            cells[1].innerHTML = "<input type='text' value='" + nom + "'>";
            cells[2].innerHTML = "<input type='text' value='" + nvemail + "'>";
            cells[3].innerHTML = "<input type='text' value='" + tel + "'>";
            cells[4].innerHTML = "<input type='text' value='" + niveauEtude + "'>";
            cells[5].innerHTML = "<input type='text' value='" + ecole + "'>";
            cells[6].innerHTML = "<input type='text' value='" + ville + "'>";
            cells[7].innerHTML = "<input type='password' value='" + motDePasse + "'>";
            cells[8].innerHTML = "<input type='password' value='" + ConfirmerMotDePasse + "'>";

            // Changer le texte du bouton Modifier en Envoyer
            button.innerHTML = "Envoyer";
            button.setAttribute("onclick", "sendDataEtudiant(this, '" + email + "', '" + motDePasse + "')");
        }



        function sendDataEtudiant(button, email, motDePasse2) {


            var table = document.querySelector('table'); // Sélectionne la première table trouvée dans le document
            var cells = table.getElementsByTagName('td'); // Récupère tous les éléments <td> dans la table


            // Récupérer les nouvelles valeurs des champs de modification
            var prenom = cells[0].getElementsByTagName('input')[0].value;
            var nom = cells[1].getElementsByTagName('input')[0].value;
            var nvemail = cells[2].getElementsByTagName('input')[0].value;
            var tel = cells[3].getElementsByTagName('input')[0].value;
            var niveauEtude = cells[4].getElementsByTagName('input')[0].value;
            var ecole = cells[5].getElementsByTagName('input')[0].value;
            var ville = cells[6].getElementsByTagName('input')[0].value;
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
                    cells[4].innerHTML = niveauEtude;
                    cells[5].innerHTML = ecole;
                    cells[6].innerHTML = ville;
                    cells[7].innerHTML = motDePasse;
                    cells[8].innerHTML = ConfirmerMotDePasse;

                    // Changer le texte du bouton Envoyer en Modifier
                    button.innerHTML = "Modifier";
                    button.setAttribute("onclick", "toggleEditEtudiant(this)");
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
            xhttp.send("email=" + email + "&prenomUtilisateur=" + prenom + "&nomUtilisateur=" + nom + "&nvemail=" + nvemail + "&numeroTel=" + tel + "&niveauEtude=" + niveauEtude + "&ecole=" + ecole + "&ville=" + ville + "&motDePasse=" + motDePasse + "&typePage=" + typePage);
        }

    </script>