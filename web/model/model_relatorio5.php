<?php
include_once '../controller/conecta_banco.php';
class Noticias{

    public function getNoticias($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTICIAS WHERE ID LIKE ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getNoticias($TITULO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTICIAS WHERE TITULO =?");
        $stmt->bind_param("s", $TITULO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getNoticias($DATA_PUBLICACAO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTICIAS WHERE DATA_PUBLICACAO =?");
        $stmt->bind_param("s", $DATA_PUBLICACAO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getNoticias($IMAGEM){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTICIAS WHERE IMAGEM =?");
        $stmt->bind_param("s", $IMAGEM);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getNoticias($LINK){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTICIAS WHERE LINK =?");
        $stmt->bind_param("s", $LINK);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getNoticias($FK_ID_ADMINISTRADOR){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTICIAS WHERE FK_ID_ADMINISTRADOR =?");
        $stmt->bind_param("s", $FK_ID_ADMINISTRADOR);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function editaNoticias($ID,$TITULO,$DATA_PUBLICACAO,$IMAGEM,$LINK,$FK_ADMINISTRADOR_ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE NOTICIAS SET ID = ?, TITULO = ?, DATA_PUBLICACAO = ?, IMAGEM = ?, LINK = ?, FK_ADMINISTRADOR_ID = ? WHERE ID = ?");
        $stmt->bind_param("isssss",$ID,$TITULO, $DATA_PUBLICACAO,$IMAGEM,$LINK,$FK_ADMINISTRADOR_ID);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
        }
}
?>