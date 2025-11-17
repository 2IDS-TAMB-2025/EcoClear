<?php
require_once '../config/db.php';

class Sensor {
    private $db;

    public function __construct($db){
        $this->db = $db; // PDO connection
    }

    public function getSensor() {
        $stmt = $this->db->query("SELECT * FROM SENSOR ORDER BY NOME ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSensorById($ID){
        $stmt = $this->db->prepare("SELECT * FROM SENSOR WHERE ID = ?");
        $stmt->bindValue(1, $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getSensorByNome($NOME){
        $stmt = $this->db->prepare("SELECT * FROM SENSOR WHERE NOME = ?");
        $stmt->bindValue(1, $NOME);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSensorByTipo($TIPO){
        $stmt = $this->db->prepare("SELECT * FROM SENSOR WHERE TIPO = ?");
        $stmt->bindValue(1, $TIPO);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSensorByLocalizacao($LOCALIZACAO){
        $stmt = $this->db->prepare("SELECT * FROM SENSOR WHERE LOCALIZACAO = ?");
        $stmt->bindValue(1, $LOCALIZACAO);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSensorByStatusSensor($STATUS_SENSOR){
        $stmt = $this->db->prepare("SELECT * FROM SENSOR WHERE STATUS_SENSOR = ?");
        $stmt->bindValue(1, $STATUS_SENSOR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSensorByDataHora($DATA_HORA){
        $stmt = $this->db->prepare("SELECT * FROM SENSOR WHERE DATA_HORA = ?");
        $stmt->bindValue(1, $DATA_HORA);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSensorByFkCnpjEmpresa($FK_CNPJ_EMPRESA){
        $stmt = $this->db->prepare("SELECT * FROM SENSOR WHERE FK_CNPJ_EMPRESA = ?");
        $stmt->bindValue(1, $FK_CNPJ_EMPRESA);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editaSensor($ID, $NOME, $TIPO, $LOCALIZACAO, $STATUS_SENSOR, $DATA_HORA){
        $stmt = $this->db->prepare(
            "UPDATE SENSOR 
             SET NOME = ?, TIPO = ?, LOCALIZACAO = ?, STATUS_SENSOR = ?, DATA_HORA = ?
             WHERE ID = ?"
        );
        $stmt->bindValue(1, $NOME);
        $stmt->bindValue(2, $TIPO);
        $stmt->bindValue(3, $LOCALIZACAO);
        $stmt->bindValue(4, $STATUS_SENSOR);
        $stmt->bindValue(5, $DATA_HORA);
        $stmt->bindValue(6, $ID, PDO::PARAM_INT);
        $stmt->execute();

        // Retorna o sensor atualizado
        return $this->getSensorById($ID);
    }
}
?>
