<?php
// La page s'affiche uniquement si l'utilisateur est un administrateur ou un gestionnaire du data Challenge
if (isset($_SESSION['email']) && (isset($_GET['evenement']))){

    $idevenement = $_GET['evenement'];
    $user = getUser($_SESSION['email']);
    $evenement = getEvenementbyID($idevenement);

    if ($user[0]['type'] == "Administrateur") { ?>
            
        <link rel="stylesheet" href="styles/component/ajoutEvenement.css" />

        <form action="action/updateEvenement.php" method="post">
            <h3>Modifier l'évenement</h3>

            <div id="request-name">

                <div class="field">
                    <label for="nomEvenement">Nom de l'évènement : </label>
                </div>
                
                <input type="text" name="nomEvenement" id="nomEvenement" value="<?php echo $evenement['nomEvenement'] ?>">
            </div>

            <div id="request-dateDebut">

                <div class="field">
                    <label for="dateDebut">Date de début :</label>
                    <p><?php echo $evenement['dateD'] ?></p>                                              
                </div>

                <input type="date" name="dateDebut" id="dateDebut">
            </div>

            <div id="request-dateFin">

                <div class="field">
                    <label for="dateFin">Date de fin : </label>
                    <p><?php echo $evenement['dateF'] ?></p>                        
                </div>

                <input type="date" name="dateFin" id="dateFin">
            </div>


            <div id="request-description">
                <div class="field">
                    <label for="description">Description : </label>
                    <?php echo ($evenement['descriptionEvent']) ?>
                                
                </div>
                <textarea type="text" name="description" id="description" rows="10" cols="66"><?php echo $evenement['descriptionEvent'] ?></textarea>
            </div>

            <div id="request-image">
                <div class="field">
                    <label for="image">Insérer une image :</label>                            
                </div>
                <input type="file" id="image" name="image" accept="image/png, image/jpeg">
            </div>

            <div>
                <input type="submit" value="Modifier l'évènement">
            </div>


        </form>


        <script src="scripts/manageEvenements.js" defer></script>

        <?php
            }
        else{
            header ('Location: /?page=404');

        }
    }
else{
    header ('Location: /?page=404');

}
?>