<?php
require_once __DIR__ . '/../db/DBConnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $duracao = $_POST['duracao'];
    $db = new DBConnection();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("INSERT INTO atividade (descricao, duracao) VALUES (?, ?)");
    $stmt->execute([$descricao, $duracao]);
    header('Location: atividade_listar.php');
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Atividade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Nova Atividade</h1>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <input type="text" name="descricao" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Duração (hh:mm:ss)</label>
            <input type="time" name="duracao" class="form-control" required step="1">
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="atividade_listar.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>