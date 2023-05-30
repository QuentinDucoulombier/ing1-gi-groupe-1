function supprimerUtilisateur(button) {
    var id = button.getAttribute('id-questionnaire');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            // Supprimer la ligne du tableau
            //var row = button.parentNode.parentNode;
            //row.parentNode.removeChild(row);
        }
    };
    xhttp.open("POST", "action/supprimerQuestionnaire.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id);
}