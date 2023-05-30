/*faire ajax*/


function supprimerMember(idUser,idTeam){
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            document.getElementById("table").innerHTML = this.responseText;
        }
            
    };
    xhttp.open("POST", "../action/suppMember.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("idUser="+idUser+"&idTeam="+idTeam);

}


function searchMember(i) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("result").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "../action/searchMember.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("nbrMembre="+i);
}


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


function addMember(idUser,idTeam){
    console.log("user "+idUser);
    console.log("team "+idTeam);
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            document.getElementById("table").innerHTML = this.responseText;
            document.getElementById("searchMember").innerHTML = "";
        }
            
    };
    xhttp.open("POST", "../action/addMember.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("idUser="+idUser+"&idTeam="+idTeam);

}


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
  
    confirmButton.addEventListener('click', function() {
        if (typeof callback === 'function') {
            callback(true);
        }
        removeConfirmBox();
    });
  
    cancelButton.addEventListener('click', function() {
        if (typeof callback === 'function') {
            callback(false);
        }
        removeConfirmBox();
    });
}


function suppTeam() {
    confirm("Êtes-vous sûr de vouloir supprimer cette équipe ?", function(confirmed) {
        if (confirmed) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
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
