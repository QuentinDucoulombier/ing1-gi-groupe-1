<?php 

$questionnaire=$_GET["questionnaire"];//passer en parametre l'id du questionnaire

//$dates=qetDatesquestionnaire($questionnaire);

$datedebut="2023-06-01";
$datefin="2023-06-08";
$questions=getquestion($questionnaire);
$idEquipe=$_GET["questionnaire"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_POST['question-'.$i])) {
            $reponse = $_POST['question-'.$i];
            setReponse($idEquipe, $i, $reponse);
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
            <h1>Questionnaire n°<?php echo $questionnaire ?> Data Battle du <?php echo $datedebut?> au  <?php echo $datefin?> </h1>
            <form id="questionnaire" action="" method="POST">
                <?php 
                $i=1;
                foreach ($questions as $question){ ?>
                    <div class = "question">
                        <label for="question">Question <?php echo $i.": ".$question["intituleQuestion"]; ?></label>
                    </div>
                    <div>
                        <textarea id="question-<?php echo $i; ?>" name="question-<?php echo $i; ?>" rows="5" cols="100" placeholder="Saisir votre réponse"></textarea>
                    </div>
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