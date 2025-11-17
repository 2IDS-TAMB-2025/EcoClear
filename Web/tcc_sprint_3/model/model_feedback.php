<?php
include_once '../controller/conecta_banco.php';
    class Feedback{
        private $id;
        private $conteudo;
        private $fk_cnpj_empresa;

        public function salvar($cnpj,$mensagem){

            $conn = new mysqli("localhost","root","root","ecoclear_2");
            if($conn->connect_error){
                die("Falha na conexão!");
            }

            $stmt = $conn->prepare("INSERT INTO FEEDBACK (CONTEUDO, FK_CNPJ_EMPRESA) VALUES (?,?)");
            $stmt->bind_param("ss", $mensagem,$cnpj);
           
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }

        public function pegarFeedbacks($cnpj){
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT * FROM FEEDBACK WHERE FK_CNPJ_EMPRESA = ?");
            $stmt->bind_param("s", $cnpj);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

?>