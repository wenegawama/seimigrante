<?php

require_once __DIR__ . '/../db/DBConnection.php';

/* A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();  
if (!isset($_SESSION['UsuarioNivel']))
{
  session_destroy();
  require_once __DIR__ . '../';
  header('Location: /../index.php?erro=<h2>Preencha Login e Senha para acessar a Geolocalização.');
  exit;
}  
if (@$_SESSION['UsuarioNivel'] != 0)
{ 
  //echo $_SESSION['UsuarioNivel'];
  $nivel_necessario = $_SESSION['UsuarioNivel'];

  // Verifica se não há a variável da sessão que identifica o usuário
  if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel']<$nivel_necessario)) 
  {
	  // Destrói a sessão por segurança
	  session_destroy();
	  // Redireciona o visitante de volta pro login
	  header("Location: index.php?erro=<h2>Preencha Login e Senha para acessar a Geolocalização"); 
	  exit;
  }
}
@$nivel_necessario = $_SESSION['UsuarioNivel'];
//if ($nivel_necessario == 1 || $nivel_necessario  == 0) {
*/
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de eventos para imigrantes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <nav class="navbar navbar-expand-md bg-primary-subtle">
    <div class="container-fluid">
      
      <a class="navbar-brand" href="#"><img src="../imagens/logo.png" alt="Image" height="100" width="100"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="pages/registrar.php">Registrar-se</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/login.php">Login</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Eventos
			  </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="pages/atividade_criar.php">Criar</a></li>
              <li><a class="dropdown-item" href="#">Editar</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Outros</a></li>
            </ul>
          </li>
         
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Pesquise ..." aria-label="Search">
          <button class="btn btn-outline-primary" type="submit">Procurar</button>
        </form>
      </div>
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
	  var  map = L.map('map').setView([-25.2917, -49.23012], 15);
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
				iconUrl: '../imagens/my-icon.png',
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
				iconUrl: '../imagens/marker-icon.png',
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
	<?php
	//}else{
		// Perfil é diferente de 1=Acesso Total
	//	header("location:menu.php?erro=<h2>Acesso Negado para Consultar Mapa de Geolocalização de Pacientes com COVID!");
	//}
	?>	
	</div>
  </body>
</html>