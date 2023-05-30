<?php
require_once("bdd.php");

if (isset($_POST["idQuestionnaire"])) {
  $idQuestionnaire = $_POST["idQuestionnaire"];

  // Appeler la fonction de suppression du questionnaire
  deleteQuestionnaire($idQuestionnaire);
}
?>