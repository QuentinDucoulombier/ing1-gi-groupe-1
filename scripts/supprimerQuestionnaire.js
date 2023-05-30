function supprimerQuestionnaire(button) {
    // Récupérer l'id du questionnaire à supprimer depuis l'attribut "id-questionnaire" du bouton
    var idQuestionnaire = button.getAttribute("id-questionnaire");
  
    // Appeler la fonction PHP de suppression du questionnaire via AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Recharger la page
        location.reload();
      }
    };
  
    // Envoyer la requête POST avec l'idQuestionnaire à supprimer
    xhr.open("POST", "/action/supprimerQuestionnaire.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("idQuestionnaire=" + idQuestionnaire);
  }