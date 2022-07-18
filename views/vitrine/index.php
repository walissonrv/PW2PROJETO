
<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use App\Controllers\CategoriaController;
use App\Controllers\ProdutoController;
$listaCategorias = CategoriaController::getInstance()->listar();
if (isset($_GET['categoria_id'])){
    $listaProdutos = ProdutoController::getInstance()->listarPorCategoria($_GET['categoria_id']);
}else{
    $listaProdutos = ProdutoController::getInstance()->listar();
}

?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delivery do Quinto Período</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header id="header">
        <nav class="navbar navbar-expand-lg" id="menu-vitrine">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="./imagens/food-delivery-logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../vitrine/index.php">Home</a>
                            <a class="nav-link active" aria-current="page" href="../list-produto.php">Voltar</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menu
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <?php
                                foreach ($listaCategorias as $categoria){
                                    echo "<li><a class=\"dropdown-item\" href=\"index.php?categoria_id=".$categoria->getId()."\">".$categoria->getDescricao()."</a></li>";
                                }
                                ?>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container" id="conteudo-menu">
            <?php
            if (count($listaProdutos) == 0){
                echo "<h2>Categoria sem produto</h2>";
            }
            foreach ($listaProdutos as $produto){
                echo "<div class=\"card item-menu\" style=\"width: 18rem;\">
                <img src=\"../imagens/produtos/".$produto->getImagem()."\" class=\"card-img-top\" alt=\"...\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">".$produto->getNome()."</h5>
                    <p class=\"card-text\">R$ ".number_format($produto->getValor(), 2, ",", ".")."</p>
                    <a href=\"#\" class=\"btn btn-danger\">Comprar</a>
                </div>
            </div>";
            }
            ?>

        </div>
    </main>
    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>