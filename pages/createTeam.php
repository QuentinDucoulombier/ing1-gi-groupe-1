<link rel="stylesheet" href="styles/component/createTeam.css" />
<?php
    /*verif connexion et statut*/
    if (!isset($_SESSION['email'])) {
        header ('Location: /?page=404');
    } else {
        $user = getUser($_SESSION['email']);
        if ($user[0]['type'] != "Etudiant") 
        {
            header ('Location: /?page=404');
        }
    }
?>
<div id="createTeam">
    <h1>Creation de votre equipe</h1>
    <form action="../action/creationTeam.php" method="POST">
        <label for="nomEquipe">Nom d'équipe:</label>
        <input type="text" name="nomEquipe" id="nomEquipe" required>
        
        <input type="submit" value="Créer équipe">
    </form>

</div>