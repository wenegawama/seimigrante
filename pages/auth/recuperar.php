<?php
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    require_once __DIR__ . '/../../db/DBConnection.php';
    $db = new DBConnection();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE login = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = $conn->prepare("UPDATE usuario SET token_recuperacao=?, token_expira=? WHERE idUsuario=?");
        $stmt->execute([$token, $expira, $usuario['idUsuario']]);

        $link = "http://localhost/seimigrante/pages/auth/redefinir.php?token=$token";
        $mensagem = "Clique no link abaixo para redefinir a senha.<br><a href='$link'>Redefinir senha</a>";
    } else {
        $mensagem = "Email não encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha</title>
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
        <h2 class="text-center text-white">Recuperar Senha</h2>
        <?php if ($mensagem): ?>
            <div class="alert alert-info"><?= $mensagem ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label text-white">Digite seu email cadastrado</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar link de redefinição</button>
        </form>
    </div>

        <footer class="text-black mt-5">
            <div class="container text-center py-4">
                <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
                <p> Todos os direitos reservados.</p>
            </div>
        </footer>
</body>

</html>