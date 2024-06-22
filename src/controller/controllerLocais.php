<?php
require_once '../model/modelLocais.php';

$local =  new Local();

if($_POST['op'] == 1){
    $resultado = $local -> registaLocal(
                                                $_POST['idLocal'], 
                                                $_POST['descricaoLocal'], 
                                         
    );
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $local -> listaLocal();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $local -> removerLocal(
                                                $_POST['idLocal']                                               
    );
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $local -> getDadosLocal(
                                                $_POST['idLocal']                                               
    );
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $local -> editaLocal(
                                                $_POST['idLocal'], 
                                                $_POST['descricaoLocal'], 
                                                $_POST['oldidLocal']
    );
    echo($resultado);
}
?>