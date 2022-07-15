<?php

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Produto;

class ProdutoController{
    private static $instance;
    private $conexao;

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new ProdutoController();
        }
        return self::$instance;
    }

    private function __construct(){
        $this->conexao = Conexao::getInstance();
    }

    public function excluir($produto_id){
        $produto = $this->buscarProduto($produto_id);
        $dir = __DIR__ . "/../../../views/imagens/produtos/";
        unlink($dir . $produto->getImagem());
        $sql = "DELETE FROM produto WHERE id = :id";
        $statement = $this->conexao->prepare($sql);
        $statement->bindValue(":id", $produto_id);
        return $statement->execute();
    }

    public function gravar(Produto $produto){
        if ($produto->getId() <= 0){
            return $this->inserir($produto);
        }else{
            return $this->alterar($produto);
        }
    }

    private function alterar(Produto $produto){
        $sql = "UPDATE produto SET nome = :nome, 
                   descricao = :descricao, valor = :valor, 
                   imagem = :imagem, categoria_id = :categoria_id 
               WHERE id = :id";
        $statement = $this->conexao->prepare($sql);
        $statement->bindValue(":nome", $produto->getNome());
        $statement->bindValue(":descricao", $produto->getDescricao());
        $statement->bindValue(":valor", $produto->getValor());
        $statement->bindValue(":imagem", $produto->getImagem());
        $statement->bindValue(":categoria_id", $produto->getCategoria()->getId());
        $statement->bindValue(":id", $produto->getId());

        return $statement->execute();
    }

    private function inserir(Produto $produto){
        $sql = "INSERT INTO produto (nome, descricao, valor, imagem, categoria_id) 
                VALUES (:nome, :descricao, :valor, :imagem, :categoria_id)";
        $statement = $this->conexao->prepare($sql);
        $statement->bindValue(":nome", $produto->getNome());
        $statement->bindValue(":descricao", $produto->getDescricao());
        $statement->bindValue(":valor", $produto->getValor());
        $statement->bindValue(":imagem", $produto->getImagem());
        $statement->bindValue(":categoria_id", $produto->getCategoria()->getId());

        return $statement->execute();
    }

    public function buscarProduto($produto_id){
        $sql = "SELECT p.*, c.descricao AS categoria FROM produto AS p 
                    INNER JOIN categoria AS c ON c.id = p.categoria_id 
                WHERE p.id = :id";
        $statement = $this->conexao->prepare($sql);
        $statement->bindValue(":id", $produto_id);
        $statement->execute();
        $retornoBanco = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $produto = new Produto();
        foreach ($retornoBanco as $row){
            $produto = $this->preencherProduto($row);
        }
        return $produto;
    }

    public function listar(){
        $sql = "SELECT p.*, c.descricao AS categoria FROM produto AS p 
                    INNER JOIN categoria AS c ON c.id = p.categoria_id ORDER BY p.nome";
        $statement = $this->conexao->query($sql, \PDO::FETCH_ASSOC);
        $lstretorno = array();
        foreach ($statement as $row){
            $lstretorno[] = $this->preencherProduto($row);
        }
        return $lstretorno;
    }

    public function preencherProduto($row){
        $produto = new Produto();
        $produto->setId($row["id"]);
        $produto->setNome($row["nome"]);
        $produto->setDescricao($row["descricao"]);
        $produto->setValor($row["valor"]);
        $produto->setImagem($row["imagem"]);
        $categoria = new Categoria();
        $categoria->setId($row["categoria_id"]);
        $categoria->setDescricao($row["categoria"]);
        $produto->setCategoria($categoria);
        return $produto;
    }
}