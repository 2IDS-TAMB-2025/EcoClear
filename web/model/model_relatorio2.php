<?php
include_once '../controller/conecta_banco.php';
class Administrador{

    public function getAdministrador($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE ID LIKE ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getAdministrador($NOME){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE NOME =?");
        $stmt->bind_param("s", $NOME);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getAdministrador($CPF){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE CPF =?");
        $stmt->bind_param("s", $CPF);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getAdministrador($DATA_NASC){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE DATA_NASC =?");
        $stmt->bind_param("s", $DATA_NASC);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getAdministrador($EMAIL){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE EMAIL =?");
        $stmt->bind_param("s", $EMAIL);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getAdministrador($endereco){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE endereco =?");
        $stmt->bind_param("s", $endereco);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getAdministrador($SENHA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE SENHA =?");
        $stmt->bind_param("s", $SENHA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     public function getAdministrador($CELULAR){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE CELULAR =?");
        $stmt->bind_param("s", $CELULAR);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function editaAdministrador($NOME,$CPF,$DATA_NASC,$EMIL,$SENHA,$CELULAR){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE ADMINISTRADOR SET NOME = ?, CPF = ?, DATA_NASC = ?, EMAIL = ?, SENHA = ?, CELULAR = ? WHERE ID = ?");
        $stmt->bind_param("ssssss",$NOME,$CPF, $DATA_NASC,$EMAIL,$SENHA,$CELULAR);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
        }
    
   
}
?>