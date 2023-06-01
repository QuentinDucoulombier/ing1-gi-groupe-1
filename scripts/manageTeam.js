/**
 * @fn function supprimerMember(idUser, idTeam)
 * @param idUser l'id de l'utilisateur à supprimer
 * @param idTeam l'id de l'équipe
 * @brief Envoie une requête AJAX pour supprimer un membre de l'équipe
 */
function supprimerMember(idUser, idTeam) {
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            document.getElementById("table").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "../action/suppMember.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("idUser=" + idUser + "&idTeam=" + idTeam);
}

/**
 * @fn function searchMember(i)
 * @param i le nombre de membres à rechercher
 * @brief Envoie une requête AJAX pour rechercher des membres
 */
function searchMember(i) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("result").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "../action/searchMember.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("nbrMembre=" + i);
}

/**
 * @fn function suggestMembers()
 * @brief Envoie une requête AJAX pour suggérer des membres
 */
function suggestMembers() {
    var input = document.getElementById("memberSearchInput");
    var query = input.value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("memberSuggestions").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "../action/suggestMembers.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("query=" + query);
}

/**
 * @fn function addMember(idUser, idTeam)
 * @param idUser l'id de l'utilisateur à ajouter
 * @param idTeam l'id de l'équipe
 * @brief Envoie une requête AJAX pour ajouter un membre à l'équipe
 */
function addMember(idUser, idTeam) {
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            document.getElementById("table").innerHTML = this.responseText;
            document.getElementById("searchMember").innerHTML = "";
        }
    };
    xhttp.open("POST", "../action/addMember.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("idUser=" + idUser + "&idTeam=" + idTeam);
}

/**
 * @fn function confirm(message, callback)
 * @param message le message de confirmation
 * @param callback la fonction de rappel à exécuter après confirmation
 * @brief Affiche une boîte de confirmation avec un message et des boutons "Confirmer" et "Annuler"
 */
function confirm(message, callback) {
    var confirmBox = document.createElement('div');
    confirmBox.className = 'confirm-box';
    confirmBox.innerHTML = `
        <div class="message">${message}</div>
        <div class="buttons">
            <button class="confirm">Confirmer</button>
            <button class="cancel">Annuler</button>
        </div>
    `;

    document.body.appendChild(confirmBox);

    var confirmButton = confirmBox.querySelector('.confirm');
    var cancelButton = confirmBox.querySelector('.cancel');

    function removeConfirmBox() {
        document.body.removeChild(confirmBox);
    }

    confirmButton.addEventListener('click', function () {
        if (typeof callback === 'function') {
            callback(true);
        }
        removeConfirmBox();
    });

    cancelButton.addEventListener('click', function () {
        if (typeof callback === 'function') {
            callback(false);
        }
        removeConfirmBox();
    });
}

/**
 * @fn function suppTeam()
 * @brief Affiche une boîte de confirmation pour supprimer l'équipe et envoie une requête AJAX pour supprimer l'équipe si confirmé
 */
function suppTeam() {
    confirm("Êtes-vous sûr de vouloir supprimer cette équipe ?", function (confirmed) {
        if (confirmed) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                    window.location.href = '/index.php';
                }
            };
            xhttp.open("POST", "../action/suppTeam.php", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.send();
        }
    });
}
