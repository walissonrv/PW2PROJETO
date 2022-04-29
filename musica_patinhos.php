<?php

if (isset($_POST['npatinhos'])){
    echo "Voce informou e numero " . $_POST['npatinhos'] . "<br><br>";
    $npatinhos = $_POST['npatinhos'];
    for ($i = $npatinhos; $i > 0; $i--){

        if ($i == 1){
            echo $i . " patinho foi passear<br>";
        }else{
            echo $i . " patinhos foram passear<br>";
        }

        echo "além das montanhas para brincar<br>";
        echo "a mamãe patinha fez cuá, cuá, cuá<br>";

        if ($i == 2){
            echo "mas somente " . ($i - 1) . " patinho voltou de lá<br><br>";
        }elseif ($i == 1){
            echo "mas nenhum patinho voltou de lá<br><br>";
        }else{
            echo "mas somente " . ($i - 1) . " patinhos voltaram de lá<br><br>";
        }
    }
}

echo "<br><a href='index.html'>Voltar</a>";
