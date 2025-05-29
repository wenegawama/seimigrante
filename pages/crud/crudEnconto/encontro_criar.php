<?php
require_once __DIR__ . '../../../../db/DBConnection.php';
$db = new DBConnection();
$conn = $db->getConnection();

$eventos = $conn->query("SELECT idEvento FROM evento")->fetchAll(PDO::FETCH_ASSOC);
$usuarios = $conn->query("SELECT idUsuario, nome FROM usuario")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $evento = $_POST['evento'];
    $usuario = $_POST['usuario'];
    $stmt = $conn->prepare("INSERT INTO encontro (evento, usuario) VALUES (?, ?)");
    $stmt->execute([$evento, $usuario]);
    header('Location: encontro_listar.php');
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Encontro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Novo Encontro</h1>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Evento</label>
            <select name="evento" class="form-control" required>
                <option value="">Selecione</option>
                <?php foreach ($eventos as $evento): ?>
                    <option value="<?= $evento['idEvento'] ?>"><?= $evento['idEvento'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Usuário</label>
            <select name="usuario" class="form-control" required>
                <option value="">Selecione</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['idUsuario'] ?>"><?= htmlspecialchars($usuario['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="encontro_listar.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>