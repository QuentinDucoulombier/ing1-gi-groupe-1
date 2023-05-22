<?php
    $serveur = "localhost";
    $user = "quentin";
    $pass = "*noeDu64*";
    $cnx = mysqli_connect($serveur, $user, $pass);

    if (mysqli_connect_errno($cnx)) {
        echo "Erreur de connexion a MySQL: " . mysqli_connect_error();
        exit();
    }

    $message = $_POST["message"];
    $dbname = "messagerie";
    mysqli_select_db($cnx, $dbname);
    

    
?>