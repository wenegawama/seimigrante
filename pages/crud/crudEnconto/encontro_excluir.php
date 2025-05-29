<?php
require_once __DIR__ . '../../../../db/DBConnection.php';
$id = $_GET['id'] ?? null;
if ($id) {
    $db = new DBConnection();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("DELETE FROM encontro WHERE idEncontro = ?");
    $stmt->execute([$id]);
}
header('Location: encontro_listar.php');
exit;