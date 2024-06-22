<?php
    require_once 'connection.php';

    class Filme{

        function registaFilme($codigo, $nome,$ano, $descricao,$tipo) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("INSERT INTO filmes (codigo_filme, nome_filme, ano_filme, decricao_filme, tipoDefilme_filme) 
            VALUES (?, ?, ?, ?, ?)");
        
            $stmt->bind_param("isisi", $codigo, $nome,$ano, $descricao,$tipo);
        
            if ($stmt->execute()) {
                $msg = "Registado com sucesso!";
            } else {
                $msg = "Erro ao registar: " . $stmt->error;  
            }
        
            $stmt->close();
            $conn->close();
        
            return $msg;
        }
        








        function listaFilme() {
            global $conn;
            $msg = "<table class='table'>";
            $msg .= "<thead>";
            $msg .= "<tr>";
        
            $msg .= "<th>Codigo</th>";
            $msg .= "<th>Nome</th>";
            $msg .= "<th>Ano</th>";
            $msg .= "<th>Descricao</th>";
            $msg .= "<th>Tipo de Filme</th>";
        
            $msg .= "<td>Remover</td>";
            $msg .= "<td>Editar</td>";
        
            $msg .= "</tr>";
            $msg .= "</thead>";
            $msg .= "<tbody>";
        
            $stmt = $conn->prepare("SELECT filmes.*, tiposdefilme.descricao_tipo_filme AS descricaoTipo
                        FROM filmes, tiposdefilme
                        WHERE filmes.tipoDefilme_filme = tiposdefilme.id_tipo_filme ;
                        "); 

            
        
            if ($stmt) { 
                if ($stmt->execute()) { 
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $msg .= "<tr>";

                            $msg .= "<th scope='row'>" . $row['codigo_filme'] . "</th>";
                            $msg .= "<td>" . $row['nome_filme'] . "</td>";
                            $msg .= "<td>" . $row['ano_filme'] . "</td>";
                            $msg .= "<td>" . $row['decricao_filme'] . "</td>";
                            $msg .= "<td>" . $row['descricaoTipo'] . "</td>";

                            $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerFilme(" . $row['codigo_filme'] . ")'>Remover</button></td>";
                            $msg .= "<td><button type='button' class='btn btn-primary' onclick='editaFilme(" . $row['codigo_filme'] . ")'>Editar</button></td>";
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
        
        














        function removerFilme($codigo) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("DELETE FROM filmes 
                                    WHERE codigo_filme = ?");
        
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
        












        function getDadosFilme($codigo) {
            global $conn;


            $stmt = $conn->prepare("SELECT * FROM filmes WHERE codigo_filme = ?");
            $stmt->bind_param("i", $codigo);
            $stmt->execute();
    
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

    
            $stmt->close();
            $conn->close();

            
            return json_encode($row);  
        }
        










        function editaFilme($codigo, $nome,$ano, $descricao,$tipo, $oldID) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("UPDATE filmes SET 
                                    codigo_filme = ?,
                                    nome_filme = ?,
                                    ano_filme = ?,  
                                    decricao_filme = ?,
                                    tipoDefilme_filme = ?
                                    WHERE codigo_filme = ? ;");
        
            if ($stmt) { 
                $stmt->bind_param("isisii", $codigo, $nome,$ano, $descricao,$tipo, $oldID);
        
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
        














        function getSelectTipos(){
            global $conn;
            $msg = "<option value = '-1'>Escolha uma opção</option>";
            $stmt = "";


            $stmt = $conn->prepare("SELECT * FROM tiposdefilme;");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg .= "<option value = '".$row['id_tipo_filme']."'>".$row['descricao_tipo_filme']."</option>";
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