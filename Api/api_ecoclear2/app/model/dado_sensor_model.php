<?php
include_once '../config/db.php';

class DadoSensor {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getDadoSensor() {
        $stmt = $this->db->query("SELECT * FROM DADO_SENSOR ORDER BY DATA_HORA DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDadosMedidasSensores($cnpj){
        $stmt = $this->db->prepare("SELECT  DS.FK_ID_SENSOR,
                                        DS.DADO,
                                        S.NOME,
                                        S.TIPO,
                                        DS.DATA_HORA
                                FROM 	DADO_SENSOR DS
                                JOIN 	SENSOR S ON S.ID = DS.FK_ID_SENSOR
                                JOIN (
                                        SELECT FK_ID_SENSOR, 
                                                MAX(DATA_HORA) AS MAX_DATA_HORA
                                        FROM 	DADO_SENSOR
                                        GROUP BY	FK_ID_SENSOR
                                ) UltimoDado ON DS.FK_ID_SENSOR = UltimoDado.FK_ID_SENSOR 
                                            AND DS.DATA_HORA = UltimoDado.MAX_DATA_HORA
                                WHERE S.FK_CNPJ_EMPRESA = :cnpj");
        $stmt->bindValue(":cnpj", $cnpj);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTodasMedidasSensores($cnpj){
        $stmt = $this->db->prepare("SELECT  DS.FK_ID_SENSOR,
                                        DS.DADO,
                                        S.NOME,
                                        S.TIPO,
                                        DS.DATA_HORA
                                FROM 	DADO_SENSOR DS
                                JOIN 	SENSOR S ON S.ID = DS.FK_ID_SENSOR
                                WHERE S.FK_CNPJ_EMPRESA = :cnpj");
        $stmt->bindValue(":cnpj", $cnpj);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDadoSensorId($ID){
        $stmt = $this->db->prepare("SELECT * FROM DADO_SENSOR WHERE ID = :id");
        $stmt->bindValue(":id", $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDadoSensorPeloSensorId($FK_ID_SENSOR){
        $stmt = $this->db->prepare("SELECT * FROM DADO_SENSOR WHERE FK_ID_SENSOR = :id");
        $stmt->bindValue(":id", $FK_ID_SENSOR, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUltimoDadoSensor($FK_ID_SENSOR){
        $stmt = $this->db->prepare("
            SELECT * FROM DADO_SENSOR 
            WHERE FK_ID_SENSOR = :id 
            ORDER BY DATA_HORA DESC 
            LIMIT 1
        ");
        $stmt->bindValue(":id", $FK_ID_SENSOR, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDadosPorPeriodo($FK_ID_SENSOR, $dataHoraInicio, $dataHoraFim){
        $stmt = $this->db->prepare("
            SELECT * FROM DADO_SENSOR 
            WHERE FK_ID_SENSOR = :id
            AND DATA_HORA BETWEEN :inicio AND :fim
            ORDER BY DATA_HORA ASC
        ");
        $stmt->bindValue(":id", $FK_ID_SENSOR, PDO::PARAM_INT);
        $stmt->bindValue(":inicio", $dataHoraInicio);
        $stmt->bindValue(":fim", $dataHoraFim);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createDadoSensor($dado, $fk) {
        $stmt = $this->db->prepare("
            INSERT INTO DADO_SENSOR (DADO, DATA_HORA, FK_ID_SENSOR)
            VALUES (:dado, NOW(), :fk)
        ");
        $stmt->bindValue(':dado', $dado);
        $stmt->bindValue(':fk', $fk);
        return $stmt->execute();
    }
}
?>
