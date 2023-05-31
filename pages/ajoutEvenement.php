<form action="action/verif_evenement.php" method="post" onsubmit="return validateEvenement()">
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


</form>