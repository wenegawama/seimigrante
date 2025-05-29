<?php
require_once __DIR__ . '../../../../db/DBConnection.php';
$id = $_GET['id'] ?? null;
if ($id) {
    $db = new DBConnection();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("DELETE FROM local WHERE idLocal = ?");
    $stmt->execute([$id]);
}
header('Location: local_listar.php');
exit;