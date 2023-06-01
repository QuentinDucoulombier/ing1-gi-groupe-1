<link rel="stylesheet" href="styles/component/ajoutEvenement.css" />

<?php
if(isset($_GET['projet'])){
    $id = $_GET['projet'];
}

$projet = getProjetDatabyID($id)
?>

<form action="action/updateProjet.php" method="post">
    <h3>Modifier le projet</h3>

    <div id="request-name">

        <div class="field">
            <label for="nomProjet">Nom du projet : </label>
        </div>
        
        <input type="text" name="nomProjet" id="nomProjet" value="<?php echo $projet['nomProjet'] ?>">
    </div>


    <div id="request-description">
        <div class="field">
            <label for="description">Description :</label>                         
        </div>
        <textarea type="text" name="description" id="description" rows="10" cols="66"><?php echo $projet['description'] ?></textarea>
    </div>




    <div id="request-conseil">
        <div class="field">
            <label for="conseil">Conseils :</label>                          
        </div>
        <textarea type="text" name="conseil" id="conseil" rows="10" cols="66"><?php echo $projet['conseil'] ?></textarea>
    </div>



    <div id="request-consigne">
        <div class="field">
            <label for="consigne">Consignes :</label>                          
        </div>
        <textarea type="text" name="consigne" id="consigne" rows="10" cols="66"><?php echo $projet['consigne'] ?></textarea>
    </div>


    <div id="request-fichier">
        <div class="field">
            <label for="fichier">URL Fichier :</label>
                          
        </div>
        <input type="url" pattern="https://.*" name="fichier" id="fichier" value="<?php echo $projet['urlFichier'] ?>">
    </div>


    <div id="request-video">
        <div class="field">
            <label for="video">URL Vidéo :</label>
                        
        </div>
        <input type="url" pattern="https://.*" name="video" id="video" value="<?php echo $projet['urlVideo'] ?>">
    </div>

    <div id="request-image">
        <div class="field">
            <label for="image">Insérer une image :</label>                            
        </div>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg">
    </div>
    
    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
    
    
    <div id="submit">
        <input type="submit" name="action" value="Modifier le projet">
    </div>


</form>

<script src="scripts/manageEvenements.js" defer></script>