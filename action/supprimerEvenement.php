<?php
require_once("bdd.php");

if (isset($_POST["idEvent"])) {
  $idEvent = $_POST["idEvent"];

  // Appeler la fonction de suppression du questionnaire
  deleteEvent($idEvent);
}
?>