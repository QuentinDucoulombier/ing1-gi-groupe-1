/**TODO:
 * [~]Clean code
 * [x]fix bugs
 * [x]add group message
 * []Transformer les requetes get en post
 * [x]Rajouter le fait d'ajouter un systeme de notif
 * []Mettre le systeme une actualisation de la notif
 **/

var lastMessageId = 0;
var id = 1;

/**
 * @fn function newDestinataire()
 * @param id identifiant de l'utilisateur
 * @brief permet de choisir un nouveau destinataire lorsque l'on clique sur la liste
 */
function newDestinataire(id) {

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            
            console.log(this.responseText);
            document.getElementById("name").innerHTML = this.responseText;
            
            lastMessageId = 1;
            recup_messages();
        }
    }
    console.log(id);

    xhttp.open("POST", "../action/chat/newDestinataire.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id);
}

/**
 * @fn function displayMsg(message)
 * @param message objet contenant les informations du message à afficher
 * @brief affiche un message dans la zone de messages
 */
function displayMsg(message) {
    
    let message_zone = document.getElementById("message-zone");

    let nv_message = document.createElement("div");
    nv_message.classList.add("message");
    nv_message.classList.add(message["statut"]);


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

/**
 * @fn const recup_messages()
 * @brief récupère les nouveaux messages depuis le serveur
 */
function recup_messages() {

    console.log(lastMessageId);
    if(lastMessageId == 1){
        document.getElementById("message-zone").innerHTML = "";
    }
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let messages = JSON.parse(this.responseText);

            messages.forEach(message => {
                id = parseInt(message["id"]);
                lastMessageId = parseInt(lastMessageId);
                console.log("id "+id);
                console.log("last id "+lastMessageId);
                console.log(message);

                if (id > lastMessageId) {
                    console.log("ici");
                    displayMsg(message);
                    lastMessageId = id;
                }
                else{
                    //lastMessageId = id;
                    console.log("ici 2");
                }
            });
        }
    };

    xhttp.open("GET", "../action/chat/fetch_message.php?lastMessageId=" + lastMessageId, true);
    xhttp.send();
}

/**
 * @fn function newMsg()
 * @brief envoie un nouveau message au serveur
 */
function newMsg() {
    let message = document.getElementById("message-text").value;
    
    var xhttp = new XMLHttpRequest();


    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            recup_messages();
            document.getElementById("message-text").value = "";

        }
    };

    xhttp.open("POST", "../action/chat/newMessage.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("message="+message);
   

}