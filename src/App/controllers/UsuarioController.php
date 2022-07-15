<?php
namespace App\Controllers;

use App\Controllers\Conexao;
use App\Models\Usuario;


class UsuarioController
{
    private static $instance;
    private $conexao;

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new UsuarioController();
        }
        return self::$instance;
    }

    private function __construct(){
        $this->conexao = Conexao::getInstance();
    }

    public function inserir(Usuario $usuario){
        $sql = "INSERT INTO usuario (nome, telefone, email, senha) 
                VALUES (:nome, :telefone, :email, :senha)";
        $statement = $this->conexao->prepare($sql);
        $statement->bindValue(":nome", $usuario->getNome());
        $statement->bindValue(":telefone", $usuario->getTelefone());
        $statement->bindValue(":email", $usuario->getEmail());
        $statement->bindValue(":senha", $usuario->getSenha());

        return $statement->execute();
    }

    public function listar(){
        $sql = "SELECT id, nome, email, telefone FROM usuario ORDER BY nome";
        $statement = $this->conexao->query($sql, \PDO::FETCH_ASSOC);
        $lstretorno = array();
        foreach ($statement as $row){
            $lstretorno[] = $this->preencherUsuario($row);
        }
        return $lstretorno;
    }

    public function preencherUsuario($row){
        $usuario = new Usuario();
        $usuario->setId($row["id"]);
        $usuario->setNome($row["nome"]);
        $usuario->setEmail($row["email"]);
        $usuario->setTelefone($row["telefone"]);
        return $usuario;
    }

    public function login($usuario){
        $sql = "SELECT id, nome, email, telefone FROM usuario 
                 WHERE email = :email AND senha = :senha";
        $statement = $this->conexao->prepare($sql);
        $statement->bindValue(":email", $usuario->getEmail());
        $statement->bindValue(":senha", $usuario->getSenha());
        $statement->execute();
        $retornoBanco = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $usuario_retorno = new Usuario();
        foreach ($retornoBanco as $row){
            $usuario_retorno = $this->preencherUsuario($row);
        }
        return $usuario_retorno;
    }
}


