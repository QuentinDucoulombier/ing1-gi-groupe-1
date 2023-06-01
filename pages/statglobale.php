<?php 
$idProjetData=$_GET["ProjetData"];

$data=getanalyseCode($idProjetData);


// Tableaux pour les labels et les données du graphique
$labels = array();
$dataValues = array();

// Parcourir le tableau de données
foreach ($data as $equipe) {
    // Vérifier si l'analyseProjet est définie
    if (isset($equipe["analyseProjet"])) {
        // Récupérer le JSON de l'analyseProjet
        $json = $equipe["analyseProjet"];

        // Convertir le JSON en tableau associatif
        $analyseProjet = json_decode($json, true);

        // Récupérer le nombre de lignes de l'analyseProjet
        $nbLignes = $analyseProjet["nbLignes"];
        $nbFonctions= $analyseProjet["nbFonctions"];
        // Ajouter l'équipe au tableau des labels
        $labels[] = "Équipe " . $equipe["idEquipe"];

        // Ajouter le nombre de lignes au tableau des données
        $dataValues1[] = $nbLignes;
        $dataValues2[] = $nbFonctions;
        
    }
}

?>
<h1 id="test">Analyse code ProjetData <?php echo $idProjetData?></h1>
<div class="chart1">
    <p>Comparaison nombre de lignes par équipe</p>
    <canvas id="myChart1"></canvas>
</div>
<div class="chart2">
    <p>Comparaison nombre de fonctions par équipe</p>
    <canvas id="myChart2"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    // Données des équipes
    var labels = <?php echo json_encode($labels); ?>;
    var nbLignes = <?php echo json_encode($dataValues1); ?>;
    var nbFonctions = <?php echo json_encode($dataValues2); ?>;
    // Création du pie chart avec Chart.js
    var ctx1 = document.getElementById("myChart1").getContext("2d");
    new Chart(ctx1, {
        type: "pie",
        data: {
            labels: labels,
            datasets: [{
                label: "nombre de lignes de code",
                data: nbLignes,
                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#99CCFF", "#FF99CC"] // Couleurs pour chaque équipe
            }]
        },
        options: {
            responsive: true,
        }
    });
    var ctx2 = document.getElementById("myChart2").getContext("2d");
    new Chart(ctx2, {
        type: "pie",
        data: {
            labels: labels,
            datasets: [{
                label: "nombre de fonctions",
                data: nbFonctions,
                backgroundColor: ["#4BC0C0", "#FF9F40", "#9966FF", "#F0DB4F", "#B3FF66"]         
            }]
        },
        options: {
            responsive: true,
        }
    });
</script>

<style>
    /* Style pour le titre */
    #test {
        font-size: 24px;
        color: #333;
        text-align: center;
    }

    /* Style pour le conteneur du premier graphique */
    .chart1 {
        width:400px;
        height:400px;
        margin: 20px auto;
        text-align: center;
    }

    /* Style pour le paragraphe du premier graphique */
    .chart1 p {
        font-size: 18px;
        color: #666;
        margin-bottom: 10px;
    }

    /* Style pour le conteneur du deuxième graphique */
    .chart2 {
        width:400px;
        height:400px;
        margin: 40px auto;
        text-align: center;
    }

    /* Style pour le paragraphe du deuxième graphique */
    .chart2 p {
        font-size: 18px;
        color: #666;
        margin-bottom: 10px;
    }
</style>
