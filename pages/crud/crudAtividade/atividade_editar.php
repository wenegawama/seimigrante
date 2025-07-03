<?php
    
    if (!isset($_SESSION)) session_start();
    $nivel_necessario = $_SESSION['usuario_perfil'];
    
    if (!isset($_SESSION['usuario_id']) OR ($_SESSION['usuario_perfil']<$nivel_necessario)) {
        
        session_destroy();
        
        header("Location: ../../auth/login.php?erro=Necessário efetuar login no sistema!"); 
        exit;
    }
    if ($nivel_necessario == 1) 
    { 
        require_once __DIR__ . '/../../../db/DBConnection.php';
        $db = new DBConnection();
        $conn = $db->getConnection();
        
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: atividade_listar.php');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = $_POST['descricao'];
            $duracao = $_POST['duracao'];
            $stmt = $conn->prepare("UPDATE atividade SET descricao = ?, duracao = ? WHERE idAtividade = ?");
            $stmt->execute([$descricao, $duracao, $id]);
            header('Location: atividade_listar.php');
            exit;
        }
        
        $stmt = $conn->prepare("SELECT * FROM atividade WHERE idAtividade = ?");
        $stmt->execute([$id]);
        $atividade = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$atividade) {
            header('Location: atividade_listar.php');
            exit;
        }
    ?>
    <!doctype html>
    <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <title>Editar Atividade</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../../../css/style.css">
        </head>
        <body>
            <nav class="navbar navbar-expand-md navbar-light   py-3 boxshowdow nav-bg" >
                <a href="../../../index.php" class="navbar-brand"><img src="../../../img/newLogo.jpg" alt="Logo" height="80px" width="80px" class="mx-4"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="../../../index.php">Home</a>
                        </li>                        
                    </ul>
                </div>
            </nav>
            <div class="container mt-5">
                <h1 class="text-white">Editar Atividade</h1>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label"><font color="white">Descrição</label>
                            <input type="text" name="descricao" class="form-control" value="<?= htmlspecialchars($atividade['descricao']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Duração (hh:mm:ss)</label>
                            <input type="time" name="duracao" class="form-control" value="<?= $atividade['duracao'] ?>" required step="1">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="atividade_listar.php" class="btn btn-secondary">Voltar</a>
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
        <?php
            }else{
            
            header("Location: ../../auth/dashboard.php?erro=Acesso negado para o perfil do usuário!");
        }
    ?>         