<?php
include_once '../controller/conecta_banco.php';
class Poluente{

    public function getPoluenteId($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE WHERE ID = ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getPoluenteDados($DADOS){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE WHERE DADOS LIKE ?");
        $likeDados = "%".$DADOS."%";
        $stmt->bind_param("s", $likeDados);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getPoluenteDataHora($DATA_HORA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE WHERE DATA_HORA LIKE ?");
        $stmt->bind_param("s", $DATA_HORA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getPoluenteTipo($TIPO_POLUENTE){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE WHERE TIPO_POLUENTE LIKE ?");
        $stmt->bind_param("s", $TIPO_POLUENTE);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
   
    public function inserirPoluente($dados, $data_hora, $tipo_poluente){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO POLUENTE (dados, data_hora, tipo_poluente) VALUES (?, ?, ?) WHERE ID = ?");
        $stmt->bind_param("sss", $dados, $data_hora, $tipo_poluente);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

}   
?>