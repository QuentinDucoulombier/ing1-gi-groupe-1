<link rel="stylesheet" href="styles/component/groupMessage.css" />

<div id="groupMessage">
    <?php

        if (isset($_SESSION['email']))
        {
            $user = getUser($_SESSION['email']);

            if ($user[0]['type'] == "Administrateur" || ($user[0]['type'] == "Gestionnaire" && checkGestionnaireProjet($user[0]['email'], $battle['nomEvenement']) )) {

                $idTeam = $_POST["idTeam"];
                $nameEquipe = getNameGroup($idTeam);
                echo '
                <h1>Message groupé a l\'équipe '.$nameEquipe["nomEquipe"].'</h1>
                <form action="../action/chat/newGroupMessage.php" method="POST">
                    <input type="hidden" name="idEquipe" value="'.$idTeam.'"/>
                    <label for="message">Votre message</label>
                    <input type="text" name="message" />
                    <input type="submit" value="Envoie message"/>

                </form>
                ';
            }else {
                header ('Location: /?page=404');
            }
        }else{
            header ('Location: /?page=404');
        }
    ?>
</div>