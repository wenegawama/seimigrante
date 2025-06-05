<?php
session_start();
//se o usuario ja esta logado, redireciona para o dashboard.php
if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit;
}
//se nao, entao faca o login
require_once __DIR__ . '/../../db/DBConnection.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['password'] ?? '';

    $db = new DBConnection();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT * FROM usuario WHERE login = ? AND ativo = 1 LIMIT 1");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_perfil'] = $usuario['perfil'];
        $_SESSION['usuario_ativo'] = $usuario['ativo'];
        header('Location: dashboard.php');
        exit;
    } else {
        $erro = 'Email ou senha inválidos!';
    }
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
  </head>
  <body>
    <!-- Header fixo -->
    <nav class="navbar navbar-expand-md navbar-light   py-3 boxshowdow nav-bg" >
      <a href="../../index.php" class="navbar-brand"><img src="../../img/logo.png" alt="Logo" height="80px" width="80px" class="mx-4"></a>
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

    <div class="container" style="margin-top: 80px;">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="text-center">Login</h3>
            </div>
            <div class="card-body">
              <?php if (!empty($erro)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
              <?php endif; ?>
              <form action="login.php" method="post">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="text-black mt-5">
        <div class="container text-center py-4">
            <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
            <p> Todos os direitos reservados.</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>