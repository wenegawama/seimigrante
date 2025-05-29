<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primay">
      <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">SEI</a>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="/pages/logout.php">Sair</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mt-5">
        <!--<h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h1>-->
        <!--<p>Você está logado no sistema.</p>-->

        <div class="row mt-3">
            <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Atividade</h5>
                        <p class="card-text">Criar uma nova atividade.</p>
                        <a href="atividade_criar.php" class="btn btn-primary">Criar Atividade</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Evento</h5>
                        <p class="card-text">Criar um novo evento.</p>
                        <a href="evento_criar.php" class="btn btn-primary">Criar Evento</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Local</h5>
                        <p class="card-text">Criar um novo local.</p>
                        <a href="local_criar.php" class="btn btn-primary">Criar Local</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Encontro</h5>
                        <p class="card-text">Criar um novo encontro.</p>
                        <a href="encontro_criar.php" class="btn btn-primary">Criar Local</a>
                    </div>
                </div>
            </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>