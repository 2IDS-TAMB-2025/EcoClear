<?php
include_once '../controller/conecta_banco.php';

class Adm {
    public function getAdm() {
        $conn = Database::getConnection();
        $result = $conn->query("SELECT * FROM administrador ORDER BY CPF");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAdmCPF($CPF) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM administrador WHERE CPF = ?");
        $stmt->bind_param("s", $CPF);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function excluirAdm($CPF) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM administrador WHERE CPF = ?");
        $stmt->bind_param("s", $CPF);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        $conn->close();
        return $success;
    }

    public function editaAdm($CPF, $NOME, $DATA_NASC, $EMAIL, $SENHA, $CELULAR) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE administrador SET NOME = ?, DATA_NASC = ?, EMAIL = ?, SENHA = ?, CELULAR = ? WHERE CPF = ?");
        $stmt->bind_param("ssssss", $NOME, $DATA_NASC, $EMAIL, $SENHA, $CELULAR, $CPF);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        $conn->close();
        return $success;
    }
}
?>
