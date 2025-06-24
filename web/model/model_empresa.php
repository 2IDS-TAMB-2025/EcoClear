<?php
include_once '../controller/conecta_banco.php';
class Empresa{

    public function getEmpresa($CNPJ){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE CNPJ LIKE ?");
        $stmt->bind_param("s", $CNPJ);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

     public function getEmpresaRazaoSocial($RAZAO_SOCIAL){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE RAZAO_SOCIAL =?");
        $stmt->bind_param("s", $RAZAO_SOCIAL);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
      public function getEmpresaDescricaoAtividade($DESCRICAO_ATIVIDADE){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE DESCRICAO_ATIVIDADE =?");
        $stmt->bind_param("s", $DESCRICAO_ATIVIDADE);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getEmpresaTelefone($TELEFONE){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE TELEFONE =?");
        $stmt->bind_param("s", $TELEFONE);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getEmpresaSenha($SENHA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE SENHA =?");
        $stmt->bind_param("s", $SENHA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getEmpresaEmail($EMAIL){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE EMAIL =?");
        $stmt->bind_param("s", $EMAIL);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getEmpresaLogin($cnpj,$senha){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE CNPJ = ? AND SENHA = ?");
        $stmt->bind_param("ss", $cnpj, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function inserirEmpresa($RAZAO_SOCIAL, $CNPJ,$DESCRICAO_ATIVIDADE,$EMAIL,$TELEFONE,$ENDERECO, $SENHA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO EMPRESA (RAZAO_SOCIAL, CNPJ, DESCRICAO_ATIVIDADE, TELEFONE, ENDERECO, SENHA, EMAIL)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $RAZAO_SOCIAL, $CNPJ, $DESCRICAO_ATIVIDADE, $TELEFONE, $ENDERECO, $SENHA, $EMAIL);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>