<?php
require_once __DIR__ . '/../db/DBConnection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de eventos para imigrantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 80vh;
            width: 100%;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light py-3 boxshowdow nav-bg">
        <a href="../index.php" class="navbar-brand">
            <img src="../img/logo.png" alt="Logo" height="80px" width="80px" class="mx-4">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-white mt-4">Pontos de eventos</h1>
        <div id="map"></div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-25.2917, -49.23012], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            minZoom: 1,
            maxZoom: 19
        }).addTo(map);

        fetch('seicoordenadas.php')
            .then(response => response.json())
            .then(result => {
                result.forEach(function(retorno) {
                    var myIcon = L.icon({
                        iconUrl: '../img/marker-icon.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34]
                    });

                    if (retorno.lat && retorno.lng) {
                        L.marker([retorno.lat, retorno.lng], {icon: myIcon})
                            .bindPopup(`
                                <b>Local:</b> ${retorno.name}<br>
                                <b>Contato:</b> ${retorno.type}<br>
                                <b>Cidade:</b> ${retorno.city}<br>
                                <b>Bairro:</b> ${retorno.district}<br>
                                <b>Endereço:</b> ${retorno.rua}
                            `)
                            .addTo(map);
                    }
                });
            })
            .catch(error => console.error('Erro:', error));
    </script>
</body>
</html>