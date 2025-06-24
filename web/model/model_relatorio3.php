<?php
include_once '../controller/conecta_banco.php';
class Poluente{

    public function getPoluente($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE WHERE ID LIKE ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getPoluente($DADOS){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE WHERE DADOS LIKE ?");
        $stmt->bind_param("s", $DADOS);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getPoluente($DATA_HORA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE WHERE DATA_HORA LIKE ?");
        $stmt->bind_param("s", $DATA_HORA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getPoluente($TIPO_POLUENTE){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE WHERE TIPO_POLUENTE LIKE ?");
        $stmt->bind_param("s", $TIPO_POLUENTE);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
   
    public function inserirPoluente($dados,$data_hora,$tipo_poluente){
    $conn = Database::getConnection();
    $stmt = $conn->prepare("INSERT INTO poluente(dados,data_hora,tipo_poluente)VALUES dados = ?,data_hora = ?,tipo_poluente = ?");
    $stmt->bind_param("isss",$dados,$data_hora,$tipo_poluente);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
    }
}   

?>