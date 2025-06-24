<?php
include_once '../controller/conecta_banco.php';

class Administrador {
    
    public function getAdministradorId($ID){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE ID = ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getAdministradorNome($NOME){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE NOME = ?");
        $stmt->bind_param("s", $NOME);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getAdministradorCpf($CPF){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE CPF = ?");
        $stmt->bind_param("s", $CPF);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getAdministradorDataNasc($DATA_NASC){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE DATA_NASC = ?");
        $stmt->bind_param("s", $DATA_NASC);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getAdministradorEmail($EMAIL){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE EMAIL = ?");
        $stmt->bind_param("s", $EMAIL);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getAdministradorEndereco($endereco){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE ENDERECO = ?");
        $stmt->bind_param("s", $endereco);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getAdministradorSenha($SENHA){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE SENHA = ?");
        $stmt->bind_param("s", $SENHA);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

  
    public function getAdministradorCelular($CELULAR){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM ADMINISTRADOR WHERE CELULAR = ?");
        $stmt->bind_param("s", $CELULAR);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function editaAdministrador($ID, $NOME, $CPF, $DATA_NASC, $EMAIL, $SENHA, $CELULAR){
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE ADMINISTRADOR SET NOME = ?, CPF = ?, DATA_NASC = ?, EMAIL = ?, SENHA = ?, CELULAR = ? WHERE ID = ?");
        $stmt->bind_param("ssssssi", $NOME, $CPF, $DATA_NASC, $EMAIL, $SENHA, $CELULAR, $ID);
        $stmt->execute();
        $result = $stmt->affected_rows;
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>