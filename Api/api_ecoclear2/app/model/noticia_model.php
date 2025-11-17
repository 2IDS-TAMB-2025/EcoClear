<?php
require_once '../config/db.php';

class Noticia{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }
    public function createNoticias($titulo,$data_publicacao,$imagem,$link){
        $stmt = $this->db->prepare("INSERT INTO noticias (TITULO,DATA_PUBLICACAO,IMAGEM,LINK)
                                VALUES (:titulo, :data_publicacao,:imagem,:link)");
        $stmt->bindValue(':titulo',$titulo);
        $stmt->bindValue(':data_publicacao',$data_publicacao);
        $stmt->bindValue(':imagem',$imagem);
        $stmt->bindValue(':link',$link);
        return $stmt->execute();
    }

    public function getNoticias(){
        $stmt = $this->db->query("SELECT * FROM noticias ORDER BY DATA_PUBLICACAO");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNoticiasId($ID){
        $stmt = $this->db->prepare("SELECT * FROM NOTICIAS WHERE ID = ?");
        $stmt->bindValue("ID",$ID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

     public function getNoticiasTitulo($TITULO){
        $stmt = $this->db->prepare("SELECT * FROM NOTICIAS WHERE TITULO = ?");
        $stmt->bindValue("TITULO",$TITULO);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

      public function getNoticiasDataPublicacao($DATA_PUBLICACAO){
        $stmt = $this->db->prepare("SELECT * FROM NOTICIAS WHERE DATA_PUBLICACAO = ?");
        $stmt->bindValue("DATA_PUBLICACAO",$DATA_PUBLICACAO);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

       public function getNoticiasImagem($IMAGEM){
        $stmt = $this->db->prepare("SELECT * FROM NOTICIAS WHERE IMAGEM = ?");
        $stmt->bindValue("IMAGEM",$IMAGEM);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }
    
     public function getNoticiasLink($LINK){
        $stmt = $this->db->prepare("SELECT * FROM NOTICIAS WHERE LINK = ?");
        $stmt->bindValue("LINK",$LINK);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    
    }
}
?>