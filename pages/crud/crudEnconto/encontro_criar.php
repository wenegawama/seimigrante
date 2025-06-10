<?php
require_once __DIR__ . '../../../../db/DBConnection.php';
$db = new DBConnection();
$conn = $db->getConnection();

$stmt = $conn->query("
    SELECT 
        e.idEncontro, 
        ev.nome as evento_nome, 
        u.nome as usuario_nome 
    FROM encontro e 
    LEFT JOIN evento ev ON e.evento = ev.idEvento 
    LEFT JOIN usuario u ON e.usuario = u.idUsuario
    ORDER BY e.idEncontro DESC
");
$encontros = $stmt->fetchAll(PDO::FETCH_ASSOC);
$eventos = $conn->query("SELECT idEvento, nome FROM evento")->fetchAll(PDO::FETCH_ASSOC);
$usuarios = $conn->query("SELECT idUsuario, nome FROM usuario")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $evento = $_POST['evento'];
    $usuario = $_POST['usuario'];
    $stmt = $conn->prepare("INSERT INTO encontro (evento, usuario) VALUES (?, ?)");
    $stmt->execute([$evento, $usuario]);
    header('Location: encontro_listar.php');
    exit;
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Novo Encontro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light   py-3 boxshowdow nav-bg">
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
    <div class="container mt-5">
        <h1 class="text-white">Novo Encontro</h1>
        <form method="post">
            <div class="mb-3">
                <label class="form-label text-white">Nome evento</label>
                <select name="evento" class="form-control" required>
                    <option value="">Selecione</option>
                    <?php foreach ($eventos as $evento): ?>
                        <option value="<?= $evento['idEvento'] ?>"><?= htmlspecialchars($evento['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label text-white">Nome usuário</label>
                <select name="usuario" class="form-control" required>
                    <option value="">Selecione</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['idUsuario'] ?>"><?= htmlspecialchars($usuario['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="encontro_listar.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>

    <footer class="text-black mt-5">
        <div class="container text-center py-4">
            <p class="mb-0">© 2025 Sistema de Eventos para Imigrantes.</p>
            <p> Todos os direitos reservados.</p>
    </footer>

</body>

</html>