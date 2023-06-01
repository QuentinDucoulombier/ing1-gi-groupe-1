function supprimerMember(idUser,idTeam){
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            window.location.href = "/?page=accueil";
        }
            
    };
    xhttp.open("POST", "../action/suppUserTeam.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("idUser="+idUser+"&idTeam="+idTeam);

}