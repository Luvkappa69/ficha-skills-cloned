<?php
require_once '../model/modelCinemas.php';

$cinema =  new Cinema();

if($_POST['op'] == 1){
    $resultado = $cinema -> registaCinema(
                                                $_POST['id_cinema'], 
                                                $_POST['nome_cinema'], 
                                                $_POST['local_cinema'], 

    );
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $cinema -> listaCinemas();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $cinema -> removerCinema(
                                                $_POST['id_cinema']                                               
    );
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $cinema -> getDadosCinema(
                                                $_POST['id_cinema']                                               
    );
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $cinema -> editaCinema(
                                                $_POST['id_cinema'], 
                                                $_POST['nome_cinema'], 
                                                $_POST['local_cinema'], 
                                                $_POST['old_id_cinema']
    );
    echo($resultado);
}

else if($_POST['op'] == 7){
    $resultado = $cinema -> getSelectLocais();
    echo($resultado);
}
?>