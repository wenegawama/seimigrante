<?php
require_once '../db/DBConnection.php';

function buscarEnderecoViaCEP($cep) {
    $cep = preg_replace('/[^0-9]/', '', $cep);
    $url = "https://viacep.com.br/ws/{$cep}/json/";

    $resposta = file_get_contents($url);
    $dados = json_decode($resposta, true);

    if (isset($dados['erro'])) {
        return false;
    }

    return $dados;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cep'])) {
    $cep = $_POST['cep'];
    $endereco = buscarEnderecoViaCEP($cep);

    if ($endereco) {
        $stmt = $conn->prepare("INSERT INTO CEP (cep, logradouro, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssss",
            $endereco['cep'],
            $endereco['logradouro'],
            $endereco['bairro'],
            $endereco['localidade'],
            $endereco['uf']
        );

        if ($stmt->execute()) {
            echo "Endereço salvo com sucesso!<br>";
        } else {
            echo "Erro ao salvar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "CEP inválido!";
    }

    $conn->close();
} else {
    echo "CEP não informado.";
}
