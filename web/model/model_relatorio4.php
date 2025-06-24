<?php
include_once '../controller/conecta_banco.php';
class Sensor{

    public function getSensor($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE ID LIKE ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getSensor($NOME){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE NOME =?");
        $stmt->bind_param("s", $NOME);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getSensor($TIPO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE TIPO =?");
        $stmt->bind_param("s", $TIPO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getSensor($LOCALIZACAO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE LOCALIZACAO =?");
        $stmt->bind_param("s", $LOCALIZACAO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getSensor($STATUS_SENSOR){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE STATUS_SENSOR =?");
        $stmt->bind_param("s", $STATUS_SENSOR);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getSensor($DATA_HORA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE DATA_HORA =?");
        $stmt->bind_param("s", $DATA_HORA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getSensor($FK_CNPJ_EMPRESA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE FK_CNPJ_EMPRESA =?");
        $stmt->bind_param("s", $FK_CNPJ_EMPRESA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 
    public function editaSensor($NOME,$TIPO,$LOCALIZACAO,$STATUS_SENSOR,$DATA_HORA,$FK_CNPJ_EMPRESA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE SENSOR SET NOME = ?, TIPO = ?, LOCALIZACAO = ?, STATUS_SENDOR = ?, DATA_HORA = ?, FK_CNPJ_EMPRESA = ? WHERE ID = ?");
        $stmt->bind_param("ssssss",$NOME,$TIPO, $LOCALIZACAO,$STATUS_SENSOR,$DATA_HORA,$FK_CNPJ_EMPRESA);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
        }
}
?>