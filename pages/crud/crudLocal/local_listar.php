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
    <link rel="stylesheet" href="../../../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light   py-3 boxshowdow nav-bg" >
      <a href="../../../index.php" class="navbar-brand"><img src="../../../img/logo.png" alt="Logo" height="80px" width="80px" class="mx-4"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-2">
            <a class="nav-link" href="../../../index.php">Home</a>
            </li> 
        </ul>
      </div>
    </nav>
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
<footer class="text-black mt-5">
        <div class="container text-center py-4">
            <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
            <p> Todos os direitos reservados.</p>
    </footer>
</body>
</html>