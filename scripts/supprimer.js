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

function supprimerEvent(button) {
  // Récupérer l'id du event à supprimer depuis l'attribut "id-event" du bouton
  var idEvent = button.getAttribute("id-event");

  // Appeler la fonction PHP de suppression du event via AJAX
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      window.location.href = "/?page=evenements";
    }
  };

  // Envoyer la requête POST avec l'idEvent à supprimer
  xhr.open("POST", "/action/supprimerEvenement.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("idEvent=" + idEvent);
}

function supprimerProjet(button) {
  // Récupérer l'id du projet à supprimer depuis l'attribut "id-projet" du bouton
  var idProjet = button.getAttribute("id-projet");

  // Appeler la fonction PHP de suppression du projet via AJAX
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      window.location.href = "/?page=evenements";
    }
  };

  // Envoyer la requête POST avec l'idprojet à supprimer
  xhr.open("POST", "/action/supprimerProjet.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("idProjet=" + idProjet);
}