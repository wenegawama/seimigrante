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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">SEI</a>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Sair</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mt-5">
        <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h1>
        <p>Você está logado no sistema.</p>
    </div>
</body>
</html>