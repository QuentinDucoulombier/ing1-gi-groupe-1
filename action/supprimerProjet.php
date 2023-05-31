<?php
require_once("bdd.php");

if (isset($_POST["idProjet"])) {
  $idProjet = $_POST["idProjet"];

  // Appeler la fonction de suppression du questionnaire
  deleteProjet($idProjet);
}
?>