<?php

include "../action/bdd.php";

$valeur = $_POST['valeur']; // Récupérer la valeur envoyée depuis JavaScript
$idEquipe=$_GET["idEquipe"];

setAnalyseCode($idEquipe,$valeur);

?>

