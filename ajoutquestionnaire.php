<?php 
$idQuestionnaire=5;
$idDataBattle=2;
//$dates=getDatesquestionnaire($questionnaire);
$datedebut="2023-06-01";
$datefin="2023-06-08";
//$reponses = getreponses($questionnaire,$idEquipe);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datedebutQ=$_POST["date_debut"];
    $datefinQ=$_POST["date_fin"];
    var_dump($datedebutQ);
    var_dump($datefinQ);
    var_dump($idDataBattle);
    addQuestionnaire($idDataBattle,$datedebutQ,$datefinQ);  
    for ($i = 1; $i <= 4; $i++) {
        if (isset($_POST['question-'.$i])) {
            $intitule=$_POST['question-'.$i];
            addQuestion($idQuestionnaire, $intitule);
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
            <h1>Création du questionnaire n°<?php echo $questionnaire ?> Data Battle du <?php echo $datedebut?> au  <?php echo $datefin?> </h1>
            
            <form id="questionnaire" action="" method="POST">
                <div>
                    <label for="date_debut" class="">Date de début du questionnaire:</label>
                    <input type="date" id="date_debut" name="date_debut" required>
                </div>
                <div>
                    <label for="date_fin" class="">Date de fin du questionnaire:</label>
                    <input type="date" id="date_fin" name="date_fin" required>
                </div>
                
                <div id="questions-container">
                    <?php
                    for ($i=1;$i<=4;$i++){ ?>
                        <div class = "question">
                            <label for="question">Question <?php echo $i?></label>
                        </div>
                        <div>
                            <textarea id="question-<?php echo $i; ?>" name="question-<?php echo $i; ?>" rows="5" cols="100" required></textarea>
                        </div>
    
                    <?php }?>
                </div>
                <div><button type="button" onclick="ajouterQuestion()">Ajouter question</button></div>
                <input type="submit" value="Créer questionnaire" class="envoi">
                <input type="reset" value="Annuler" class="annuler">
            </form>
        </div>
    </div>

    <div id="footer">
        <?php include "component/footer.php"; ?>
    </div>
</div>

<script>
    function ajouterQuestion() {
        var container = document.getElementById('questions-container');
        var questionNumber = container.childElementCount / 2 + 1;

        var questionDiv = document.createElement('div');
        questionDiv.classList.add('question');
        questionDiv.innerHTML = '<label for="question">Question ' + questionNumber + '</label>';

        var textareaDiv = document.createElement('div');
        textareaDiv.innerHTML = '<textarea id="question-' + questionNumber + '" rows="5" cols="100" required></textarea>';

        container.appendChild(questionDiv);
        container.appendChild(textareaDiv);
    }
</script>
