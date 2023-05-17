const nouv_autre = (nom,prenom,mail,statut) => {

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            is_blocked = parseInt(this.responseText);
            var button_bloque = document.getElementById("button-bloque");
            var button_debloque = document.getElementById("button-debloque");

            if(is_blocked){

                button_bloque.classList.add("hidden");
                button_debloque.classList.remove("hidden");
            }else{
                button_bloque.classList.remove("hidden");
                button_debloque.classList.add("hidden");
            }
            id_dernier_message = -1;
            recup_messages();
        }
    }

    xhttp.open("POST", "../php/newMessage.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("nom="+nom +"&prenom="+prenom +"&mail="+mail +"&statut="+statut);
}