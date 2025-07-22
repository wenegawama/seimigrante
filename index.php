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
  <nav class="navbar navbar-expand-md navbar-light py-3 boxshowdow nav-bg">
    <div class="container-fluid">
      <a href="index.php" class="navbar-brand">
        <img src="img/newLogo.jpg" alt="Logo" height="80" width="80" class="mx-2">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav justify-content-center w-100 mb-2 mb-md-0">
          <li class="nav-item mx-2">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="pages/auth/dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="pages/crud/crudAtividade/atividade_criar.php">Atividade</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="pages/crud/crudLocal/local_criar.php">Local</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="pages/crud/crudevento/evento_criar.php">Evento</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="pages/crud/crudEncontro/encontro_criar.php">Encontro</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="pages/auth/login.php?erro=Digite email e senha!">Login</a>
          </li>
          <li class="nav-item mx-2">
            <a class="btn btn-outline-primary ms-md-2" href="pages/auth/registrar.php">Inscreva-se</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4 pt-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <h2 class="text-center mb-3 text-white">
          Visualizar locais de eventos no mapa?
          <a class="nav-link d-inline text-primary text-white" style="display:inline;" href="pages/sei.php">Clique Aqui!</a>
        </h2>
      </div>
    </div>
  </div>

  <footer class="text-black mt-5">
    <div class="container text-center py-4">
      <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
      <p>Todos os direitos reservados.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>