<?php 

$idProjetData=1;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($analyse);
    
}
?>


<h1>Analyse du code</h1>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- librairy chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../scripts/analyse.js"></script>

<form id="myForm" enctype="multipart/form-data" action="http://localhost:8001/test" method="post">
    <input type="file" name="pythonFile">
    <input type="text" name="keywords" placeholder="Entrer les mots séparés par une virgule"> 
    <input type="submit" value="Envoyer">
</form>

<div class="slideshow-container">
        <div class="slide">
            <canvas id="myChart1"></canvas>
        </div>
        <div class="slide">
            <canvas id="myChart2"></canvas>
        </div>
        <div class="slide">
            <canvas id="myChart3"></canvas>
        </div>
        <div class="slide">
            <canvas id="myChart4"></canvas>
        </div>
        <!-- Ajoutez ici les autres canvas -->
        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)" >&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>


