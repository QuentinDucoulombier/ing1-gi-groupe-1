/**TODO:
 * [~]Clean code
 * []fix bugs
 * []add group message
 * []Transformer les requetes get en post
 * []Rajouter le fait d'ajouter un systeme de notif
 **/

var lastMessageId = 0;
var id = 1;


/*Change le destinataire*/
function newDestinataire(id) {

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            
            console.log(this.responseText);
            document.getElementById("name").innerHTML = this.responseText;
            lastMessageId = 1;
            recup_messages()
        }
    }
    console.log(id);

    xhttp.open("POST", "../php/newDestinataire.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id);
}

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

const recup_messages = () => {

    console.log(lastMessageId);
    if(lastMessageId == 1){
        document.getElementById("message-zone").innerHTML = "";
    }
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let messages = JSON.parse(this.responseText);

            messages.forEach(message => {
                id = message["id"];

                console.log("id "+id);
                console.log("last id "+lastMessageId);
                console.log(message);

                if (id > lastMessageId) {
                    console.log("ici");
                    displayMsg(message);
                    lastMessageId = id;
                }
                else{
                    if(lastMessageId == 9)
                    {
                        lastMessageId = id;
                    }
                    console.log("ici 2");
                }
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