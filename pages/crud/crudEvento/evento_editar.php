<?php
    // A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();
    $nivel_necessario = $_SESSION['usuario_perfil'];
    // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['usuario_id']) OR ($_SESSION['usuario_perfil']<$nivel_necessario)) {
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: ../../auth/login.php?erro=Necessário efetuar login no sistema!"); 
        exit;
    }
    
    if ($nivel_necessario == 1) 
    { // Acesso Perfil Administrador
        require_once __DIR__ . '/../../../db/DBConnection.php';
        $db = new DBConnection();
        $conn = $db->getConnection();
        
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: evento_listar.php');
            exit;
        }
        
        $locais = $conn->query("SELECT idLocal, descricao FROM local")->fetchAll(PDO::FETCH_ASSOC);
        $atividades = $conn->query("SELECT idAtividade, descricao FROM atividade")->fetchAll(PDO::FETCH_ASSOC);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento = $_POST['evento'];
            $local = $_POST['local'];
            $data = $_POST['data'];
            $hora = $_POST['hora'];
            $atividade = $_POST['atividade'];
            $observacao = $_POST['observacao'];
            $stmt = $conn->prepare("UPDATE evento SET evento = ?, local = ?, data = ?, hora = ?, atividade = ?, observacao = ? WHERE idEvento = ?");
            $stmt->execute([$evento, $local, $data, $hora, $atividade, $observacao, $id]);
            header('Location: evento_listar.php');
            exit;
        }
        
        $stmt = $conn->prepare("SELECT * FROM evento WHERE idEvento = ?");
        $stmt->execute([$id]);
        $evento = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$evento) {
            header('Location: evento_listar.php');
            exit;
        }
    ?>
    <!doctype html>
    <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <title>Editar Evento</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../../../css/style.css">    
        </head>
        <body>
            <nav class="navbar navbar-expand-md navbar-light   py-3 boxshowdow nav-bg" >
                <a href="../../../index.php" class="navbar-brand"><img src="../../../img/logo.png" alt="Logo" height="80px" width="80px" class="mx-4"></a>
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
                <h1 class="text-white">Editar Evento</h1>
                <form method="post">
                    <div class="mb-2">
                        <label class="form-label"><font color="white">Evento</label>
                            <input type='text' name="evento" class="form-control" value="<?= htmlspecialchars($evento['evento']) ?>"required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Local</label>
                            <select name="local" class="form-control" required>
                                <option value="">Selecione</option>
                                <?php foreach ($locais as $local): ?>
                                <option value="<?= $local['idLocal'] ?>" <?= $local['idLocal'] == $evento['local'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($local['descricao']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Data</label>
                            <input type="date" name="data" class="form-control" value="<?= $evento['data'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hora</label>
                            <input type="time" name="hora" class="form-control" value="<?= $evento['hora'] ?>" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Atividade</label>
                            <select name="atividade" class="form-control" required>
                                <option value="">Selecione</option>
                                <?php foreach ($atividades as $atividade): ?>
                                <option value="<?= $atividade['idAtividade'] ?>" <?= $atividade['idAtividade'] == $evento['atividade'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($atividade['descricao']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Observação</label>
                            <textarea name="observacao" class="form-control"><?= htmlspecialchars($evento['observacao']) ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="evento_listar.php" class="btn btn-secondary">Voltar</a>
                    </form>
                </div>
                <footer class="text-black mt-3">
                    <div class="container text-center py-4">
                        <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
                        <p> Todos os direitos reservados.</p>
                    </div>
                </footer>
            </body>
        </html>
        <?php
            }else{
            // Perfil é DIFERENTE de 1=Acesso Perfil Administrador
            header("Location: ../../auth/dashboard.php?erro=Acesso negado para o perfil do usuário!");
        }
    ?>      