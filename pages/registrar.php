<?php
require_once __DIR__ . '/../db/DBConnection.php';
require_once __DIR__ . '/../pages/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $celular = $_POST['celular'];
    $genero = $_POST['genero'];
    $pais = $_POST['pais'];
    $email_login = $_POST['email_login'];
    $senha = $_POST['senha'];
    $perfil = $_POST['perfil'];
    $ativo = $_POST['ativo'];


    $db = new DBConnection();
    $conn = $db->getConnection();

    $usuario = new Usuario(null, $_POST['nome'], $_POST['celular'], $_POST['genero'], $_POST['pais'], $_POST['email_login'], $_POST['senha'], $_POST['perfil'], $_POST['ativo']);

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, celular, genero, pais, email_login, senha, perfil, ativo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
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
        echo "Usuário registrado com sucesso!";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

      <nav class="navbar navbar-expand-md bg-primary-subtle">
    <div class="container-fluid">
      
      <a class="navbar-brand" href="#">SEI</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/pages/registrar.php">Registrar-se</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Eventos
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Criar</a></li>
              <li><a class="dropdown-item" href="#">Editar</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Outros</a></li>
            </ul>
          </li>
         
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Pesquise ..." aria-label="Search">
          <button class="btn btn-outline-primary" type="submit">Procurar</button>
        </form>
      </div>
    </div>
  </nav>

    <div class="container mt-5">
        <h1 class="text-center">Cadastro do usuário: </h1>
        <form action="registrar.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" require>
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
                <input type="text" class="form-control" id="pais" name="pais" required>
            </div>
            <div class="mb-3">
                <label for="email_login" class="form-label">Email</label>
                <input type="email" class="form-control" id="email_login" name="email_login" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" id="perfil" name="perfil"
                    value=1 hidden>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" id="ativo" name="ativo"
                    value=1 hidden>
                <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>

</html>