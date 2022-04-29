<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <title>Document</title>
</head>
<body>

<?php

if (isset($_POST['nelefantes'])){
    echo "Voce informou e numero " . $_POST['nelefantes'] . "<br><br>";
    $nelefantes = $_POST['nelefantes'];
    for ($i = 1; $i <= $nelefantes; $i++){

        if (($i % 2) != 0){
            if ($i == 1){
                echo $i . " elefante incomoda muita gente<br>";
            }else{
                echo $i . " elefantes incomodam muita gente<br>";
            }
        }else{
            echo $i . " elefantes ";
            for ($j = 0; $j < $i; $j++){
                echo "incomodam ";
            }
            echo "muito mais<br><br>";
        }

    }
}else{
    echo "Voce nao informou o numero de elefantes<br>";
}

echo "<br><a class='waves-effect waves-light btn' href='entrada_elefante.html'><i class='material-icons left'>arrow_back</i>Voltar</a>";
?>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
