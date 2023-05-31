$(document).ready(function () {
    var myChart1; // Déclarer la variable myChart1 ici
    var myChart2;
    var myChart3;
    var myChart4;

    $(".prev").hide();
    $(".next").hide();
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
                console.log(data);
                $(".prev").show();
                $(".next").show();
                var jsonData = JSON.parse(data);

                // Extraire les données pertinentes pour le graphique
                var labels = Object.keys(jsonData);
                var values = Object.values(jsonData);
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
                console.log(functions);
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
                var ctx3 = document.getElementById("myChart3").getContext("2d");
                var canvas3 = document.getElementById("myChart3");
                canvas3.classList.add("canvas-background");
                // Extraire les données pertinentes pour le graphique
                var functions = jsonData.fonctions;
                console.log(functions);
                var labels3 = functions.map(function(func) {
                    return "Fonction " + func.indiceFonction;
                });
                var values3 = functions.map(function(func) {
                    return func.nbAppels;
                });

                myChart3 = new Chart(ctx3, {
                type: "bar",
                data: {
                    labels: labels3,
                    datasets: [
                    {
                        label: "Nombre d'appels",
                        data: values3,
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
                    var ctx4 = document.getElementById("myChart4").getContext("2d");
                    var canvas4 = document.getElementById("myChart4");
                    canvas4.classList.add("canvas-background");
                    myChart4 = new Chart(ctx4, {
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
                                      borderColor: [
                                        'rgb(220, 53, 69)',
                                        'rgb(25, 135, 184)',
                                        'rgb(196, 154, 8)',
                                        'rgb(45, 162, 162)',
                                        'rgb(225, 139, 34)',
                                        'rgb(70, 151, 216)',
                                        'rgb(225, 163, 7)',
                                        'rgb(190, 23, 49)',
                                        'rgb(15, 105, 54)',
                                        'rgb(228, 120, 218)'
                                      ],borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            responsive: true
                        }
                    });
                }
                
                showSlides(1);
            },
            error: function (data) {
                console.log("Erreur lors du traitement des données :", data);
            }
        });
    });
    
    $(document).keydown(function (e) {
        if (e.keyCode == 37) { // Touche de la flèche gauche
            plusSlides(-1);
        } else if (e.keyCode == 39) { // Touche de la flèche droite
            plusSlides(1);
        }
    });
});


let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("slide");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex - 1].style.display = "block";
}
