<?php
require_once __DIR__ . '../../../../db/DBConnection.php';
$db = new DBConnection();
$conn = $db->getConnection();

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: local_listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $cep = $_POST['cep'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $contato = $_POST['contato'];
    $stmt = $conn->prepare("UPDATE local SET descricao = ?, cep = ?, numero = ?, complemento = ?, contato = ? WHERE idLocal = ?");
    $stmt->execute([$descricao, $cep, $numero, $complemento, $contato, $id]);
    header('Location: local_listar.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM local WHERE idLocal = ?");
$stmt->execute([$id]);
$local = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$local) {
    header('Location: local_listar.php');
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Local</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Local</h1>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <input type="text" name="descricao" class="form-control" value="<?= htmlspecialchars($local['descricao']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">CEP</label>
            <input type="text" name="cep" class="form-control" value="<?= $local['cep'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Número</label>
            <input type="number" name="numero" class="form-control" value="<?= $local['numero'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Complemento</label>
            <input type="text" name="complemento" class="form-control" value="<?= htmlspecialchars($local['complemento']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Contato</label>
            <input type="text" name="contato" class="form-control" value="<?= $local['contato'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="local_listar.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>