<?php
include_once '../controller/conecta_banco.php';
class Sensor{
    public function getSensores(){
        $conn = Database::getConnection();
        $result = $conn->query("SELECT * FROM SENSOR ORDER BY ID ASC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getSensor($nome){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE NOME LIKE ?");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSensorTipo($tipo){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE TIPO LIKE ?");
        $stmt->bind_param("s", $tipo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSensorLocalizacao($localizacao){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE LOCALIZACAO LIKE ?");
        $stmt->bind_param("s", $localizacao);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSensorStatusSensor($status_sensor){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE STATUS_SENSOR LIKE ?");
        $stmt->bind_param("s", $status_sensor);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSensorUnidade($unidade){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE UNIDADE LIKE ?");
        $stmt->bind_param("s", $unidade);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSensorId($id){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM SENSOR WHERE ID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function excluirSensor($id) {
        $conn = Database::getConnection();

        // Deletar da tabela poluente_sensor
        $stmt = $conn->prepare("DELETE FROM poluente_sensor WHERE FK_SENSOR_ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // Deletar da tabela dado_sensor
        $stmt = $conn->prepare("DELETE FROM dado_sensor WHERE FK_ID_SENSOR = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // Agora deletar da tabela sensor
        $stmt = $conn->prepare("DELETE FROM sensor WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();

        $conn->close();

        return $success;
    }

    public function editaSensor($id,$nome,$tipo,$localizacao,$status_sensor,$unidade){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE sensor SET NOME = ?, TIPO = ?, LOCALIZACAO = ?, STATUS_SENSOR = ?, UNIDADE = ? WHERE ID = ?");
        $stmt->bind_param("sssssi", $nome,$tipo,$localizacao,$status_sensor,$unidade,$id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>