<?php
require_once '../config/db.php';

class Administrador {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function createAdministrador($NOME, $CPF, $DATA_NASC, $EMAIL, $ENDERECO, $SENHA, $CELULAR) {
        $stmt = $this->db->prepare("
            INSERT INTO ADMINISTRADOR (NOME, CPF, DATA_NASC, EMAIL, ENDERECO, SENHA, CELULAR)
            VALUES (:nome, :cpf, :data_nasc, :email, :endereco, :senha, :celular)
        ");
        $stmt->bindValue(':nome', $NOME);
        $stmt->bindValue(':cpf', $CPF);
        $stmt->bindValue(':data_nasc', $DATA_NASC);
        $stmt->bindValue(':email', $EMAIL);
        $stmt->bindValue(':endereco', $ENDERECO);
        $stmt->bindValue(':senha', $SENHA);
        $stmt->bindValue(':celular', $CELULAR);
        return $stmt->execute();
    }

    // READ - TODOS
    public function getAdministrador() {
        $stmt = $this->db->query("SELECT * FROM ADMINISTRADOR ORDER BY NOME");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - POR ID
    public function getAdministradorId($ID) {
        $stmt = $this->db->prepare("SELECT * FROM ADMINISTRADOR WHERE ID = :id");
        $stmt->bindValue(':id', $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // READ - POR NOME
    public function getAdministradorNome($NOME) {
        $stmt = $this->db->prepare("SELECT * FROM ADMINISTRADOR WHERE NOME = :nome");
        $stmt->bindValue(':nome', $NOME);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - POR CPF
    public function getAdministradorCpf($CPF) {
        $stmt = $this->db->prepare("SELECT * FROM ADMINISTRADOR WHERE CPF = :cpf");
        $stmt->bindValue(':cpf', $CPF);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - POR DATA NASC
    public function getAdministradorDataNasc($DATA_NASC) {
        $stmt = $this->db->prepare("SELECT * FROM ADMINISTRADOR WHERE DATA_NASC = :data_nasc");
        $stmt->bindValue(':data_nasc', $DATA_NASC);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - POR EMAIL
    public function getAdministradorEmail($EMAIL) {
        $stmt = $this->db->prepare("SELECT * FROM ADMINISTRADOR WHERE EMAIL = :email");
        $stmt->bindValue(':email', $EMAIL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - POR ENDERECO
    public function getAdministradorEndereco($ENDERECO) {
        $stmt = $this->db->prepare("SELECT * FROM ADMINISTRADOR WHERE ENDERECO = :endereco");
        $stmt->bindValue(':endereco', $ENDERECO);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - POR SENHA
    public function getAdministradorSenha($SENHA) {
        $stmt = $this->db->prepare("SELECT * FROM ADMINISTRADOR WHERE SENHA = :senha");
        $stmt->bindValue(':senha', $SENHA);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - POR CELULAR
    public function getAdministradorCelular($CELULAR) {
        $stmt = $this->db->prepare("SELECT * FROM ADMINISTRADOR WHERE CELULAR = :celular");
        $stmt->bindValue(':celular', $CELULAR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function editaAdministrador($ID, $NOME, $CPF, $DATA_NASC, $EMAIL, $ENDERECO, $SENHA, $CELULAR) {
        $stmt = $this->db->prepare("
            UPDATE ADMINISTRADOR 
            SET NOME = :nome, CPF = :cpf, DATA_NASC = :data_nasc, EMAIL = :email, ENDERECO = :endereco, SENHA = :senha, CELULAR = :celular
            WHERE ID = :id
        ");
        $stmt->bindValue(':nome', $NOME);
        $stmt->bindValue(':cpf', $CPF);
        $stmt->bindValue(':data_nasc', $DATA_NASC);
        $stmt->bindValue(':email', $EMAIL);
        $stmt->bindValue(':endereco', $ENDERECO);
        $stmt->bindValue(':senha', $SENHA);
        $stmt->bindValue(':celular', $CELULAR);
        $stmt->bindValue(':id', $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    // DELETE
    public function deleteAdministrador($ID) {
        $stmt = $this->db->prepare("DELETE FROM ADMINISTRADOR WHERE ID = :id");
        $stmt->bindValue(':id', $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
?>
