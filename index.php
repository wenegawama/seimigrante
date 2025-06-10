<?php

?>


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
      <a href="index.php" class="navbar-brand"><img src="img/newLogo.jpg" alt="Logo" height="80px" width="80px" class="mx-4"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-2">
            <a class="nav-link" href="index.php">Home</a>
          </li>
         
          <li class="nav-item mx-2">
            <a class="nav-link" href="pages/sei.php">Mapa</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="pages/crud/crudLocal/local_criar.php">Local</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="pages/crud/crudEnconto/encontro_criar.php">Encontro</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="pages/crud/crudAtividade/atividade_criar.php">Atividade</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="pages/crud/crudevento/evento_criar.php">Evento</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="pages/auth/login.php">Login</a>
          </li>
          <li class="nav-item mx-2">
            <a class="btn btn-outline-primary ms-md-2" href="pages/auth/registrar.php">Inscreva-se</a>
          </li>
        </ul>
      </div>
    </nav>


    <div class="container mt-1 pt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h1 class="text-center mb-1 text-white">Visualizar locais de eventos no mapa?</h1>
                <a href="pages/sei.php" class="text-white text-center"><h2 >Clique aqui!</h2></a><!--Aqui vai ficar o mapa com os loais de eventos-->
         
        </div>
      </div>
    </div>

    <footer class="text-black mt-5">
        <div class="container text-center py-4">
            <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
            <p> Todos os direitos reservados.</p>
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>