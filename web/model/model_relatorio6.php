<?php
include_once '../controller/conecta_banco.php';
class Notificacoes{
     public function getNotificacoes($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTIFICACAO WHERE ID LIKE ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getNotificacoes($CONTEUDO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTIFICACAO WHERE CONTEUDO LIKE ?");
        $stmt->bind_param("i", $CONTEUDO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getNotificacoes($DATA_HORA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTIFICACAO WHERE DATA_HORA LIKE ?");
        $stmt->bind_param("i", $DATA_HORA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getNotificacoes($TITULO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTIFICACAO WHERE TITULO LIKE ?");
        $stmt->bind_param("i", $TITULO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getNotificacoes($FK_CNPJ_EMPRESA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTIFICACAO WHERE FK_CNPJ_EMPRESA LIKE ?");
        $stmt->bind_param("i", $FK_CNPJ_EMPRESA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function editaNotificacoes($ID,$CONTEUDO,$DATA_HORA,$TITULO,$FK_CNPJ_EMPRESA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE NOTIFICACOES SET ID = ?, CONTEUDO = ?, DATA_HORA = ?, TITULO = ?, FK_CNPJ_EMPRESA = ? WHERE ID = ?");
        $stmt->bind_param("issss",$ID,$CONTEUDO, $DATA_HORA,$TITULO,$FK_CNPJ_EMPRESA);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
        }

}
?>