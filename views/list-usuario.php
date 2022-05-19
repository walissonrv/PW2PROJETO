<?php
require_once __DIR__ . "/../vendor/autoload.php";

use App\Models\Usuario;
use App\Controllers\UsuarioController;
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
<nav>
    <div class="nav-wrapper cyan">
        <a href="#" class="brand-logo">Cadastro de Cliente</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#">Cadastro de Cliente</a></li>
            <li><a href="#">Cadastro de Produto</a></li>
            <li><a href="#">Vendas</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <?php
        $listaUsuarios = UsuarioController::getInstance()->listar();
        ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>-</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($listaUsuarios as $usuario){
                echo "<tr>
                                <td>".$usuario->getNome()."</td>
                                <td>".$usuario->getEmail()."</td>
                                <td></td>
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
