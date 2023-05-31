<?php 

$idProjetData=1;
$idEquipe=2; //passer en parametre l'équipe

?>


<h1 id="test">Analyse code Equipe <?php echo $idEquipe?></h1>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../scripts/analyse.js"></script>

<section class="analysecode">
<form id="myForm" enctype="multipart/form-data" action="http://localhost:8001/test" method="post">
    <input type="file" name="pythonFile">
    <input type="text" name="keywords" placeholder="Entrer les mots séparés par une virgule"> 
    <input type="submit" value="Envoyer">
</form>

    <div class="chart-container">
        <div class="slide">
            <canvas id="myChart1"></canvas>
        </div>
        <div class="slide">
            <canvas id="myChart2"></canvas>
        </div>
    </div>
    <div class="slide">
        <canvas id="myChart3"></canvas>
    </div>
</section>

