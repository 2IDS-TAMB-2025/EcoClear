<?php
include_once '../config/db.php';

class Poluente {
    private $db;

    public function __construct($db) {
        $this->db = $db; // $db é um objeto PDO vindo da Database
    }

    public function getPoluente() {
        $stmt = $this->db->query("SELECT * FROM POLUENTE ORDER BY DATA_HORA DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPoluenteId($ID) {
        $stmt = $this->db->prepare("SELECT * FROM POLUENTE WHERE ID = ?");
        $stmt->execute([$ID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPoluenteDados($DADOS) {
        $stmt = $this->db->prepare("SELECT * FROM POLUENTE WHERE DADOS LIKE ?");
        $stmt->execute(["%".$DADOS."%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPoluenteDataHora($DATA_HORA) {
        $stmt = $this->db->prepare("SELECT * FROM POLUENTE WHERE DATA_HORA LIKE ?");
        $stmt->execute(["%".$DATA_HORA."%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPoluenteTipo($TIPO_POLUENTE) {
        $stmt = $this->db->prepare("SELECT * FROM POLUENTE WHERE TIPO_POLUENTE LIKE ?");
        $stmt->execute(["%".$TIPO_POLUENTE."%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPoluente($dados, $data_hora, $tipo_poluente) {
        $stmt = $this->db->prepare("INSERT INTO POLUENTE (dados, data_hora, tipo_poluente) VALUES (?, ?, ?)");
        return $stmt->execute([$dados, $data_hora, $tipo_poluente]);
    }
}
