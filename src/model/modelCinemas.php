<?php
    require_once 'connection.php';

    class Cinema{

        function registaCinema($id, $nome,$local) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("INSERT INTO cinemas (id_cinema, nome_cinema, local_cinema) 
            VALUES (?, ?, ?)");
        
            $stmt->bind_param("isi", $id, $nome,$local);
        
            if ($stmt->execute()) {
                $msg = "Registado com sucesso!";
            } else {
                $msg = "Erro ao registar: " . $stmt->error;  
            }
        
            $stmt->close();
            $conn->close();
        
            return $msg;
        }
        








        function listaCinemas() {
            global $conn;
            $msg = "<table class='table'>";
            $msg .= "<thead>";
            $msg .= "<tr>";
        
            $msg .= "<th>ID</th>";
            $msg .= "<th>Nome</th>";
            $msg .= "<th>Local</th>";

        
            $msg .= "<td>Remover</td>";
            $msg .= "<td>Editar</td>";
        
            $msg .= "</tr>";
            $msg .= "</thead>";
            $msg .= "<tbody>";
        
            $stmt = $conn->prepare("SELECT cinemas.*, locais.descricao_locais AS descricaoLocal
                        FROM cinemas, locais
                        WHERE cinemas.local_cinema = locais.id_locais ;
                        "); 

            
        
            if ($stmt) { 
                if ($stmt->execute()) { 
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $msg .= "<tr>";

                            $msg .= "<th scope='row'>" . $row['id_cinema'] . "</th>";
                            $msg .= "<td>" . $row['nome_cinema'] . "</td>";
                            $msg .= "<td>" . $row['descricaoLocal'] . "</td>";


                            $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerCinema(" . $row['id_cinema'] . ")'>Remover</button></td>";
                            $msg .= "<td><button type='button' class='btn btn-primary' onclick='editaCinema(" . $row['id_cinema'] . ")'>Editar</button></td>";
                            $msg .= "</tr>";
                        }
                        $result->free(); 
                    } else {
                        $msg .= "<tr>";

                        $msg .= "<th scope='row'>Sem resultados</th>";
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
        
        














        function removerCinema($codigo) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("DELETE FROM cinemas 
                                    WHERE id_cinema = ?");
        
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
        












        function getDadosCinema($codigo) {
            global $conn;


            $stmt = $conn->prepare("SELECT * FROM cinemas WHERE id_cinema = ?");
            $stmt->bind_param("i", $codigo);
            $stmt->execute();
    
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

    
            $stmt->close();
            $conn->close();

            
            return json_encode($row);  
        }
        










        function editaCinema($id, $nome,$local, $oldKEY) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("UPDATE cinemas SET 
                                    id_cinema = ?,
                                    nome_cinema = ?,
                                    local_cinema = ?

                                    WHERE id_cinema = ? ;");
        
            if ($stmt) { 
                $stmt->bind_param("isii",$id, $nome,$local, $oldKEY);
        
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
        














        function getSelectLocais(){
            global $conn;
            $msg = "<option value = '-1'>Escolha uma opção</option>";
            $stmt = "";


            $stmt = $conn->prepare("SELECT * FROM locais;");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg .= "<option value = '".$row['id_locais']."'>".$row['descricao_locais']."</option>";
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