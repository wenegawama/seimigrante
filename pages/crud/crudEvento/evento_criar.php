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
        
        $locais = $conn->query("SELECT idLocal, descricao FROM local")->fetchAll(PDO::FETCH_ASSOC);
        $atividades = $conn->query("SELECT idAtividade, descricao FROM atividade")->fetchAll(PDO::FETCH_ASSOC);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento = $_POST['evento'];
            $local = $_POST['local'];
            $data = $_POST['data'];
            $hora = $_POST['hora'];
            $atividade = $_POST['atividade'];
            $observacao = $_POST['observacao'];
            $stmt = $conn->prepare("INSERT INTO evento (evento, local, data, hora, atividade, observacao) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$evento, $local, $data, $hora, $atividade, $observacao]);
            header('Location: evento_listar.php');
            exit;
        }
    ?>
    <!doctype html>
    <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <title>Novo Evento</title>
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
            
            <div class="container mt-2">
                <h1 class="text-white">Cadastrar Evento</h1>
                <form method="post">
                    <div class="mb-3">
                        <div class="mb-2">
                            <label class="form-label text-white">Evento</label>
                            <input name="evento" class="form-control"></input>
                        </div>
                        <label class="form-label text-white">Local</label>
                        <select name="local" class="form-control" required>
                            <option value="">Selecione</option>
                            <?php foreach ($locais as $local): ?>
                            <option value="<?= $local['idLocal'] ?>"><?= htmlspecialchars($local['descricao']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-white">Data</label>
                        <input type="date" name="data" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-white">Hora</label>
                        <input type="time" name="hora" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-white">Atividade</label>
                        <select name="atividade" class="form-control" required>
                            <option value="">Selecione</option>
                            <?php foreach ($atividades as $atividade): ?>
                            <option value="<?= $atividade['idAtividade'] ?>"><?= htmlspecialchars($atividade['descricao']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-white">Observação</label>
                        <textarea name="observacao" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="../../auth/dashboard.php" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
            <footer class="text-black mt-3">
                <div class="container text-center py-4">
                    <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
                    <p> Todos os direitos reservados.</p>
                </footer>
            </body>
        </html>
        <?php
            }else{
            header("Location: ../../auth/dashboard.php?erro=Acesso negado para o perfil do usuário!");
        }
    ?>     