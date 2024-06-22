<?php
    require_once 'connection.php';

    class Sessao{

        function registaSessao($id, $sala,$filme, $data,$hora,$estado) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("INSERT INTO sessoes (id_sessao, sala_sessao, filme_sessao, data_sessao, hora_sessao, estado_sessao) 
            VALUES (?, ?, ?, ?, ?, ?)");
        
            $stmt->bind_param("iiissi", $id, $sala,$filme, $data,$hora,$estado);
        
            if ($stmt->execute()) {
                $msg = "Registado com sucesso!";
            } else {
                $msg = "Erro ao registar: " . $stmt->error;  
            }
        
            $stmt->close();
            $conn->close();
        
            return $msg;
        }
        








        function listaSessao() {
            global $conn;
            $msg = "<table class='table'>";
            $msg .= "<thead>";
            $msg .= "<tr>";
        
            $msg .= "<th>ID</th>";
            $msg .= "<th>Sala</th>";
            $msg .= "<th>Filme</th>";

            $msg .= "<th>Data</th>";
            $msg .= "<th>Hora</th>";
            $msg .= "<th>Estado</th>";
           
        
            $msg .= "<td>Remover</td>";
            $msg .= "<td>Editar</td>";
        
            $msg .= "</tr>";
            $msg .= "</thead>";
            $msg .= "<tbody>";
        
            $stmt = $conn->prepare("SELECT sessoes.*,
                        salas.descricao_salas AS descricaoSala,
                        filmes.nome_filme AS filmeNome,
                        estadodasessao.descricao_estado_sessao AS estado

                        FROM sessoes, salas, filmes, estadodasessao 
                        WHERE sessoes.sala_sessao = salas.codigo_salas AND
                              sessoes.filme_sessao = filmes.codigo_filme AND
                              sessoes.estado_sessao = estadodasessao.id_estado_sessao 
                        ;"); 

            
        
            if ($stmt) { 
                if ($stmt->execute()) { 
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $msg .= "<tr>";

                            $msg .= "<th scope='row'>" . $row['id_sessao'] . "</th>";
                            $msg .= "<td>" . $row['descricaoSala'] . "</td>";
                            $msg .= "<td>" . $row['filmeNome'] . "</td>";
                            
                            $msg .= "<td>" . $row['data_sessao'] . "</td>";
                            $msg .= "<td>" . $row['hora_sessao'] . "</td>";
                            $msg .= "<td>" . $row['estado'] . "</td>";

                            $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerSessao(" . $row['id_sessao'] . ")'>Remover</button></td>";
                            $msg .= "<td><button type='button' class='btn btn-primary' onclick='editaSessao(" . $row['id_sessao'] . ")'>Editar</button></td>";
                            $msg .= "</tr>";
                        }
                        $result->free(); 
                    } else {
                        $msg .= "<tr>";

                        $msg .= "<th scope='row'>Sem resultados</th>";
                        $msg .= "<td>Sem resultados</td>";
                        $msg .= "<td>Sem resultados</td>";

                        $msg .= "<td>Sem resultados</td>";
                        $msg .= "<td>Sem resultados</td>";
                        $msg .= "<td>Sem resultados</td>";
                     

                        $msg .= "<td></td>";
                        $msg .= "<td></td>";
                        $msg .= "</tr>";
                    }
                } else {
                    echo "Error executing query: " . $stmt->error; 
                }
                $stmt->close(); 
            } else {
                echo "Error preparing statement: " . $conn->error; 
            }
        
            $msg .= "</tbody>";
            $msg .= "</table>";

            $conn->close();
        
            return $msg;
        }
        
        














        function removerSessao($codigo) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("DELETE FROM sessoes 
                                    WHERE id_sessao = ?");
        
            $stmt->bind_param("i", $codigo); 
        
            if ($stmt->execute()) {
                $msg = "Removido com sucesso!";
            } else {
                $msg = "Erro ao remover: " . $stmt->error; 
            }
        
            $stmt->close();
            $conn->close();

        
            return $msg;
        }
        












        function getDadosSessao($codigo) {
            global $conn;


            $stmt = $conn->prepare("SELECT * FROM sessoes WHERE id_sessao = ?");
            $stmt->bind_param("i", $codigo);
            $stmt->execute();
    
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

    
            $stmt->close();
            $conn->close();

            
            return json_encode($row);  
        }
        










        function editaSessao($id, $sala,$filme, $data,$hora,$estado, $old_KEY) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("UPDATE sessoes SET 
                                    id_sessao = ?,
                                    sala_sessao = ?,
                                    filme_sessao = ?,  
                                    data_sessao = ?,
                                    hora_sessao = ?,
                                    estado_sessao = ?
                                    WHERE id_sessao = ? ;");
        
            if ($stmt) { 
                $stmt->bind_param("iiissii", $id, $sala,$filme, $data,$hora,$estado, $old_KEY);
        
                if ($stmt->execute()) {
                    $msg = "Edição efetuada";
                } else {
                    $msg = "Erro ao editar: " . $stmt->error; 
                }
                $stmt->close(); 
            } else {
                $msg = "Erro ao preparar a declaração: " . $conn->error;  
            }

            $conn->close();
            echo $codigo, $nome,$ano, $descricao,$tipo, $oldID;
        
            return $msg;

        }
        














        function getSelectSala(){
            global $conn;
            $msg = "<option value = '-1'>Escolha uma opção</option>";
            $stmt = "";
            $stmt = $conn->prepare("SELECT * FROM salas;");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg .= "<option value = '".$row['codigo_salas']."'>".$row['descricao_salas']."</option>";
                }
            } else {
                $msg .= "<option value = '-1'>Sem tipos de filme registados</option>";
            }
            $stmt->close(); 
            $conn->close();
            return $msg;
        }
        function getSelectFilme(){
            global $conn;
            $msg = "<option value = '-1'>Escolha uma opção</option>";
            $stmt = "";
            $stmt = $conn->prepare("SELECT * FROM filmes;");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg .= "<option value = '".$row['codigo_filme']."'>".$row['nome_filme']."</option>";
                }
            } else {
                $msg .= "<option value = '-1'>Sem tipos de filme registados</option>";
            }
            $stmt->close(); 
            $conn->close();
            return $msg;
        }
        function getSelectEstado(){
            global $conn;
            $msg = "<option value = '-1'>Escolha uma opção</option>";
            $stmt = "";
            $stmt = $conn->prepare("SELECT * FROM estadodasessao;");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg .= "<option value = '".$row['id_estado_sessao']."'>".$row['descricao_estado_sessao']."</option>";
                }
            } else {
                $msg .= "<option value = '-1'>Sem tipos de filme registados</option>";
            }
            $stmt->close(); 
            $conn->close();
            return $msg;
        }





        
    }

    
?>