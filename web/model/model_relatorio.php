<?php
include_once '../controller/conecta_banco.php';
class Empresa{

    public function getEmpresaCNPJ($CNPJ){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE CNPJ LIKE ?");
        $stmt->bind_param("s", $CNPJ);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getEmpresaNome($NOME_FANTASIA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE NOME_FANTASIA =?");
        $stmt->bind_param("s", $NOME_FANTASIA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getEmpresaRazao($RAZAO_SOCIAL){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE RAZAO_SOCIAL =?");
        $stmt->bind_param("s", $RAZAO_SOCIAL);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getEmpresaBairro($BAIRRO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE BAIRRO =?");
        $stmt->bind_param("s", $BAIRRO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getEmpresaCEP($CEP){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE CEP =?");
        $stmt->bind_param("s", $CEP);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getEmpresaNum($NUMERO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE NUMERO =?");
        $stmt->bind_param("s", $NUMERO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getEmpresaRua($RUA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE RUA =?");
        $stmt->bind_param("s", $RUA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getEmpresaCidade($CIDADE){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE CIDADE =?");
        $stmt->bind_param("s", $CIDADE);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getEmpresaEstado($ESTADO){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE ESTADO =?");
        $stmt->bind_param("s", $ESTADO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
     }
      public function getEmpresaDescricao($DESCRICAO_ATIVIDADE){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE DESCRICAO_ATIVIDADE =?");
        $stmt->bind_param("s", $DESCRICAO_ATIVIDADEO);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getEmpresaTelefone($TELEFONE_CELULAR){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM EMPRESA WHERE TELEFONE_CELULAR =?");
        $stmt->bind_param("s", $TELEFONE_CELULAR);
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

    public function editaPoluente_sensor($CNPJ, $NOME_FANTASIA, $RAZAO_SOCIAL, $BAIRRO, $CEP, $NUMERO, $RUA, $CIDADE, $ESTADO, $DESCRICAO_ATIVIDADE, $TELEFONE_CELULAR, $SENHA, $EMAIL){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE POLUENTE_SENSOR SET FK_SENSOR_ID = ? FK_POLUENTE_ID = ? WHERE ID = ?");
        $stmt->bind_param("sssssssssssss", $CNPJ, $NOME_FANTASIA, $RAZAO_SOCIAL, $BAIRRO, $CEP, $NUMERO, $RUA, $CIDADE, $ESTADO, $DESCRICAO_ATIVIDADE, $TELEFONE_CELULAR, $SENHA, $EMAIL);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>