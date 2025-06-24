<?php
include_once '../controller/conecta_banco.php';

class Noticias{
    public function getNoticias(){
        $conn = Database::getConnection();
        $result = $conn->query("SELECT * FROM noticias ORDER BY DATA_PUBLICACAO");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getNoticiasId($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTICIAS WHERE ID = ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNoticiasTitulo($TITULO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTICIAS WHERE TITULO = ?");
        $stmt->bind_param("s", $TITULO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNoticiasDataPublicacao($DATA_PUBLICACAO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTICIAS WHERE DATA_PUBLICACAO = ?");
        $stmt->bind_param("s", $DATA_PUBLICACAO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNoticiasImagem($IMAGEM){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTICIAS WHERE IMAGEM = ?");
        $stmt->bind_param("s", $IMAGEM);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNoticiasLink($LINK){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTICIAS WHERE LINK = ?");
        $stmt->bind_param("s", $LINK);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNoticiasFkIdAdministrador($FK_ID_ADMINISTRADOR){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM NOTICIAS WHERE FK_ID_ADMINISTRADOR = ?");
        $stmt->bind_param("s", $FK_ID_ADMINISTRADOR);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function excluirNoticias($id){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM noticias WHERE ID = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }
    public function editaNoticias($id,$titulo,$data_publicacao,$imagem,$link){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE noticias SET TITULO = ?, DATA_PUBLICACAO = ?, IMAGEM = ?, LINK = ? WHERE ID = ?");
        $stmt->bind_param("ssssi",$titulo,$data_publicacao,$imagem,$link,$id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
    public function inserirNoticias($id,$titulo,$data_publicacao,$imagem,$link){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO noticias (TITULO, DATA_PUBLICACAO,IMAGEM,LINK)
                                VALUES TITULO = ?, DATA_PUBLICACAO = ?, IMAGEM = ?, LINK = ?");
        $stmt->bind_param("ssssi",$titulo,$data_publicacao,$imagem,$link);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>