<?php

class Relatorio{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }
      public function createRelatorio($titulo,$conteudo,$fk_cnpj_empresa){
        $stmt = $this->db->prepare("INSERT INTO relatorio (TITULO,DATA_HORA,CONTEUDO,FK_CNPJ_EMPRESA)
                                VALUES (:titulo,now(),:conteudo,:fk_cnpj_empresa)");
        $stmt->bindValue(':titulo',$titulo);
        $stmt->bindValue(':conteudo',$conteudo);
        $stmt->bindValue(':fk_cnpj_empresa',$fk_cnpj_empresa);
        return $stmt->execute();
    }

      public function getRelatorio(){
        $stmt = $this->db->query("SELECT * FROM relatorio ORDER BY TITULO");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRelatorioId($ID){
        $stmt = $this->db->prepare("SELECT * FROM RELATORIO WHERE ID = ?");
        $stmt->bindValue("ID",$ID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

     public function getRelatorioTituloData_Hora($TITULO, $DATA_HORA){
        $stmt = $this->db->prepare("SELECT * FROM RELATORIO WHERE TITULO = ? and DATA_HORA = ?");
        $stmt->bindValue("TITULO, DATA_HORA",$TITULO, $DATA_HORA);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

}

?>