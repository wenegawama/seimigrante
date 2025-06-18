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
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = new DBConnection();
            $conn = $db->getConnection();
            $stmt = $conn->prepare("DELETE FROM evento WHERE idEvento = ?");
            $stmt->execute([$id]);
        }
        header('Location: evento_listar.php');
        exit;        
        }else{
        // Perfil é DIFERENTE de 1=Acesso Perfil Administrador
        header("Location: ../../auth/dashboard.php?erro=Acesso negado para o perfil do usuário!");
    }
?>  