<?php

class Usuario {
    private $id;
    private $nome;
    private $celular;
    private $genero;
    private $pais;
    private $login;
    private $senha;
    private $perfil;
    private $ativo;

    public function __construct($id, $nome, $celular, $genero, $pais, $login, $senha, $perfil, $ativo) {
        $this->id = $id;
        $this->nome = $nome;
        $this->celular = $celular;
        $this->genero = $genero;
        $this->pais = $pais;
        $this->login = $login;
        $this->setSenha($senha); 
        $this->perfil = $perfil;
        $this->ativo = $ativo;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getPais() {
        return $this->pais;
    }

    public function getEmailLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function isAtivo() {
        return $this->ativo;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

    public function setEmailLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }
}

?>