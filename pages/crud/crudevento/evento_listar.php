<?php
require_once __DIR__ . '../../../../db/DBConnection.php';
$db = new DBConnection();
$conn = $db->getConnection();

$stmt = $conn->query("SELECT e.*, l.descricao AS local_desc, a.descricao AS atividade_desc
                      FROM evento e
                      JOIN local l ON e.local = l.idLocal
                      JOIN atividade a ON e.atividade = a.idAtividade");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Eventos</h1>
    <a href="evento_criar.php" class="btn btn-success mb-3">Novo Evento</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Local</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Atividade</th>
                <th>Observação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventos as $evento): ?>
            <tr>
                <td><?= $evento['idEvento'] ?></td>
                <td><?= htmlspecialchars($evento['local_desc']) ?></td>
                <td><?= $evento['data'] ?></td>
                <td><?= $evento['hora'] ?></td>
                <td><?= htmlspecialchars($evento['atividade_desc']) ?></td>
                <td><?= htmlspecialchars($evento['observacao']) ?></td>
                <td>
                    <a href="evento_editar.php?id=<?= $evento['idEvento'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="evento_excluir.php?id=<?= $evento['idEvento'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>