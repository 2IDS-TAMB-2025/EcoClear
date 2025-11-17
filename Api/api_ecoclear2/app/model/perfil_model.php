<?php
require_once '../config/db.php';

class Perfil{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getEmpresa(){
        $stmt = $this->db->query("SELECT CNPJ FROM empresa");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmpresaCNPJ($CNPJ){
        $stmt = $this->db->prepare("SELECT * FROM empresa WHERE CNPJ = ?");
        $stmt->bindValue("CNPJ",$CNPJ);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

    public function excluirEmpresa($CNPJ){
        $stmt = $this->db->prepare("DELETE FROM empresa WHERE CNPJ = ?");
        $stmt->bindValue("CNPJ",$CNPJ);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

     public function editaEmpresa($CNPJ, $RAZAO_SOCIAL, $DESCRICAO_ATIVIDADE, $EMAIL, $ENDERECO ){
        $stmt = $this->db->prepare("UPDATE empresa SET RAZAO_SOCIAL = ?, DESCRICAO_ATIVIDADE = ?, EMAIL = ?, ENDERECO = ? WHERE CNPJ = ?");
        $stmt->bindValue("CNPJ, RAZAO_SOCIAL, DESCRICAO_ATIVIDADE, EMAIL, ENDERECO", $CNPJ, $RAZÃO_SOCIAL, $DESCRICAO_ATIVIDADE, $EMAIL, $ENDERECO);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }
}
?>