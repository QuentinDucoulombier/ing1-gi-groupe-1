<link rel="stylesheet" href="styles/component/ajoutEvenement.css" />

<form action="action/addEvenement.php" method="post" onsubmit="return validateEvenement()">
    <h3>Créer un évenement</h3>

    <div id="request-type">
        <div class="field">                            
            <label for="gender">Type d'évènement :</label>                            
            <p class="needed" id="needed-type">
                Champs requis
            </p>                            
        </div>
        <div id="evenement-buttons">
            <p>
                <input type="radio" id="dataChallenge" name="evenement" value="Data Challenge">
                <label for="dataChallenge">Data Challenge</label>
            </p>
            <p>
                <input type="radio" id="dataBattle" name="evenement" value="Data Battle">
                <label for="dataBattle">Data Battle</label>
            </p>

        </div>
    </div>

    <div id="request-name">

        <div class="field">
            <label for="nomEvenement">Nom de l'évènement : </label>

            <div class="needed" id="needed-name">
                <p>Champs requis</p>
            </div>
        </div>
        
        <input type="text" name="nomEvenement" id="nomEvenement">
    </div>

    <div id="request-dateDebut">

        <div class="field">
            <label for="dateDebut">Date de début :</label>
            <div class="needed" id="needed-dateDebut">
                <p>Champs requis</p>
            </div>                            
        </div>

        <input type="date" name="dateDebut" id="dateDebut">
    </div>

    <div id="request-dateFin">

        <div class="field">
            <label for="dateFin">Date de fin :</label>
            <div class="needed" id="needed-dateFin">
                <p>Champs requis</p>
            </div>                            
        </div>

        <input type="date" name="dateFin" id="dateFin">
    </div>


    <div id="request-description">
        <div class="field">
            <label for="description">Description :</label>
                          
        </div>
        <textarea type="text" name="description" id="description" rows="10" cols="66"></textarea>
    </div>

    <div id="request-image">
        <div class="field">
            <label for="image">Insérer une image :</label>                            
        </div>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg">
    </div>

    <div>
        <input type="submit" value="Ajouter un projet">
    </div>


</form>


<script src="scripts/manageEvenements.js" defer></script>