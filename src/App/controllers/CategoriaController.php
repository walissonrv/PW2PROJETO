<?php

namespace App\Controllers;

use App\Models\Categoria;

class CategoriaController
{
    private static $instance;
    private $conexao;

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new CategoriaController();
        }
        return self::$instance;
    }

    private function __construct(){
        $this->conexao = Conexao::getInstance();
    }

    public function excluir($categoria_id){
        $sql = "DELETE FROM categoria WHERE id = :id";
        $statement = $this->conexao->prepare($sql);
        $statement->bindValue(":id", $categoria_id);
        return $statement->execute();
    }

    public function gravar(Categoria $categoria){
        if ($categoria->getId() <= 0){
            return $this->inserir($categoria);
        }else{
            return $this->alterar($categoria);
        }
    }

    private function alterar(Categoria $categoria){
        $sql = "UPDATE categoria SET descricao = :descricao 
                   WHERE id = :id";
        $statement = $this->conexao->prepare($sql);
        $statement->bindValue(":descricao", $categoria->getDescricao());
        $statement->bindValue(":id", $categoria->getId());
        return $statement->execute();
    }

    private function inserir(Categoria $categoria){
        $sql = "INSERT INTO categoria (descricao) 
                VALUES (:descricao)";
        $statement = $this->conexao->prepare($sql);
        $statement->bindValue(":descricao", $categoria->getDescricao());
        return $statement->execute();
    }

    public function buscar($categoria_id){
        $sql = "SELECT * FROM categoria WHERE id = :id";
        $statement = $this->conexao->prepare($sql);
        $statement->bindValue(":id", $categoria_id);
        $statement->execute();
        $retornoBanco = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $categoria = new Categoria();
        foreach ($retornoBanco as $row){
            $categoria = $this->preencher($row);
        }
        return $categoria;
    }

    public function listar(){
        $sql = "SELECT * FROM categoria ORDER BY descricao";
        $statement = $this->conexao->query($sql, \PDO::FETCH_ASSOC);
        $lstretorno = array();
        foreach ($statement as $row){
            $lstretorno[] = $this->preencher($row);
        }
        return $lstretorno;
    }

    public function preencher($row){
        $categoria = new Categoria();
        $categoria->setId($row["id"]);
        $categoria->setDescricao($row["descricao"]);
        return $categoria;
    }

}