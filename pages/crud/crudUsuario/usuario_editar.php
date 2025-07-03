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

    $id = $_GET['id'] ?? null;
    if (!$id) {
        header('Location: usuario_listar.php');
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
    $stmt->execute([$id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$usuario) {
        header('Location: usuario_listar.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $celular = $_POST['celular'];
        $genero = $_POST['genero'];
        $pais = $_POST['pais'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $perfil = $_POST['perfil'];
        $ativo = $_POST['ativo'];

        if (!empty($senha)) {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE usuario SET nome=?, celular=?, genero=?, pais=?, login=?, senha=?, perfil=?, ativo=? WHERE idUsuario=?");
            $stmt->execute([$nome, $celular, $genero, $pais, $login, $senha_hash, $perfil, $ativo, $id]);
        } else {
            $stmt = $conn->prepare("UPDATE usuario SET nome=?, celular=?, genero=?, pais=?, login=?, perfil=?, ativo=? WHERE idUsuario=?");
            $stmt->execute([$nome, $celular, $genero, $pais, $login, $perfil, $ativo, $id]);
        }
        header('Location: usuario_listar.php');
        exit;
    }
    ?>
    <!doctype html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Usuário</title>
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
    <div class="container mt-1">
        <h1 class="text-white">Editar Usuário</h1>
        <form method="post">
            <div class="mb-0">
                <label class="form-label text-white">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
            </div>
            <div class="mb-0">
                <label class="form-label text-white">Celular</label>
                <input type="text" name="celular" class="form-control" value="<?= htmlspecialchars($usuario['celular']) ?>" required>
            </div>
            <div class="mb-0">
                <label class="form-label text-white">Gênero</label>
                <select name="genero" class="form-control">
                    <option value="Masculino" <?= $usuario['genero']=='Masculino'?'selected':'' ?>>Masculino</option>
                    <option value="Feminino" <?= $usuario['genero']=='Feminino'?'selected':'' ?>>Feminino</option>
                    <option value="Outro" <?= $usuario['genero']=='Outro'?'selected':'' ?>>Outro</option>
                </select>
            </div>
            <div class="mb-0">
                <label class="form-label text-white">País</label>
                <select name="pais" class="form-control">
                    <option value="1" <?= $usuario['pais']=='1'?'selected':'' ?>>Brasil</option>
                </select>
            </div>
            <div class="mb-0">
                <label class="form-label text-white">Email</label>
                <input type="email" name="login" class="form-control" value="<?= htmlspecialchars($usuario['login']) ?>" required>
            </div>
            <div class="mb-0">
                <label class="form-label text-white">Senha</label>
                <input type="password" name="senha" class="form-control">
            </div>
            <div class="mb-0">
                <label class="form-label text-white">Perfil</label>
                <select name="perfil" class="form-control">
                    <option value="1" <?= $usuario['perfil']=='1'?'selected':'' ?>>Administrador</option>
                    <option value="2" <?= $usuario['perfil']=='2'?'selected':'' ?>>Usuário</option>
                </select>
            </div>
            <div class="mb-0">
                <label class="form-label text-white">Ativo</label>
                <select name="ativo" class="form-control">
                    <option value="1" <?= $usuario['ativo']=='1'?'selected':'' ?>>Sim</option>
                    <option value="0" <?= $usuario['ativo']=='0'?'selected':'' ?>>Não</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Salvar</button>
            <a href="usuario_listar.php" class="btn btn-secondary mb-2">Voltar</a>
        </form>
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
    header("Location: ../../auth/dashboard.php?erro=Acesso negado para o perfil do usuário!");
}