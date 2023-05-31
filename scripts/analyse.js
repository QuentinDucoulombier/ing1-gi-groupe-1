$(document).ready(function () {
    var myChart1; // Déclarer la variable myChart1 ici
    var myChart2;
    var myChart3;
    var myChart4;
    $("#myForm").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (myChart1 !== undefined) {
                    myChart1.destroy();
                }
                if (myChart2 !== undefined) {
                    myChart2.destroy();
                }
                if (myChart3 !== undefined) {
                    myChart3.destroy();
                }
                if (myChart4 !== undefined) {
                    myChart4.destroy();
                }
                // Convertir les données JSON en objet JavaScript
                var jsonData = JSON.parse(data);

                // Extraire les données pertinentes pour le graphique
                var labels = Object.keys(jsonData);
                var values = Object.values(jsonData);
                var test= document.getElementById("test").textContent;
                $.ajax({
                url: "pages/ajoutanalyse.php?idEquipe="+test.charAt(test.length-1), // L'URL du script PHP
                type: "POST",
                data: {valeur: data}, // Les données à envoyer au script PHP
                success: function(response) {
                    console.log("Valeur ajoutée avec succès !");
                    // Faire quelque chose avec la réponse du script PHP, si nécessaire
                },
                error: function(xhr, status, error) {
                    console.error("Erreur lors de l'ajout de la valeur : " + error);
                }
                });
                var ctx1 = document.getElementById("myChart1").getContext("2d");
                var canvas1 = document.getElementById("myChart1");
                canvas1.classList.add("canvas-background");
                myChart1 = new Chart(ctx1, {
                    type: "bar",
                    data: {
                        labels: labels.slice(0,5),
                        datasets: [
                            {
                                label: "Valeur",
                                data: values.slice(0,5),
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'
                                  ],
                                  borderColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                  ],
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }   
                    }
                });
                var ctx2 = document.getElementById("myChart2").getContext("2d");
                var canvas2 = document.getElementById("myChart2");
                canvas2.classList.add("canvas-background");
                // Extraire les données pertinentes pour le graphique
                var functions = jsonData.fonctions;
                var labels2 = functions.map(function(func) {
                    return "Fonction " + func.indiceFonction;
                });
                var values2 = functions.map(function(func) {
                    return func.nbLignes;
                });

                myChart2 = new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: labels2,
                    datasets: [
                    {
                        label: "Nombre de lignes",
                        data: values2,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                          ],
                          borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                          ],
                        borderWidth: 1
                    }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                    y: {
                        beginAtZero: true
                    }
                    }
                }
                });
                
                if (labels.length>=6) { 
                    var ctx3 = document.getElementById("myChart3").getContext("2d");
                    var canvas3 = document.getElementById("myChart3");
                    canvas3.classList.add("canvas-background");
                    myChart3 = new Chart(ctx3, {
                        type: "pie", // Changer le type en "pie" pour un graphique en camembert
                        data: {
                            labels: labels.slice(6,labels.length),
                            datasets: [
                                {
                                    label: "Occurence du terme dans le code",
                                    data: values.slice(6,values.length),
                                    backgroundColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)',
                                        'rgb(255, 205, 86)',
                                        'rgb(75, 192, 192)',
                                        'rgb(255, 159, 64)',
                                        'rgb(100, 181, 246)',
                                        'rgb(255, 193, 7)',
                                        'rgb(220, 53, 69)',
                                        'rgb(25, 135, 84)',
                                        'rgb(238, 130, 238)'
                                      ],
                                }
                            ]
                        },
                        options: {
                            responsive: true
                        }
                    });
                }
            },
            error: function (data) {
                console.log("Erreur lors du traitement des données :", data);
            }
        });
    });
});
