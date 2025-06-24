<?php
include_once '../controller/conecta_banco.php';
class Poluente_sensor{

    public function getPoluente_sensor($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE_SENSOR WHERE ID LIKE ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getPoluente_sensor($FK_SENSOR_ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE_SENSOR WHERE FK_SENSOR_ID =?");
        $stmt->bind_param("s", $FK_SENSOR_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getPoluente_sensor($FK_POLUENTE_ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM POLUENTE_SENSOR WHERE  FK_POLUENTE_ID =?");
        $stmt->bind_param("s", $FK_POLUENTE_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
     public function editaPoluente_sensor($FK_SENSOR_ID, $FK_POLUENTE_ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE POLUENTE_SENSOR SET FK_SENSOR_ID = ?, FK_POLUENTE_ID = ? WHERE ID = ?");
        $stmt->bind_param("ss", $FK_SENSOR_ID, $FK_POLUENTE_ID);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>