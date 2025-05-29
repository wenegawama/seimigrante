<?php
require_once __DIR__ . '../../../../db/DBConnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $cep = $_POST['cep'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $contato = $_POST['contato'];
    $db = new DBConnection();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("INSERT INTO local (descricao, cep, numero, complemento, contato) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$descricao, $cep, $numero, $complemento, $contato]);
    header('Location: local_listar.php');
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Local</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Header fixo -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">SEI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <h1>Novo Local</h1>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <input type="text" name="descricao" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">CEP</label>
            <input type="text" name="cep" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Número</label>
            <input type="number" name="numero" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Complemento</label>
            <input type="text" name="complemento" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Contato</label>
            <input type="text" name="contato" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="local_listar.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>