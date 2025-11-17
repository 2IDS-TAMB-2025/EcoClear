<?php
include_once '../controller/conecta_banco.php';
class Notificacoes{
     public function getNotificacoesId($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTIFICACAO WHERE ID LIKE ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getNotificacoesConteudo($CONTEUDO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTIFICACAO WHERE CONTEUDO LIKE ?");
        $stmt->bind_param("i", $CONTEUDO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getNotificacoesDataHora($DATA_HORA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTIFICACAO WHERE DATA_HORA LIKE ?");
        $stmt->bind_param("i", $DATA_HORA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getNotificacoesTitulo($TITULO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTIFICACAO WHERE TITULO LIKE ?");
        $stmt->bind_param("i", $TITULO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getNotificacoesFkCnpjEmpresa($FK_CNPJ_EMPRESA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTIFICACAO WHERE FK_CNPJ_EMPRESA LIKE ?");
        $stmt->bind_param("i", $FK_CNPJ_EMPRESA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


}
?>