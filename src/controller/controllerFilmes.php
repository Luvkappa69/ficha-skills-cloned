<?php
require_once '../model/modelFilmes.php';

$filme =  new Filme();

if($_POST['op'] == 1){
    $resultado = $filme -> registaFilme(
                                                $_POST['codigoFilme'], 
                                                $_POST['nomeFilme'], 
                                                $_POST['anoFilme'], 
                                                $_POST['descricaoFilme'], 
                                                $_POST['selectTipoFilme']
    );
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $filme -> listaFilme();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $filme -> removerFilme(
                                                $_POST['codigoFilme']                                               
    );
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $filme -> getDadosFilme(
                                                $_POST['codigoFilme']                                               
    );
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $filme -> editaFilme(
                                                $_POST['codigoFilme'], 
                                                $_POST['nomeFilme'], 
                                                $_POST['anoFilme'], 
                                                $_POST['descricaoFilme'], 
                                                $_POST['selectTipoFilme'],
                                                $_POST['oldcodigo_filme']
    );
    echo($resultado);
}

else if($_POST['op'] == 7){
    $resultado = $filme -> getSelectTipos();
    echo($resultado);
}

?>