<?php 
session_start();
$questionnaire=$_GET["idQuestionnaire"];//passer en parametre (get) l'id du questionnaire

$dates=getDatesquestionnaire($questionnaire);

$datedebut=$dates["dateDebut"];
$datefin=$dates["dateFin"];
$questions=getquestion($questionnaire);
$idEquipe=$_SESSION['idTeam'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $i=1;
    foreach($questions as $question) {
        if (isset($_POST['question-'.$i])) {
            $reponse = $_POST['question-'.$i];
            setReponse($idEquipe, $question["idQuestion"], $reponse);
        }
        $i++;
    }
    header("Location: /?page=evenements");
}   

?>

<div id="app">
    <div id="header">
        <?php include "component/header.php"; ?>
    </div>
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

    <div id="footer">
        <?php include "component/footer.php"; ?>
    </div>
</div>

<style>
    h1{
        text-align:center;
    }
    #questionnaire{
        width:800px;
        border-radius: 20px;
        margin: auto;
        padding: 15px;
        padding-top: 25px;
        background-color: rgb(255, 255, 255);
        box-shadow: 0 0 5px rgba(134, 134, 134, 0.4);
    }
</style>