function validateEvenement() {
  var isValid = true;

  // Vérification du champ "Type d'évènement"
  var eventTypeRadios = document.querySelectorAll('input[name="type"]');
  var eventTypeNeeded = document.getElementById('needed-type');
  var eventTypeValid = false;

  for (var i = 0; i < eventTypeRadios.length; i++) {
    if (eventTypeRadios[i].checked) {
      eventTypeValid = true;
      break;
    }
  }

  if (!eventTypeValid) {
    eventTypeNeeded.style.visibility = 'visible';
    isValid = false;
  } else {
    eventTypeNeeded.style.visibility = 'hidden';
  }

  // Vérification du champ "Nom de l'évènement"
  var eventNameInput = document.getElementById('nomEvenement');
  var eventNameNeeded = document.getElementById('needed-name');

  if (eventNameInput.value.trim() === '') {
    eventNameNeeded.style.visibility = 'visible';
    isValid = false;
  } else {
    eventNameNeeded.style.visibility = 'hidden';
  }

  // Vérification du champ "Date de début"
  var startDateInput = document.getElementById('dateDebut');
  var startDateNeeded = document.getElementById('needed-dateDebut');

  if (startDateInput.value === '') {
    startDateNeeded.style.visibility = 'visible';
    isValid = false;
  } else {
    startDateNeeded.style.visibility = 'hidden';
  }

  // Vérification du champ "Date de fin"
  var endDateInput = document.getElementById('dateFin');
  var endDateNeeded = document.getElementById('needed-dateFin');

  if (endDateInput.value === '') {
    endDateNeeded.style.visibility = 'visible';
    isValid = false;
  } else {
    endDateNeeded.style.visibility = 'hidden';
  }

  return isValid;
}

function validateProjet() {
  var isValid = true;

  // Vérification du champ "Nom de l'évènement"
  var eventNameInput = document.getElementById('nomProjet');
  var eventNameNeeded = document.getElementById('needed-name');

  if (eventNameInput.value.trim() === '') {
    eventNameNeeded.style.visibility = 'visible';
    isValid = false;
  } else {
    eventNameNeeded.style.visibility = 'hidden';
  }

  return isValid;
}

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