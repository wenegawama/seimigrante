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
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = new DBConnection();
            $conn = $db->getConnection();
            $stmt = $conn->prepare("DELETE FROM encontro WHERE idEncontro = ?");
            $stmt->execute([$id]);
        }
        header('Location: encontro_listar.php');
        exit;
        }else{
        
        header("Location: ../../auth/dashboard.php?erro=Acesso negado para o perfil do usuário!");
    }
?>