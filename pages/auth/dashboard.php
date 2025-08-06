<?php
    if (!isset($_SESSION)) session_start();
    $nome = $_SESSION['usuario_nome'];
    $nivel_necessario = $_SESSION['usuario_perfil'];
    if (!isset($_SESSION['usuario_id']) OR ($_SESSION['usuario_perfil']<$nivel_necessario)) {
        session_destroy();
        header("Location: login.php"); exit;
    }
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light py-3 boxshowdow nav-bg">
        <div class="container-fluid">
            <a href="../../index.php" class="navbar-brand">
                <img src="../../img/newLogo.jpg" alt="Logo" height="60" width="60" class="mx-2 img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav justify-content-center w-100">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="../crud/crudAtividade/atividade_listar.php">Atividade</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="../crud/crudLocal/local_listar.php">Local</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="../crud/crudevento/evento_listar.php">Evento</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="../crud/crudEncontro/encontro_listar.php">Encontro</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4 text-white">Bem vindo: <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></h1>
        <?php if (isset($_GET["erro"])): ?>
            <div class="alert alert-danger text-center"><b><?= htmlspecialchars($_GET["erro"]) ?></b></div>
        <?php endif; ?>
        <div class="row mt-3 g-3">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100  bg-gradient">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-primary">Atividade</h5>
                        <p class="card-text text-center text-primary">Gerenciar atividades.</p>
                        <div class="row g-2 justify-content-center mt-auto">
                            <div class="col-6">
                                <a href="../crud/crudAtividade/atividade_criar.php" class="btn btn-primary w-100">Criar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudAtividade/atividade_listar.php" class="btn btn-primary w-100">Listar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudAtividade/atividade_editar.php" class="btn btn-primary w-100">Editar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudAtividade/atividade_excluir.php" class="btn btn-primary w-100">Excluir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 bg-gradient">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-primary">Local</h5>
                        <p class="card-text text-center text-primary">Gerenciar locais.</p>
                        <div class="row g-2 justify-content-center mt-auto">
                            <div class="col-6">
                                <a href="../crud/crudLocal/local_criar.php" class="btn btn-primary w-100">Criar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudLocal/local_listar.php" class="btn btn-primary w-100">Listar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudLocal/local_editar.php" class="btn btn-primary w-100">Editar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudLocal/local_excluir.php" class="btn btn-primary w-100">Excluir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 bg-gradient">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-primary">Evento</h5>
                        <p class="card-text text-center text-primary">Gerenciar eventos.</p>
                        <div class="row g-2 justify-content-center mt-auto">
                            <div class="col-6">
                                <a href="../crud/crudEvento/evento_criar.php" class="btn btn-primary w-100">Criar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudEvento/evento_listar.php" class="btn btn-primary w-100">Listar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudEvento/evento_editar.php" class="btn btn-primary w-100">Editar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudEvento/evento_excluir.php" class="btn btn-primary w-100">Excluir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 bg-gradient">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-primary">Encontro</h5>
                        <p class="card-text text-center text-primary">Gerenciar encontros.</p>
                        <div class="row g-2 justify-content-center mt-auto">
                            <div class="col-6">
                                <a href="../crud/crudEncontro/encontro_criar.php" class="btn btn-primary w-100">Criar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudEncontro/encontro_listar.php" class="btn btn-primary w-100">Listar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudEncontro/encontro_editar.php" class="btn btn-primary w-100">Editar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudEncontro/encontro_excluir.php" class="btn btn-primary w-100">Excluir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 bg-gradient">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-primary">Usuário</h5>
                        <p class="card-text text-center text-primary">Gerenciar usuários.</p>
                        <div class="row g-2 justify-content-center mt-auto">
                            <div class="col-6">
                                <a href="../crud/crudUsuario/usuario_criar.php" class="btn btn-primary w-100">Criar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudUsuario/usuario_listar.php" class="btn btn-primary w-100">Listar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudUsuario/usuario_editar.php" class="btn btn-primary w-100">Editar</a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudUsuario/usuario_excluir.php" class="btn btn-primary w-100">Excluir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-black mt-5">
        <div class="container text-center py-4">
            <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
            <p>Todos os direitos reservados.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>