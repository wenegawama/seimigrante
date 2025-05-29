<?php
require_once __DIR__ . '/../db/DBConnection.php';
require_once __DIR__ . '/../pages/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $celular = $_POST['celular'];
    $genero = $_POST['genero'];
    $pais = $_POST['pais'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $perfil = $_POST['perfil'];
    $ativo = $_POST['ativo'];


    $db = new DBConnection();
    $conn = $db->getConnection();

    $usuario = new Usuario(null, $_POST['nome'], $_POST['celular'], $_POST['genero'], $_POST['pais'], $_POST['login'], $_POST['senha'], $_POST['perfil'], $_POST['ativo']);

    $stmt = $conn->prepare("INSERT INTO usuario (nome, celular, genero, pais, login, senha, perfil, ativo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $usuario->getNome(),
        $usuario->getCelular(),
        $usuario->getGenero(),
        $usuario->getPais(),
        $usuario->getEmailLogin(),
        $usuario->getSenha(),
        $usuario->getPerfil(),
        $usuario->isAtivo()
    ]);

    if ($stmt) {
    header('Location: login.php');
    exit;
} else {
    echo "Erro ao registrar usuário.";
}
}
?>


<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuário</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

      <nav class="navbar navbar-expand-md bg-primary">
    <div class="container-fluid">
      
      <a class="navbar-brand" href="">SEI</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
        
      </div>
    </div>
  </nav>

    <div class="container mt-5">
        <h1 class="text-center">Cadastro do usuário: </h1>
        <form  id ="cadastro" action="registrar.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome *</label>
                <input type="text" class="form-control required" id="nome" name="nome" required oninput="validateNome()">
                <span class="span-required">O nome deve conter duas ou mais palavras, cada uma com pelo menos 2 caracteres sem números ou carateres especias</span>
            </div>
            <div class="mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" required>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Gênero</label>
                <select class="form-control" id="genero" name="genero">
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div class="mb-3">
             <label for="pais" class="form-label">País</label>
            <select class="form-control" id="pais" name="pais">
                <option value="1">Brasil</option>
            </select>
            </div>
            <div class="mb-3">
                <label for="login" class="form-label">Email</label>
                <input type="email" class="form-control" id="login" name="login" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" id="perfil" name="perfil"
                    value=2 hidden>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" id="ativo" name="ativo"
                    value=1 hidden>
                <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>


    <script src="/js/registrar.js"></script>
</body>

</html>