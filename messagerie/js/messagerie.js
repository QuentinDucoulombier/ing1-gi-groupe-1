/*Change le destinataire*/
function newDestinataire(id) {

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            /*is_blocked = parseInt(this.responseText);
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
            recup_messages();*/
            console.log(this.responseText);
            document.getElementById("name").innerHTML = this.responseText;
        }
    }
    console.log(id);

    xhttp.open("POST", "../php/newDestinataire.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id);
}

/*TODO:getMsg() and newMsg() and displayMsg()*/
function displayMsg(message) {
    let message_zone = document.getElementById("message-zone");

    let nv_message = document.createElement("div");
    nv_message.classList.add("message");

    let id = document.createElement("p");
    id.classList.add("hidden");
    id.innerHTML = message["id_message"];

    let prem_ligne = document.createElement("div");
    prem_ligne.classList.add("premiere-ligne");

    let p_auteur = document.createElement("p");
    p_auteur.classList.add("auteur");
    p_auteur.innerHTML = message["prenom"] + " " + message["nom"];

    prem_ligne.appendChild(p_auteur);

    let plus = document.createElement("div");
    plus.classList.add("plus");
    plus.innerHTML = "<div></div><div></div><div></div>";

    let p_infos = document.createElement("p");
    p_infos.classList.add("infos");
    p_infos.innerHTML = message["date_envoi"];

    let p_text = document.createElement("p");
    p_text.classList.add("text");
    p_text.innerHTML = message["message"];

    nv_message.appendChild(prem_ligne);
    nv_message.appendChild(p_infos);
    nv_message.appendChild(p_text);
    nv_message.appendChild(id);

    message_zone.appendChild(nv_message);
}

    
const recup_messages = () => {
    // Créez une variable pour stocker l'ID du dernier message récupéré
    let lastMessageId = 1; // Remplacez par la valeur de l'ID du dernier message récupéré précédemment

    // Effectuez une requête Ajax pour récupérer les messages
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let messages = JSON.parse(this.responseText);

            messages.forEach(message => {
                let id = message["id"];
                console.log(message);
                //if (id > lastMessageId) {
                    displayMsg(message);
                    lastMessageId = id;
                //}
            });
        }
    };

    xhttp.open("GET", "fetch_message.php?lastMessageId=" + lastMessageId, true);
    xhttp.send();
}



function newMsg() {
    let message = document.getElementById("message-text").value;
    //if(!is_blocked){
    var xhttp = new XMLHttpRequest();


    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            recup_messages();
        }
    };

    xhttp.open("POST", "../php/newMessage.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("message="+message);
    //}

}
