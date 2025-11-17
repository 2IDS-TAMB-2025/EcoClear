<?php
    class Usuario{
        private $razao_social;
        private $CNPJ;
        private $descricao_atividade;
        private $email;
        private $telefone;
        private $endereco;
        private $senha;

        public function __construct($razao_social,$CNPJ,$descricao,$email,$telefone,$endereco,$senha,$confirmar_senha){
            $this->razao_social = $razao_social;
            $this->CNPJ = $CNPJ;
            $this->descricao = $descricao;
            $this->email = $email;
            $this->telefone = $telefone;
            $this->endereco = $endereco;
            $this->senha = password_hash($senha,PASSWORD_DEFAULT);
        }

        public function salvar(){
            $conn = new mysqli("localhost","root","root","CADASTRO_USUARIO");
            if($conn->connect_error){
                die("Falha na conexão!");
            }
            $insert = $conn->prepare("INSERT INTO usuario razao_social,CNPJ,descricao,email,telefone,endereco,senha) values(?,?)");
            $insert->bind_param("ssssssss",$this->razao_social,$this->CNPJ,$this->descricao,$this->email,$this->telefone,$this->endereco,$this->senha);
            $insert->execute();
            $insert->close();
            $conn->close();
        }
    }
?>