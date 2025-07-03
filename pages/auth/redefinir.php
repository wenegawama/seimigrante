<?php
require_once __DIR__ . '/../../db/DBConnection.php';
$mensagem = '';
$token = $_GET['token'] ?? '';
$db = new DBConnection();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE token_recuperacao=? AND token_expira > NOW()");
    $stmt->execute([$token]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuario SET senha=?, token_recuperacao=NULL, token_expira=NULL WHERE idUsuario=?");
        $stmt->execute([$senha_hash, $usuario['idUsuario']]);
        $mensagem = "Senha redefinida com sucesso! <a href='login.php'>Faça login</a>";
    } else {
        $mensagem = "Token inválido ou expirado.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light   py-3 boxshowdow nav-bg">
        <a href="../../index.php" class="navbar-brand"><img src="../../img/newLogo.jpg" alt="Logo" height="80px" width="80px" class="mx-4"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="../../index.php">Home</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h2 class="text-center text-white">Redefinir Senha</h2>
        <?php if ($mensagem): ?>
            <div class="alert alert-info"><?= $mensagem ?></div>
        <?php elseif ($token): ?>
            <form method="post">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <div class="mb-3">
                    <label for="senha" class="form-label text-white">Nova senha</label>
                    <input type="password" class="form-control" name="senha" required>
                </div>
                <button type="submit" class="btn btn-primary">Redefinir</button>
            </form>
        <?php else: ?>
            <div class="alert alert-danger">Token inválido.</div>
        <?php endif; ?>
    </div>
    <footer class="text-black mt-5">
        <div class="container text-center py-4">
            <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
            <p> Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>