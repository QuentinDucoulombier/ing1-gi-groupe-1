<?php
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
?>