<?php
	
	include "conexao.php";
	
	header('Content-type: application/json');

	$busca_mapa = "SELECT a.descricao as name, concat(b.municipio,'(',b.estado,')') as city, b.bairro as district, 
	b.latitude as lat, b.longitude as lng, a.contato as type, a.CEP, b.logradouroEndereco as rua, 1 as Icone FROM local a, endereco b where a.CEP=b.cep";
	$res_consulta = mysqli_query($conn, $busca_mapa);
	$data = array();

	while ($row = mysqli_fetch_assoc($res_consulta)) {
		$data[] = $row;
	}

	echo json_encode($data, JSON_PRETTY_PRINT);
	mysqli_close($conn);
?>