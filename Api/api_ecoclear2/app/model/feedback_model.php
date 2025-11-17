<?php
class Feedback {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function createFeedback($conteudo, $fk_cnpj_empresa) {
        $stmt = $this->db->prepare(
            "INSERT INTO feedback (CONTEUDO, FK_CNPJ_EMPRESA)
             VALUES (:conteudo, :fk_cnpj_empresa)"
        );
        $stmt->bindValue(':conteudo', $conteudo);
        $stmt->bindValue(':fk_cnpj_empresa', $fk_cnpj_empresa);
        return $stmt->execute();
    }

    public function getFeedback(){
        $stmt = $this->db->query("SELECT * FROM feedback ORDER BY CONTEUDO");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFeedbackId($ID){
        $stmt = $this->db->prepare("SELECT * FROM FEEDBACK WHERE ID = ?");
        $stmt->bindValue(1, $ID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
