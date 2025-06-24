<?php
include_once '../controller/conecta_banco.php';
class Administrador_empresa{
     public function getAdministrador_empresa($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM  ADMINISTRADOR_EMPRESA WHERE ID LIKE ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getAdministrador_empresa($FK_ADMINISTRADOR_ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR_EMPRESA WHERE  FK_ADMINISTRADOR_ID LIKE ?");
        $stmt->bind_param("i", $FK_ADMINISTRADOR_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getAdministrador_empresa($FK_EMPRESA_CNPJ){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM  ADMINISTRADOR_EMPRESA WHERE FK_EMPRESA_CNPJ LIKE ?");
        $stmt->bind_param("s", $FK_EMPRESA_CNPJ);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function editaPoluente_empresa($CNPJ, $NOME_FANTASMA,$RAZAO_SOCIAL,$BAIRRO,$CEP,$NUMERO,$RUA,$CIDADE,$ESTADO,$DESCRICAO_ATIVIDADE,$TELEFONE_CELULAR,$SENHA,$EMAIL){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE EMPRESA SET NOME = ?, NOME_FANTASMA = ?, RAZAO_SOCIAL = ?, BAIRRO = ?, CEP = ?, NUMERO = ?, RUA = ?, CIDADE = ?,ESTADO = ?, DESCRICAO_ATIVIDADE = ?, TELEFONE_CELULAR = ?, SENHA = ?, EMAIL = ? WHERE ID = ?");
        $stmt->bind_param("sssssssssssss", $CNPJ, $NOME_FANTASMA,$RAZAO_SOCIAL,$BAIRRO,$CEP,$NUMERO,$RUA,$CIDADE,$ESTADO,$DESCRICAO_ATIVIDADE,$TELEFONE_CELULAR,$SENHA,$EMAIL);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>