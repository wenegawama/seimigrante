<?php
require_once __DIR__ . '/../db/DBConnection.php';
$db = new DBConnection();
$conn = $db->getConnection();

header('Content-type: application/json');

$busca_mapa = "SELECT 
    l.descricao as name, 
    CONCAT(e.municipio,'(',e.estado,')') as city, 
    e.bairro as district,
    e.latitude as lat, 
    e.longitude as lng, 
    l.contato as type, 
    l.cep as CEP, 
    e.logradouroEndereco as rua, 
    1 as Icone 
FROM local l
JOIN endereco e ON l.cep = e.cep";

$stmt = $conn->query($busca_mapa);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data, JSON_PRETTY_PRINT);