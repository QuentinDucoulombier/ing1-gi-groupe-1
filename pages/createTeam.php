<link rel="stylesheet" href="styles/component/createTeam.css" />

<div id="createTeam">
    <h1>Creation de votre equipe</h1>
    <form action="../action/creationTeam.php" method="POST">
        <label for="nomEquipe">Nom d'équipe:</label>
        <input type="text" name="nomEquipe" id="nomEquipe" required>
        
        <input type="submit" value="Créer équipe">
    </form>

</div>