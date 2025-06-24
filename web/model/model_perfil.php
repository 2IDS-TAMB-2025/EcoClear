<?php
include_once '../controller/conecta_banco.php';

class Empresa {
    public function getEmpresa() {
        $conn = Database::getConnection();
        $result = $conn->query("SELECT * FROM empresa ORDER BY CNPJ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getEmpresaCNPJ($CNPJ) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM empresa WHERE CNPJ = ?");
        $stmt->bind_param("s", $CNPJ);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function excluirEmpresa($CNPJ) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM empresa WHERE CNPJ = ?");
        $stmt->bind_param("s", $CNPJ);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        $conn->close();
        return $success;
    }

    public function editaEmpresa($CNPJ, $RAZÃO_SOCIAL, $DESCRICAO_ATIVIDADE, $EMAIL, $ENDERECO) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE empresa SET RAZAO_SOCIAL = ?, DESCRICAO_ATIVIDADE = ?, EMAIL = ?, ENDERECO = ? WHERE CNPJ = ?");
        $stmt->bind_param("sssss", $RAZÃO_SOCIAL, $DESCRICAO_ATIVIDADE, $EMAIL, $ENDERECO, $CNPJ);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        $conn->close();
        return $success;
    }
}
?>
