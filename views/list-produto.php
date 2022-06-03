<?php
require_once __DIR__ . "/../vendor/autoload.php";

use App\Models\Produto;
use App\Controllers\ProdutoController;
$exclusao= false;
if(isset($_GET['excluir'])){
    if(ProdutoController::getInstance()->excluir($_GET['produto_id'])){
        $exclusao=true;

    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?php
include_once "menu.php";
?>
<div class="container">
    <?php
    if($exclusao){
        ?>
        <div class="alert alert-primary" role="alert">
            Produto excluido com sucesso!
        </div>
        <?php
    }
    ?>
    <div class="row">
        <h4>Lista de Produtos</h4>
    </div>
    <div class="row">
        <div class="col-2">
            <a href="cad-produto.php" class="btn waves-effect waves-light"  role="button  ">Novo Produto</a>
        </div>
        <?php
        $listaProdutos= ProdutoController::getInstance()->listar();
        ?>
        <table class="table table-hover">

            <thead>
            <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Valor</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($listaProdutos as $produto){
                echo "<tr>
                                <td><img src='./imagens/produtos/".$produto->getImagem()."' width='150px' height='150px' </td>
                                <td>".$produto->getNome()."</td>
                                <td>".$produto->getDescricao()."</td>
                                <td>".$produto->getValor()."</td>
                                <td><a href='list.produto.php?excluir=true&produto_id=".$produto->getId()."' class='waves-effect waves-light btn red' alt='Excluir'title='Excluir'><span class='material-icons'>
delete
</span></a></td>
                              </tr>";
            }
            ?>


            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>