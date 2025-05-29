<?php
require_once __DIR__ . '../../../../db/DBConnection.php';
$id = $_GET['id'] ?? null;
if ($id) {
    $db = new DBConnection();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("DELETE FROM evento WHERE idEvento = ?");
    $stmt->execute([$id]);
}
header('Location: evento_listar.php');
exit;