<?php
require_once __DIR__ . '../../../../db/DBConnection.php';
$db = new DBConnection();
$conn = $db->getConnection();

$stmt = $conn->query("SELECT * FROM encontro");
$encontros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Encontros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Encontros</h1>
    <a href="encontro_criar.php" class="btn btn-success mb-3">Novo Encontro</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Evento</th>
                <th>Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($encontros as $encontro): ?>
            <tr>
                <td><?= $encontro['idEncontro'] ?></td>
                <td><?= $encontro['evento'] ?></td>
                <td><?= $encontro['usuario'] ?></td>
                <td>
                    <a href="encontro_editar.php?id=<?= $encontro['idEncontro'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="encontro_excluir.php?id=<?= $encontro['idEncontro'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>