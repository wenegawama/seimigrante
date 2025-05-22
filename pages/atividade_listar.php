<?php
require_once __DIR__ . '/../db/DBConnection.php';
$db = new DBConnection();
$conn = $db->getConnection();

$stmt = $conn->query("SELECT * FROM atividade");
$atividades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Atividades</h1>
    <a href="atividade_criar.php" class="btn btn-success mb-3">Nova Atividade</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Duração</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($atividades as $atividade): ?>
            <tr>
                <td><?= $atividade['idAtividade'] ?></td>
                <td><?= htmlspecialchars($atividade['descricao']) ?></td>
                <td><?= $atividade['duracao'] ?></td>
                <td>
                    <a href="atividade_editar.php?id=<?= $atividade['idAtividade'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="atividade_excluir.php?id=<?= $atividade['idAtividade'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>