<?php
require_once __DIR__ . '../../../../db/DBConnection.php';
$db = new DBConnection();
$conn = $db->getConnection();

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: evento_listar.php');
    exit;
}

$locais = $conn->query("SELECT idLocal, descricao FROM local")->fetchAll(PDO::FETCH_ASSOC);
$atividades = $conn->query("SELECT idAtividade, descricao FROM atividade")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $local = $_POST['local'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $atividade = $_POST['atividade'];
    $observacao = $_POST['observacao'];
    $stmt = $conn->prepare("UPDATE evento SET local = ?, data = ?, hora = ?, atividade = ?, observacao = ? WHERE idEvento = ?");
    $stmt->execute([$local, $data, $hora, $atividade, $observacao, $id]);
    header('Location: evento_listar.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM evento WHERE idEvento = ?");
$stmt->execute([$id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$evento) {
    header('Location: evento_listar.php');
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Evento</h1>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Local</label>
            <select name="local" class="form-control" required>
                <option value="">Selecione</option>
                <?php foreach ($locais as $local): ?>
                    <option value="<?= $local['idLocal'] ?>" <?= $local['idLocal'] == $evento['local'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($local['descricao']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Data</label>
            <input type="date" name="data" class="form-control" value="<?= $evento['data'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hora</label>
            <input type="time" name="hora" class="form-control" value="<?= $evento['hora'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Atividade</label>
            <select name="atividade" class="form-control" required>
                <option value="">Selecione</option>
                <?php foreach ($atividades as $atividade): ?>
                    <option value="<?= $atividade['idAtividade'] ?>" <?= $atividade['idAtividade'] == $evento['atividade'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($atividade['descricao']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Observação</label>
            <textarea name="observacao" class="form-control"><?= htmlspecialchars($evento['observacao']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="evento_listar.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>