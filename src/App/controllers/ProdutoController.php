<?php
namespace App\Controllers;

use App\Models\Produto;
use App\Controllers\Conexao;

class ProdutoController
{
    private static $instance;
    private $conexao;

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new ProdutoController();
        }
        return self::$instance;
    }

    private function __construct(){
        $this->conexao=  conexao ::getInstance();
    }

    public function inserir(Produto $produto){
        $sql = "INSERT INTO Produto (nome, descricao, valor, imagem) 
                VALUES(:nome, :descricao, :valor, :imagem)";
        $statement=$this->conexao->prepare($sql);
        $statement->bindValue("nome",$produto->getNome());
        $statement->bindValue("descricao",$produto->getdescricao());
        $statement->bindValue("valor",$produto->getvalor());
        $statement->bindValue("imagem",$produto->getimagem());



        return $statement->execute();
    }

    public function listar(){
        $sql = "SELECT id, nome, descricao, valor, imagem FROM Produto ORDER BY nome";
        $statemet = $this->conexao->query($sql, \PDO::FETCH_ASSOC);
        $lstretorno =array();
        foreach ($statemet as $row){
            $lstretorno[]=$this->preencherProduto($row);
        }
        return $lstretorno;

    }
    public function preencherProduto($row){
        $produto= new Produto();
        $produto->setId($row["id"]);
        $produto->setNome($row["nome"]);
        $produto->setDescricao($row["descricao"]);
        $produto->setValor($row["valor"]);
        $produto->setImagem($row["imagem"]);
        return $produto;
    }

}