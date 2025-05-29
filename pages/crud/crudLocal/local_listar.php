<?php
require_once __DIR__ . '../../../../db/DBConnection.php';
$db = new DBConnection();
$conn = $db->getConnection();

$stmt = $conn->query("SELECT * FROM local");
$locais = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Locais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Locais</h1>
    <a href="local_criar.php" class="btn btn-success mb-3">Novo Local</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>CEP</th>
                <th>Número</th>
                <th>Complemento</th>
                <th>Contato</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($locais as $local): ?>
            <tr>
                <td><?= $local['idLocal'] ?></td>
                <td><?= htmlspecialchars($local['descricao']) ?></td>
                <td><?= $local['cep'] ?></td>
                <td><?= $local['numero'] ?></td>
                <td><?= htmlspecialchars($local['complemento']) ?></td>
                <td><?= $local['contato'] ?></td>
                <td>
                    <a href="local_editar.php?id=<?= $local['idLocal'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="local_excluir.php?id=<?= $local['idLocal'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>