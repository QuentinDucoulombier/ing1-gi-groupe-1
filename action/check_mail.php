<?php
require('bdd.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        // Vérification si l'e-mail existe déjà dans la base de données
        $exists = isMail($email);

        echo $exists;
        exit();
    }
}
?>