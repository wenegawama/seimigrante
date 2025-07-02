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
        <nav class="navbar navbar-expand-md navbar-light   py-3 boxshowdow nav-bg" >
            <div class="container-fluid">
            <a class="navbar-brand" a href="../../index.php" class="navbar-brand"><img src="../../img/newLogo.jpg" alt="Logo" height="80px" width="80px" class="mx-4"></a></a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
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
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container mt-5">        
        <h1><font color = "white"> Bem vindo: <?php echo ($_SESSION['usuario_nome']); ?></font></h1>
        <?php
            //Exibir mensagem de erro caso ocorra
            if (isset($_GET["erro"]))
            {
            $erro = $_GET["erro"];?>
            <div class="alert alert-danger"><center><b><?= htmlspecialchars($erro) ?></b></center></div>
        <?php }?>
        <div class="row mt-3">
            <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Atividade</h5>
                        <p class="card-text text-center">Gerenciar atividades.</p>
                        <div class="row g-2 justify-content-center">
                            <div class="col-6">
                                <a href="../crud/crudAtividade/atividade_criar.php" class="btn btn-primary w-100">Criar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudAtividade/atividade_listar.php" class="btn btn-primary w-100">Listar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudAtividade/atividade_editar.php" class="btn btn-primary w-100">Editar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudAtividade/atividade_excluir.php" class="btn btn-primary w-100">Excluir </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            
           <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Local</h5>
                        <p class="card-text text-center">Gerenciar locais.</p>
                        <div class="row g-2 justify-content-center">
                            <div class="col-6">
                                <a href="../crud/crudLocal/local_criar.php" class="btn btn-primary w-100">Criar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudLocal/local_listar.php" class="btn btn-primary w-100">Listar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudLocal/local_editar.php" class="btn btn-primary w-100">Editar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudLocal/local_excluir.php" class="btn btn-primary w-100">Excluir </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
           <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Evento</h5>
                        <p class="card-text text-center">Gerenciar eventos.</p>
                        <div class="row g-2 justify-content-center">
                            <div class="col-6">
                                <a href="../crud/crudEvento/evento_criar.php" class="btn btn-primary w-100">Criar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudEvento/evento_listar.php" class="btn btn-primary w-100">Listar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudEvento/evento_editar.php" class="btn btn-primary w-100">Editar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudEvento/evento_excluir.php" class="btn btn-primary w-100">Excluir </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
           <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Encontro</h5>
                        <p class="card-text text-center">Gerenciar encontros.</p>
                        <div class="row g-2 justify-content-center">
                            <div class="col-6">
                                <a href="../crud/crudEncontro/encontro_criar.php" class="btn btn-primary w-100">Criar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudEncontro/encontro_listar.php" class="btn btn-primary w-100">Listar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudEncontro/encontro_editar.php" class="btn btn-primary w-100">Editar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudEncontro/encontro_excluir.php" class="btn btn-primary w-100">Excluir </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Usuario</h5>
                        <p class="card-text text-center">Gerenciar usuários.</p>
                        <div class="row g-2 justify-content-center">
                            <div class="col-6">
                                <a href="../crud/crudUsuario/usuario_criar.php" class="btn btn-primary w-100">Criar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudUsuario/usuario_listar.php" class="btn btn-primary w-100">Listar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudUsuario/usuario_editar.php" class="btn btn-primary w-100">Editar </a>
                            </div>
                            <div class="col-6">
                                <a href="../crud/crudUsuario/usuario_excluir.php" class="btn btn-primary w-100">Excluir </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                    
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <footer class="text-black mt-5">
            <div class="container text-center py-4">
                <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
                <p> Todos os direitos reservados.</p>
            </footer>
            
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
    </html>                                            