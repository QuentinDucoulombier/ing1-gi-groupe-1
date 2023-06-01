/**
 * @fn function sendGithub() 
 * @returns un message dans le php
 */
function sendGithub() {
    event.preventDefault(); // Empêche le rechargement de la page lors de la soumission du formulaire

    var githubInput = document.getElementById("github");
    var statutDiv = document.getElementById("statut");

    if (githubInput.value.trim() === "" || !isValidGithubUrl(githubInput.value)) {
        // Si l'input est vide ou n'est pas un lien GitHub valide
        statutDiv.textContent = "Veuillez entrer une URL GitHub valide.";
        statutDiv.style.color = "red";
    } else {
        // Si l'input contient une URL GitHub valide
        statutDiv.textContent = "Le lien a bien été envoyé.";
        statutDiv.style.color = "green";
    }
}

/**
 * @fn function isValidGithubUrl(url) 
 * @param {*} url l'url a verifié
 * @returns true si l'url est de type github
 */
function isValidGithubUrl(url) {
    var githubUrlPattern = /^https?:\/\/github.com\/.*$/i;
    return githubUrlPattern.test(url);
}
