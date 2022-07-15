<?php
require_once __DIR__ . "/../vendor/autoload.php";
//require_once 'verifica-sessao.php';

use App\Models\Categoria;
use App\Controllers\CategoriaController;
$categoria = new Categoria();
if (isset($_GET['alterar'])){
    $categoria = CategoriaController::getInstance()->buscar($_GET['produto_id']);
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
    <div class="row">
        <h4>Cadastro de Categorias</h4>
    </div>
    <div class="row">

        <?php

        $sucesso = false;
        if (isset($_POST['enviar'])){

            $categoria->setId($_POST['id']);
            $categoria->setDescricao($_POST['descricao']);

            if (CategoriaController::getInstance()->gravar($categoria)){
                $sucesso = true;
            }
        }

        if ($sucesso) {
            ?>
            <div class="alert alert-primary" role="alert">
                Categoria inserida com sucesso!
            </div>
            <?php
        }
        ?>
        <form action="#" method="post" class="col s6 " enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $categoria->getId();?>">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">description</i>
                    <input id="icon_prefix" type="text" class="validate" name="descricao"
                           required value="<?php echo $categoria->getDescricao();?>">
                    <label for="icon_prefix">Descricão</label>
                </div>
            </div>

            <div class="row">
                <div class="col col-6">
                    <a href="list-usuario.php" class="btn waves-effect waves-light red"><i class="material-icons left">cancel</i>Cancelar</a>
                </div>
                <div class="col col-6">
                    <button class="btn waves-effect waves-light" type="submit" name="enviar">Enviar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>