<?php
    require_once 'connection.php';

    class Local{

        function registaLocal($id, $descricao) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("INSERT INTO locais (id_locais, descricao_locais) VALUES (?, ?)");
        
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
        








        function listaLocal() {
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
        
            $stmt = $conn->prepare("SELECT * FROM locais"); 
        
            if ($stmt) { 
                if ($stmt->execute()) { 
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $msg .= "<tr>";
                            $msg .= "<th scope='row'>" . $row['id_locais'] . "</th>";
                            $msg .= "<td>" . $row['descricao_locais'] . "</td>";
                            $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerLocal(" . $row['id_locais'] . ")'>Remover</button></td>";
                            $msg .= "<td><button type='button' class='btn btn-primary' onclick='editaLocal(" . $row['id_locais'] . ")'>Editar</button></td>";
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
        
        














        function removerLocal($id) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("DELETE FROM locais 
                                    WHERE id_locais = ?");
        
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
        












        function getDadosLocal($id) {
            global $conn;
        
            $stmt = "";
            $dados = null;  
        
            $stmt = $conn->prepare("SELECT * FROM locais 
                                    WHERE id_locais = ?");
        
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
        










        function editaLocal($id, $descricao, $oldID) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("UPDATE locais SET id_locais = ?, descricao_locais = ? WHERE id_locais = ?");
        
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