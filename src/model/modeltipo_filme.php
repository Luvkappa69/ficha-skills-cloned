<?php
    require_once 'connection.php';

    class Tipo_filme{

        function registatipo_filme($id, $descricao) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("INSERT INTO tiposdefilme (id_tipo_filme, descricao_tipo_filme) VALUES (?, ?)");
        
            $stmt->bind_param("is", $id, $descricao);
        
            if ($stmt->execute()) {
                $msg = "Registado com sucesso!";
            } else {
                $msg = "Erro ao registar: " . $stmt->error;  
            }
        
            $stmt->close();
            $conn->close();
        
            return $msg;
        }
        








        function listatipo_filme() {
            global $conn;
            $msg = "<table class='table'>";
            $msg .= "<thead>";
            $msg .= "<tr>";
        
            $msg .= "<th>ID</th>";
            $msg .= "<th>Descrição</th>";
        
            $msg .= "<td>Remover</td>";
            $msg .= "<td>Editar</td>";
        
            $msg .= "</tr>";
            $msg .= "</thead>";
            $msg .= "<tbody>";
        
            $stmt = $conn->prepare("SELECT * FROM tiposdefilme"); 
        
            if ($stmt) { 
                if ($stmt->execute()) { 
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $msg .= "<tr>";
                            $msg .= "<th scope='row'>" . $row['id_tipo_filme'] . "</th>";
                            $msg .= "<td>" . $row['descricao_tipo_filme'] . "</td>";
                            $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerTipoDeFilme(" . $row['id_tipo_filme'] . ")'>Remover</button></td>";
                            $msg .= "<td><button type='button' class='btn btn-primary' onclick='editaTipoDeFilme(" . $row['id_tipo_filme'] . ")'>Editar</button></td>";
                            $msg .= "</tr>";
                        }
                        $result->free(); // Free result set
                    } else {
                        $msg .= "<tr>";
                        $msg .= "<th scope='row'> Sem resultados</th>";
                        $msg .= "<td></td>";
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
        
        














        function removertipo_filme($id) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("DELETE FROM tiposdefilme 
                                    WHERE id_tipo_filme = ?");
        
            $stmt->bind_param("i", $id); // Bind ID as an integer
        
            if ($stmt->execute()) {
                $msg = "Removido com sucesso!";
            } else {
                $msg = "Erro ao remover: " . $stmt->error;  // Handle execution errors
            }
        
            $stmt->close();
            $conn->close();

        
            return $msg;
        }
        












        function getDadostipo_filme($id) {
            global $conn;
        
            $stmt = "";
            $dados = null;  
        
            $stmt = $conn->prepare("SELECT * FROM tiposdefilme 
                                    WHERE id_tipo_filme = ?");
        
            $stmt->bind_param("i", $id);  
        
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $dados = $result->fetch_assoc();
                }
                $result->free();  
            } else {
                echo "Erro ao obter dados: " . $stmt->error; 
            }
        
            $stmt->close();
            $conn->close();

            
            return json_encode($dados);  
        }
        










        function editatipo_filme($id, $descricao, $oldID) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("UPDATE tiposdefilme SET id_tipo_filme = ?, descricao_tipo_filme = ? WHERE id_tipo_filme = ?");
        
            if ($stmt) { 
                $stmt->bind_param("isi", $id, $descricao, $oldID);
        
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
        
            return $msg;
        }
        


    }

    
?>