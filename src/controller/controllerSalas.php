<?php
require_once '../model/modelSalas.php';

$sala =  new Sala();

if($_POST['op'] == 1){
    $resultado = $sala -> registasala(
                                                $_POST['codigo_salas'], 
                                                $_POST['descricao_salas'], 
                                                $_POST['cinema_da_sala'], 

    );
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $sala -> listasalas();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $sala -> removersala(
                                                $_POST['codigo_salas']                                               
    );
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $sala -> getDadossala(
                                                $_POST['codigo_salas']                                               
    );
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $sala -> editasala(
                                                $_POST['codigo_salas'], 
                                                $_POST['descricao_salas'], 
                                                $_POST['cinema_da_sala'], 
                                                $_POST['oldCodigo_salas'], 

    );
    echo($resultado);
}

else if($_POST['op'] == 7){
    $resultado = $sala -> getSelectCinemas();
    echo($resultado);
}
?>