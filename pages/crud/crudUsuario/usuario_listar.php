<?php
if (!isset($_SESSION)) session_start();
$nivel_necessario = $_SESSION['usuario_perfil'];
if (!isset($_SESSION['usuario_id']) OR ($_SESSION['usuario_perfil']<$nivel_necessario)) {
    session_destroy();
    header("Location: ../../auth/login.php?erro=Necessário efetuar login no sistema!");
    exit;
}
if ($nivel_necessario == 1) {
    require_once __DIR__ . '../../../../db/DBConnection.php';
    require_once __DIR__ . '/../../Usuario.php';
    $db = new DBConnection();
    $conn = $db->getConnection();
    $stmt = $conn->query("SELECT * FROM usuario");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <!doctype html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Usuários</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../../css/style.css">
    </head>
    <body>
            <nav class="navbar navbar-expand-md navbar-light py-3 boxshowdow nav-bg">
        <a href="../../../index.php" class="navbar-brand"><img src="../../../img/newLogo.jpg" alt="Logo" height="80px" width="80px" class="mx-4"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="../../auth/dashboard.php">Dashboard</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-2">
        <h1 class="text-center text-white" >Usuários</h1>
        <a href="usuario_criar.php" class="btn btn-success mb-3">Novo Usuário</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Celular</th>
                    <th>Gênero</th>
                    <th>País</th>
                    <th>Login</th>
                    <th>Perfil</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= isset($usuario['idUsuario']) ? $usuario['idUsuario'] : '' ?></td>
                    <td><?= htmlspecialchars($usuario['nome']) ?></td>
                    <td><?= htmlspecialchars($usuario['celular']) ?></td>
                    <td><?= htmlspecialchars($usuario['genero']) ?></td>
                    <td><?= htmlspecialchars($usuario['pais']) ?></td>
                    <td><?= htmlspecialchars($usuario['login']) ?></td>
                    <td><?= $usuario['perfil'] ?></td>
                    <td><?= $usuario['ativo'] ? 'Sim' : 'Não' ?></td>
                    <td>
                        <a href="usuario_editar.php?id=<?= isset($usuario['idUsuario']) ? $usuario['idUsuario'] : '' ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="usuario_excluir.php?id=<?= isset($usuario['idUsuario']) ? $usuario['idUsuario'] : '' ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../../auth/dashboard.php" class="btn btn-secondary">Voltar</a>
    </div>
     <footer>
        <div class="container text-center py-4">
            <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
            <p>Todos os direitos reservados.</p>
        </div>
    </footer>
    </body>
    </html>
    <?php
} else {
    header("Location: ../../auth/dashboard.php?erro=Acesso negado para o perfil");
}