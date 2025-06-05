<?php
require_once __DIR__ . '/../db/DBConnection.php';
$db = new DBConnection();
$conn = $db->getConnection();

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: atividade_listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $duracao = $_POST['duracao'];
    $stmt = $conn->prepare("UPDATE atividade SET descricao = ?, duracao = ? WHERE idAtividade = ?");
    $stmt->execute([$descricao, $duracao, $id]);
    header('Location: atividade_listar.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM atividade WHERE idAtividade = ?");
$stmt->execute([$id]);
$atividade = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$atividade) {
    header('Location: atividade_listar.php');
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Atividade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Atividade</h1>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <input type="text" name="descricao" class="form-control" value="<?= htmlspecialchars($atividade['descricao']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Duração (hh:mm:ss)</label>
            <input type="time" name="duracao" class="form-control" value="<?= $atividade['duracao'] ?>" required step="1">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="atividade_listar.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>