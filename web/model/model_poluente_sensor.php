<?php
include_once '../controller/conecta_banco.php';
class Poluente_sensor{

    public function getPoluente_sensorId($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE_SENSOR WHERE ID = ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPoluente_sensorFkSensorId($FK_SENSOR_ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE_SENSOR WHERE FK_SENSOR_ID = ?");
        $stmt->bind_param("s", $FK_SENSOR_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPoluente_sensorFkPoluenteId($FK_POLUENTE_ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE_SENSOR WHERE FK_POLUENTE_ID = ?");
        $stmt->bind_param("s", $FK_POLUENTE_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
?>
