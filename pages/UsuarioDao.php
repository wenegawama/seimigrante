<?php
require_once __DIR__ . '/../db/DBConnection.php';
require_once 'Usuario.php';

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $db = new DBConnection();
        $this->conn = $db->getConnection();
    }

    public function criar(Usuario $usuario) {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO usuario (nome, celular, genero, pais, login, senha, perfil, ativo) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );

            return $stmt->execute([
                $usuario->getNome(),
                $usuario->getCelular(),
                $usuario->getGenero(),
                $usuario->getPais(),
                $usuario->getEmailLogin(),
                $usuario->getSenha(),
                $usuario->getPerfil(),
                $usuario->isAtivo()
            ]);
        } catch (PDOException $e) {
            error_log("Erro ao criar usuário: " . $e->getMessage());
            return false;
        }
    }

    public function autenticar($login, $senha) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE login = ?");
            $stmt->execute([$login]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                return new Usuario(
                    $usuario['id'],
                    $usuario['nome'],
                    $usuario['celular'],
                    $usuario['genero'],
                    $usuario['pais'],
                    $usuario['login'],
                    $usuario['senha'],
                    $usuario['perfil'],
                    $usuario['ativo']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Erro na autenticação: " . $e->getMessage());
            return null;
        }
    }

    public function listarTodos() {
    try {
        $stmt = $this->conn->query("SELECT * FROM usuario ORDER BY nome");
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $listaUsuarios = [];
        foreach ($usuarios as $usuario) {
            $listaUsuarios[] = new Usuario(
                $usuario['id'],
                $usuario['nome'],
                $usuario['celular'],
                $usuario['genero'],
                $usuario['pais'],
                $usuario['login'],
                $usuario['senha'],
                $usuario['perfil'],
                $usuario['ativo']
            );
        }
        return $listaUsuarios;
        } catch (PDOException $e) {
            error_log("Erro ao listar usuários: " . $e->getMessage());
            return [];
        }
    }

    public function buscarPorId($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE id = ?");
            $stmt->execute([$id]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                return new Usuario(
                    $usuario['id'],
                    $usuario['nome'],
                    $usuario['celular'],
                    $usuario['genero'],
                    $usuario['pais'],
                    $usuario['login'],
                    $usuario['senha'],
                    $usuario['perfil'],
                    $usuario['ativo']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Erro ao buscar usuário: " . $e->getMessage());
            return null;
        }
    }

    public function verificarEmailExistente($email) {
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM usuario WHERE login = ?");
            $stmt->execute([$email]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao verificar email: " . $e->getMessage());
            return false;
        }
    }

    public function atualizar(Usuario $usuario) {
        try {
            $stmt = $this->conn->prepare(
                "UPDATE usuario 
                 SET nome = ?, celular = ?, genero = ?, pais = ?, 
                     login = ?, perfil = ?, ativo = ? 
                 WHERE id = ?"
            );

            return $stmt->execute([
                $usuario->getNome(),
                $usuario->getCelular(),
                $usuario->getGenero(),
                $usuario->getPais(),
                $usuario->getEmailLogin(),
                $usuario->getPerfil(),
                $usuario->isAtivo(),
                $usuario->getId()
            ]);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar usuário: " . $e->getMessage());
            return false;
        }
    }

    public function atualizarSenha($id, $novaSenha) {
        try {
            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("UPDATE usuario SET senha = ? WHERE id = ?");
            return $stmt->execute([$senhaHash, $id]);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar senha: " . $e->getMessage());
            return false;
        }
    }

    public function deletar($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM usuario WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Erro ao deletar usuário: " . $e->getMessage());
            return false;
        }
    }
}
?>