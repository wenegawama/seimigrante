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
            header('Location: encontro_listar.php');
            exit;
        }
        
        $eventos = $conn->query("SELECT idEvento, evento FROM evento ORDER BY evento")->fetchAll(PDO::FETCH_ASSOC);
        $usuarios = $conn->query("SELECT idUsuario, nome FROM usuario ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento = $_POST['evento'];
            $usuario = $_POST['usuario'];
            $stmt = $conn->prepare("UPDATE encontro SET evento = ?, usuario = ? WHERE idEncontro = ?");
            $stmt->execute([$evento, $usuario, $id]);
            header('Location: encontro_listar.php');
            exit;
        }
        
        $stmt = $conn->prepare("SELECT * FROM encontro WHERE idEncontro = ?");
        $stmt->execute([$id]);
        $encontro = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$encontro) {
            header('Location: encontro_listar.php');
            exit;
        }
    ?>
    <!doctype html>
    <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <title>Editar Encontro</title>
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
                <h1 class="text-white">Editar Encontro</h1>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label"><font color="white">Evento</label>
                            <select name="evento" class="form-control" required>
                                <option value="">Selecione</option>
                                <?php foreach ($eventos as $evento): ?>
                                <option value="<?= $evento['idEvento'] ?>" <?= $evento['idEvento'] == $encontro['evento'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($evento['evento']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Usuário</label>
                            <select name="usuario" class="form-control" required>
                                <option value="">Selecione</option>
                                <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?= $usuario['idUsuario'] ?>" <?= $usuario['idUsuario'] == $encontro['usuario'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($usuario['nome']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="encontro_listar.php" class="btn btn-secondary">Voltar</a>
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