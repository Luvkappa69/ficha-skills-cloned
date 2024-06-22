<?php
require_once '../model/modeltipo_filme.php';

$tipo_filme =  new Tipo_filme();

if($_POST['op'] == 1){
    $resultado = $tipo_filme -> registatipo_filme(
                                                $_POST['idTipoDeFilme'], 
                                                $_POST['descricaoTipoDeFilme'], 
                                         
    );
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $tipo_filme -> listatipo_filme();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $tipo_filme -> removertipo_filme(
                                                $_POST['idTipoDeFilme']                                               
    );
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $tipo_filme -> getDadostipo_filme(
                                                $_POST['idTipoDeFilme']                                               
    );
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $tipo_filme -> editatipo_filme(
                                                $_POST['idTipoDeFilme'], 
                                                $_POST['descricaoTipoDeFilme'],  
                                                $_POST['oldidTipoDeFilme']
    );
    echo($resultado);
}
?>