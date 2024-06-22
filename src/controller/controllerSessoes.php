<?php
require_once '../model/modelSessoes.php';

$sessao =  new Sessao();

if($_POST['op'] == 1){
    $resultado = $sessao -> registaSessao(
                                                $_POST['id_sessao'], 
                                                $_POST['sala_sessao'], 
                                                $_POST['filme_sessao'], 

                                                $_POST['data_sessao'], 
                                                $_POST['hora_sessao'], 
                                                $_POST['estado_sessao'], 

    );
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $sessao -> listaSessao();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $sessao -> removerSessao(
                                                $_POST['id_sessao']                                               
    );
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $sessao -> getDadosSessao(
                                                $_POST['id_sessao']                                               
    );
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $sessao -> editaSessao(
                                                $_POST['id_sessao'], 
                                                $_POST['sala_sessao'], 
                                                $_POST['filme_sessao'], 

                                                $_POST['data_sessao'], 
                                                $_POST['hora_sessao'], 
                                                $_POST['estado_sessao'],  
                                                $_POST['old_id_sessao']
    );
    echo($resultado);
}

else if($_POST['op'] == 7){
    $resultado = $sessao -> getSelectSala();
    echo($resultado);
}else if($_POST['op'] == 8){
    $resultado = $sessao -> getSelectFilme();
    echo($resultado);
}else if($_POST['op'] == 9){
    $resultado = $sessao -> getSelectEstado();
    echo($resultado);
}
?>