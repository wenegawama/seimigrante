<?php
session_start();

// Verificar se o usuário está logado e tem um perfil definido
if (!isset($_SESSION['usuario_perfil'])) {
    header('Location: login.php');
    exit;
}

$perfil = $_SESSION['usuario_perfil'];

?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light   py-3 boxshowdow nav-bg" >
      <a href="../../index.php" class="navbar-brand"><img src="../../img/logo.png" alt="Logo" height="80px" width="80px" class="mx-4"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-2">
            <a class="nav-link" href="../../index.php">Home</a>
            </li> 
        </ul>
      </div>
    </nav>

    <div class="container mt-5">
        <div class="row mt-3">
        <?php if ($perfil != '2'): ?>
            <div class="col-md-3 mb-2 p-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Atividade</h5>
                        <p class="card-text">Criar uma nova atividade.</p>
                        <a href="../../pages/crud/crudAtividade/atividade_criar.php" class="btn btn-primary">Criar Atividade</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2 p-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Evento</h5>
                        <p class="card-text">Criar um novo evento.</p>
                        <a href="../../pages/crud/crudevento/evento_criar.php" class="btn btn-primary">Criar Evento</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2 p-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Local</h5>
                        <p class="card-text">Criar um novo local.</p>
                        <a href="../../pages/crud/crudLocal/local_criar.php" class="btn btn-primary">Criar Local</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
            
            <div class="col-md-3 mb-2 p-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Encontro</h5>
                        <p class="card-text">Criar um novo encontro.</p>
                        <a href="../../pages/crud/crudEnconto/encontro_criar.php" class="btn btn-primary">Criar encontro</a>
                    </div>
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