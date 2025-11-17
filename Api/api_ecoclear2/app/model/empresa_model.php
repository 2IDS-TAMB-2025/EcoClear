<?php
require_once '../config/db.php';

class Empresa {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function createEmpresa($CNPJ, $RAZAO_SOCIAL, $DESCRICAO_ATIVIDADE, $TELEFONE, $SENHA, $EMAIL, $ENDERECO){
        $stmt = $this->db->prepare(
            "INSERT INTO EMPRESA (CNPJ, RAZAO_SOCIAL, DESCRICAO_ATIVIDADE, TELEFONE, SENHA, EMAIL, ENDERECO)
             VALUES (:CNPJ, :RAZAO_SOCIAL, :DESCRICAO_ATIVIDADE, :TELEFONE, :SENHA, :EMAIL, :ENDERECO)"
        );

        $stmt->bindValue(':CNPJ', $CNPJ);
        $stmt->bindValue(':RAZAO_SOCIAL', $RAZAO_SOCIAL);
        $stmt->bindValue(':DESCRICAO_ATIVIDADE', $DESCRICAO_ATIVIDADE);
        $stmt->bindValue(':TELEFONE', $TELEFONE);
        $stmt->bindValue(':SENHA', $SENHA);
        $stmt->bindValue(':EMAIL', $EMAIL);
        $stmt->bindValue(':ENDERECO', $ENDERECO);

        return $stmt->execute();
    }

    public function getEmpresa(){
        $stmt = $this->db->query("SELECT * FROM EMPRESA ORDER BY CNPJ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmpresaByCNPJ($CNPJ){
        $stmt = $this->db->prepare("SELECT CNPJ, RAZAO_SOCIAL, DESCRICAO_ATIVIDADE, TELEFONE, ENDERECO, SENHA, EMAIL FROM EMPRESA WHERE CNPJ = ?");
        $stmt->bindValue(1, $CNPJ);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     public function getEmpresaRazaoSocial($RAZAO_SOCIAL){
        $stmt = $this->db->prepare("SELECT * FROM EMPRESA WHERE RAZAO_SOCIAL =?");
        $stmt->bindValue("RAZAO_SOCIAL",$RAZAO_SOCIAL);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

      public function getEmpresaDescricaoAtividade($DESCRICAO_ATIVIDADE){
        $stmt = $this->db->prepare("SELECT * FROM EMPRESA WHERE DESCRICAO_ATIVIDADE =?");
        $stmt->bindValue("DESCRICAO_ATIVIDADE",$DESCRICAO_ATIVIDADE);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

       public function getEmpresaTelefone($TELEFONE){
        $stmt = $this->db->prepare("SELECT * FROM EMPRESA WHERE TELEFONE =?");
        $stmt->bindValue("TELEFONE",$TELEFONE);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }
    
     public function getEmpresaSenha($SENHA){
        $stmt = $this->db->prepare("SELECT * FROM EMPRESA WHERE SENHA =?");
        $stmt->bindValue("SENHA",$SENHA);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    
    }
    public function getEmpresaEmail($EMAIL){
        $stmt = $this->db->prepare("SELECT * FROM EMPRESA WHERE EMAIL =?");
        $stmt->bindValue("EMAIL",$EMAIL);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    
    }
    public function getEmpresaEndereco($ENDERECO){
        $stmt = $this->db->prepare("SELECT * FROM EMPRESA WHERE ENDERECO =?");
        $stmt->bindValue("ENDERECO",$ENDERECO);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    
    }
    public function getEmpresaLogin($cnpj, $senha) {
        $stmt = $this->db->prepare("SELECT * FROM EMPRESA WHERE CNPJ = :cnpj AND SENHA = :senha");
        $stmt->bindValue(':cnpj', $cnpj);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEmpresa($CNPJ, $RAZAO_SOCIAL, $TELEFONE, $EMAIL) {
        $stmt = $this->db->prepare(
            "UPDATE EMPRESA
            SET RAZAO_SOCIAL = :RAZAO_SOCIAL,
                TELEFONE = :TELEFONE,
                EMAIL = :EMAIL
            WHERE CNPJ = :CNPJ"
        );

        $stmt->bindValue(':CNPJ', $CNPJ);
        $stmt->bindValue(':RAZAO_SOCIAL', $RAZAO_SOCIAL);
        $stmt->bindValue(':TELEFONE', $TELEFONE);
        $stmt->bindValue(':EMAIL', $EMAIL);

        return $stmt->execute();
    }

}
?>