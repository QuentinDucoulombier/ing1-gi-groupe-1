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
  