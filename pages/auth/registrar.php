<?php
session_start();
require_once __DIR__ . '/../../db/DBConnection.php';
require_once __DIR__ . '/../Usuario.php';
require_once __DIR__ . '/../UsuarioDAO.php';

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validação dos campos
        if (empty($_POST['nome']) || empty($_POST['celular']) || empty($_POST['login']) || empty($_POST['senha'])) {
            throw new Exception('Todos os campos são obrigatórios.');
        }

        if (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email inválido.');
        }

        // Instancia UsuarioDAO
        $usuarioDAO = new UsuarioDAO();

        // Verifica se email já existe
        if ($usuarioDAO->verificarEmailExistente($_POST['login'])) {
            throw new Exception('Este email já está cadastrado.');
        }

        // Cria novo usuário
        $usuario = new Usuario(
            null, 
            trim($_POST['nome']),
            trim($_POST['celular']),
            $_POST['genero'],
            $_POST['pais'],
            trim($_POST['login']),
            $_POST['senha'],
            $_POST['perfil'] ?? 2, // perfil padrão = 2
            $_POST['ativo'] ?? 1   // ativo padrão = 1
        );

        if ($usuarioDAO->criar($usuario)) {
            header('Location: login.php');
            exit;
        } else {
            throw new Exception('Erro ao registrar usuário.');
        }

    } catch (Exception $e) {
        $erro = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
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

    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Cadastro de Usuário</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($erro): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
                        <?php endif; ?>

                        <form id="cadastro" action="registrar.php" method="POST" novalidate>
                            <div class="mb-1">
                                <label for="nome" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="nome" 
                                       required value="<?= isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '' ?>">
                            </div>

                            <div class="mb-1">
                                <label for="celular" class="form-label">Celular</label>
                                <input type="tel" class="form-control" id="celular" name="celular" 
                                       required value="<?= isset($_POST['celular']) ? htmlspecialchars($_POST['celular']) : '' ?>">
                            </div>

                            <div class="mb-1">
                                <label for="genero" class="form-label">Gênero</label>
                                <select class="form-control" id="genero" name="genero">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Outro">Outro</option>
                                </select>
                            </div>

                            <div class="mb-1">
                                <label for="pais" class="form-label">País</label>
                                <select class="form-control" id="pais" name="pais">
                                    <option value="1">Brasil</option>
                                </select>
                            </div>

                            <div class="mb-1">
                                <label for="login" class="form-label">Email</label>
                                <input type="email" class="form-control" id="login" name="login" 
                                       required value="<?= isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '' ?>">
                            </div>

                            <div class="mb-1">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>

                            <input type="hidden" name="perfil" value="2" readonly>
                            <input type="hidden" name="ativo" value="1">

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-1">
        <div class="container text-center py-4">
            <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
            <p>Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/registrar.js"></script>
</body>
</html>