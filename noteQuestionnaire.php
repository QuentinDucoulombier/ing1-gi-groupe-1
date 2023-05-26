<?php 
$questionnaire=$_GET["questionnaire"];
$idEquipe=$_GET["equipe"];
//$dates=qetDatesquestionnaire($questionnaire);
$datedebut="2023-06-01";
$datefin="2023-06-08";
$questions=getquestion($questionnaire); 
//$reponses = getreponses($questionnaire,$idEquipe);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_POST['note-'.$i])) {
            $note=(int)$_POST['note-'.$i];
            var_dump($note);
            noterReponse($idEquipe, $i, $note);
        }   
    }
}

?>


<div id="app">
    <div id="header">
        <?php include "component/header.php"; ?>
    </div>
    <div id="middle">
        <div id="content">
            <h1>Réponse de l'équipe <?php echo $equipe?> au questionnaire n°<?php echo $questionnaire ?> Data Battle du <?php echo $datedebut?> au  <?php echo $datefin?> </h1>
            <form id="questionnaire" action="" method="POST">
                <?php 
                $i=1;
                foreach ($questions as $question){ ?>
                    <div class = "question">
                        <label for="question">Question <?php echo $i.": ".$question["intituleQuestion"]; ?></label>
                    </div>
                    <div>
                        <textarea id="question-<?php echo $i; ?>" rows="5" cols="100" readonly><?php echo $reponses[$i]?></textarea>
                    </div>
                    <fieldset>
                        <legend>Choisis une note</legend>
                        <?php for ($j = 0; $j <= 4; $j++) { ?>
                            <input type="radio" id="note-<?php echo $i; ?>-<?php echo $j; ?>" name="note-<?php echo $i; ?>" value="<?php echo $j; ?>" required>
                            <label for="note-<?php echo $i; ?>-<?php echo $j; ?>"><?php echo $j; ?></label> 
                        <?php } ?>
                    </fieldset>
                <?php $i++; }?>
                <input type="submit" value="Envoyer" class="envoi" onclick="">
                <input type="reset" value="Annuler" class="annuler">
            </form>
        </div>
    </div>

    <div id="footer">
        <?php include "component/footer.php"; ?>
    </div>
</div>
