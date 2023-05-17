<?php
session_start();
require('config.php');

// Si des données ont été soumises via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données POST envoyées par le formulaire
    $password = sha1($_POST['password']);
    $newPassword = sha1($_POST['newPassword']);
    $confirm_password = sha1($_POST['confirm_password']);
    $id = htmlspecialchars($_SESSION['id']);

    $requsr = "SELECT * FROM compte WHERE id = '$id'  AND password='$password'";
    $result = mysqli_query($connexion, $requsr) or die('Pb req : ' . $requsr);
    $found = mysqli_num_rows($result);

    if ($found == 1) {


        // Vérification si les champs sont remplis
        if (empty($password ) || empty($newPassword) || empty($confirm_password)) {
            $error = "Tous les champs sont obligatoires.";
        } else if ($newPassword !== $confirm_password) {
            $error = "Les deux mots de passe ne correspondent pas.";
        } else {



            // Ecriture du nouvel utilisateur dans la base de données
            $insert = $connexion->prepare("UPDATE compte SET password = ? WHERE id = '$id'");
            $insert->bind_param('s', $newPassword);
            $insert->execute();

            echo "success";
            exit;

        }

    }

}
?>