<?php
    require_once 'connection.php';

    class Sala{

        function registasala($codigo, $descricao,$cinema) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("INSERT INTO salas (codigo_salas, descricao_salas, cinema_salas) 
            VALUES (?, ?, ?)");
        
            $stmt->bind_param("isi", $codigo, $descricao,$cinema);
        
            if ($stmt->execute()) {
                $msg = "Registado com sucesso!";
            } else {
                $msg = "Erro ao registar: " . $stmt->error;  
            }
        
            $stmt->close();
            $conn->close();
        
            return $msg;
        }








        function listasalas(){
            global $conn;
            $msg = "<table class='table'>";
            $msg .= "<thead>";
            $msg .= "<tr>";
            
            $msg .= "<th>Codigo</th>";
            $msg .= "<th>descricao</th>";
            $msg .= "<th>cinema</th>";


            $msg .= "<td>Remover</td>";
            $msg .= "<td>Editar</td>";
            
            $msg .= "</tr>";    
            $msg .= "</thead>";
            $msg .= "<tbody>";



            $sql = "SELECT salas.*, cinemas.nome_cinema AS cinemaDaSala
                    FROM salas, cinemas
                    WHERE salas.cinema_salas = cinemas.id_cinema;
                    ";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";

                $msg .= "<th scope='row'>".$row['codigo_salas']."</th>";
                $msg .= "<td>".$row['descricao_salas']."</td>";
                $msg .= "<td>".$row['cinemaDaSala']."</td>";
         
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerSala(".$row['codigo_salas'].")'>Remover</button></td>";
                $msg .= "<td><button type='button' class='btn btn-primary' onclick='editaSala(".$row['codigo_salas'].")'>Editar</button></td>";
                $msg .= "</tr>";
            }
            } else {
                $msg .= "<tr>";
                $msg .= "<th scope='row'> Sem resultados</th>";
                $msg .= "<td></td>";
                $msg .= "<td></td>";
                $msg .= "<td></td>";
                $msg .= "<td></td>";
                $msg .= "<td></td>";
                $msg .= "</tr>";
            }
            $conn->close();

            $msg .= "</tbody>";
            $msg .= "</table>";

            return $msg;
        }
        














        function removersala($codigo){
            global $conn;

            $msg = "";
            $sql = "DELETE FROM salas 
                    WHERE codigo_salas = ".$codigo.";";

            if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

            return $msg;

        }











        function getDadossala($codigo){
            global $conn;

            $sql = "SELECT * FROM salas 
                    WHERE codigo_salas =".$codigo.";";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $conn->close();

            return json_encode($row);

        }











        function editasala($codigo, $descricao,$cinema, $oldKey) {
            global $conn;
        
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("UPDATE salas SET 
                                    codigo_salas = ?,
                                    descricao_salas = ?,
                                    cinema_salas = ?
                                    WHERE codigo_salas = ? ;");
        
            if ($stmt) { 
                $stmt->bind_param("isii",$codigo, $descricao,$cinema, $oldKey);
        
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

















        








        function getSelectCinemas(){
            global $conn;
            $msg = "<option value = '-1'>Escolha uma opção</option>";
            $stmt = "";


            $stmt = $conn->prepare("SELECT * FROM cinemas;");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg .= "<option value = '".$row['id_cinema']."'>".$row['nome_cinema']."</option>";
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