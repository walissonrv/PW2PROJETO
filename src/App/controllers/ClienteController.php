<?php

namespace App\Controllers;

use App\Models\Cliente;
use App\Controllers\Conexao;

class ClienteController
{
    private static $instance;

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new ClienteController();
        }
        return self::$instance;
    }

    private function __construct(){
        $conexao =  conexao ::getInstance();
    }

    public function inserir(Cliente $cliente){
        $sql = "INSERT INTO cliente (nome, telefone, email, endereco) VALUES (";
        $sql .= "'" . $cliente->getNome()        . "', ";
        $sql .= "'" . $cliente->getTelefone()    . "', ";
        $sql .= "'" . $cliente->getEmail()       . "', ";
        $sql .= "'" . $cliente->getEndereco()    . "'";
        $sql .= ")";
        return $sql;
    }
}
