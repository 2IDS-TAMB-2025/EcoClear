<?php
include_once '../controller/conecta_banco.php';

class Sensor{
    public function getSensor(){
        $conn = Database::getConnection();
        $result = $conn->query("SELECT * FROM SENSOR ORDER BY FK_CNPJ_EMPRESA");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getSensorId($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE ID = ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getSensorNome($NOME){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE NOME = ?");
        $stmt->bind_param("s", $NOME);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getSensorTipo($TIPO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE TIPO = ?");
        $stmt->bind_param("s", $TIPO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getSensorLocalizacao($LOCALIZACAO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE LOCALIZACAO = ?");
        $stmt->bind_param("s", $LOCALIZACAO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getSensorStatusSensor($STATUS_SENSOR){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE STATUS_SENSOR = ?");
        $stmt->bind_param("s", $STATUS_SENSOR);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getSensorDataHora($DATA_HORA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE DATA_HORA = ?");
        $stmt->bind_param("s", $DATA_HORA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getSensorFkCnpjEmpresa($FK_CNPJ_EMPRESA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE FK_CNPJ_EMPRESA = ?");
        $stmt->bind_param("s", $FK_CNPJ_EMPRESA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    public function inserirSensorAdm($ID, $NOME, $TIPO, $LOCALIZACAO, $STATUS_SENSOR,$DATA_HORA, $FK_CNPJ_EMPRESA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO SENSOR (ID, NOME, TIPO, LOCALIZACAO, STATUS_SENSOR, DATA_HORA, FK_CNPJ_EMPRESA)
                                VALUES ID = ?, NOME = ?, TIPO = ?, LOCALIZACAO = ?, STATUS_SENSOR = ?, DATA_HORA = ?, FK_CNPJ_EMPRESA = ?");
        $stmt->bind_param("issssss",$ID,$NOME,$TIPO,$LOCALIZACAO, $STATUS_SENSOR, $DATA_HORA, $FK_CNPJ_EMPRESA);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function editaSensorAdm($ID, $NOME, $TIPO, $LOCALIZACAO, $STATUS_SENSOR,$DATA_HORA, $FK_CNPJ_EMPRESA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE SENSOR SET ID = ?, NOME = ?, TIPO = ?, LOCALIZACAO = ?, STATUS_SENSOR = ?, DATA_HORA = ?, FK_CNPJ_EMPRESA = ?");
        $stmt->bind_param("issssss",$ID, $NOME, $TIPO, $LOCALIZACAO, $STATUS_SENSOR,$DATA_HORA, $FK_CNPJ_EMPRESA);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

      public function excluirSensorAdm($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM SENSOR WHERE ID = ?");
        $stmt->bind_param("i",$ID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }
    
}
?>
