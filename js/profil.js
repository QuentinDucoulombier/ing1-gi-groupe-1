
var modal = document.getElementById("modifierModal");

// When the user clicks on the button, open the modal
function openModifierModal() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function closeModifierModal() {
    modal.style.display = "none";
}

// function inscrire() {
//     var xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function () {
//         if (this.readyState == 4 && this.status == 200) {
//             // Handle successful login
//             var response = this.responseText;
//             if (response == "success") {
//                 closeMdpModal();
//                 alert("Modification Validée");
//             } else if (response == "utilise") {
//                 alert("Utilisateur deja pris");
//             } else {
//                 alert("Modification non validée");
//             }
//         }
//     };

//     xhr.open("POST", "/action/modifierMdp.php", true);
//     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     var password = document.getElementById("passwordmdf").value;
//     var newPassword = document.getElementById("newPassword").value;
//     var confirm_password = document.getElementById("confirm_passwordmdf").value;


//     if (newPassword === confirm_password) {
//         var data = "password=" + encodeURIComponent(password) + "&newPassword=" + encodeURIComponent(newPassword) + "&confirm_password=" + encodeURIComponent(confirm_password);
//         xhr.send(data);
//     } else {
//         alert("Les mots de passe ne correspondent pas.");
//     }

//}