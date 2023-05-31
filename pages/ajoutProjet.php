<link rel="stylesheet" href="styles/component/ajoutEvenement.css" />

<?php
if(isset($_GET['evenement'])){
    $evenement = $_GET['evenement'];
}
if(isset($_GET['type'])){
    $type = $_GET['type'];
}
?>

<form action="action/addProjet.php" method="post" onsubmit="return validateProjet()">
    <h3>Ajouter un projet</h3>

    <div id="request-name">

        <div class="field">
            <label for="nomProjet">Nom du projet : </label>

            <div class="needed" id="needed-name">
                <p>Champs requis</p>
            </div>
        </div>
        
        <input type="text" name="nomProjet" id="nomProjet">
    </div>


    <div id="request-description">
        <div class="field">
            <label for="description">Description :</label>
                          
        </div>
        <textarea type="text" name="description" id="description" rows="10" cols="66"></textarea>
    </div>




    <div id="request-conseil">
        <div class="field">
            <label for="conseil">Conseils :</label>
                          
        </div>
        <textarea type="text" name="conseil" id="conseil" rows="10" cols="66"></textarea>
    </div>



    <div id="request-consigne">
        <div class="field">
            <label for="consigne">Consignes :</label>
                          
        </div>
        <textarea type="text" name="consigne" id="consigne" rows="10" cols="66"></textarea>
    </div>


    <div id="request-fichier">
        <div class="field">
            <label for="fichier">URL Fichier :</label>
                          
        </div>
        <input type="url" pattern="https://.*" name="fichier" id="fichier">
    </div>


    <div id="request-video">
        <div class="field">
            <label for="video">URL Vidéo :</label>
                        
        </div>
        <input type="url" pattern="https://.*" name="video" id="video">
    </div>

    <div id="request-image">
        <div class="field">
            <label for="image">Insérer une image :</label>                            
        </div>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg">
    </div>
    
    <input type="hidden" name="id" value="<?php echo isset($evenement) ? $evenement : ''; ?>">
    <input type="hidden" name="type" value="<?php echo isset($type) ? $type : ''; ?>">


    <div id="submit">
        <input type="submit" name="action" value="Valider le projet">

        <?php
        if ($type=="dataChallenge")
            echo '<input type="submit" name="action" value="Valider et ajouter un autre projet">'
        ?>
        </div>


</form>


<script src="scripts/manageEvenements.js" defer></script>
<script>
        sessionStorage.setItem("redirect", "1");
        if ((new URLSearchParams(location.search)).has("v")) {
            history.replaceState({}, "", location.href.toString().replace(location.search, ""));
            alert('Le projet a bien été ajouté');
        }
    </script>