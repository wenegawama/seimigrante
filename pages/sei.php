<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de eventos para imigrantes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-light   py-3 boxshowdow nav-bg" >
      <a href="../index.php" class="navbar-brand"><img src="../img/newLogo.jpg" alt="Logo" height="80px" width="80px" class="mx-4"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-2">
            <a class="nav-link" href="../index.php">Home</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="../pages/auth/login.php?erro=Digite email e senha!">Login</a></li>
          <li class="nav-item mx-2">
            <a class="btn btn-outline-primary ms-md-2" href="../pages/auth/registrar.php">Inscreva-se</a>
          </li>
        </ul>
      </div>
    </nav>
	
	<div id="map"> 

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" 
	integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="anonymous" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js" 
	integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="anonymous"></script>
	<style>
	  #map {
		height: 80vh;
		width: 60hw
	  }
	</style>

	<script>
	  var  map = L.map('map').setView([-25.2917, -49.23012], 12);
	  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
		minZoom: 1,
		maxZoom: 19
	  }).addTo(map);

	  //const url = "https://seusiteoudominio.com/coordenadas.php" (caso nao esteja no mesmo servidor)
	  const url = 'seicoordenadas.php'; // api responsavel por buscar os dados que estao salvos no banco.

	  fetch(url)
		.then(response => response.json())
		.then(result => {
		  const dados = JSON.stringify(result);
		  result.forEach(function(retorno) {
			if (retorno.Icone == 1)
			{
				retorno.Icone = 'Grave';
			  	var myIcon = L.icon({
				iconUrl: '../img/my-icon.png',
				iconSize: [24, 41],
				iconAnchor: [24, 41],
				popupAnchor: [-10, -38],
				//shadowUrl: 'marker-icon.png',
				//shadowSize: [68, 95],
				//shadowAnchor: [22, 94]
				});
			}else{
				retorno.Icone = 'Leve a Moderado';
			  	var myIcon = L.icon({
				iconUrl: '../img/marker-icon.png',
				iconSize: [24, 41],
				iconAnchor: [24, 41],
				popupAnchor: [-10, -38],
				//shadowUrl: 'my-icon-shadow.png',
				//shadowSize: [68, 95],
				//shadowAnchor: [22, 94]
				});
			}			
			var location = new L.LatLng(retorno.lat, retorno.lng);
			console.log("RETORNO ",result);
			var markerGroup = L.featureGroup([]).addTo(map);
			var latLng = L.latLng([retorno.lat, retorno.lng]);
			L.marker(latLng, {icon: myIcon}).bindPopup('<b><u>Contato: ' + retorno.type +
			  '</u></b><br>* Local: ' + retorno.name +
			  '<br>* Cidade: ' + retorno.city +
			  '<br>* Bairro: ' + retorno.district +
			  '<br>* ' + retorno.rua).addTo(markerGroup).addTo(map);
		  });
		})
		.catch(function(err) {
		  console.error(err);
		})
	</script>

    <footer class="text-black mt-5">
        <div class="container text-center py-4">
            <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
            <p> Todos os direitos reservados.</p>
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>