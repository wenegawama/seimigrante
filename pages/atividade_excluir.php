<?php
require_once __DIR__ . '/../db/DBConnection.php';
$id = $_GET['id'] ?? null;
if ($id) {
    $db = new DBConnection();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("DELETE FROM atividade WHERE idAtividade = ?");
    $stmt->execute([$id]);
}
header('Location: atividade_listar.php');
exit;