<?php
    class Usuario{
        private $razao_social;
        private $CNPJ;
        private $descricao;
        private $email;
        private $telefone;
        private $endereco;
        private $senha;
        private $confirmar_senha;

        public function __construct($razao_social,$CNPJ,$descricao,$email,$telefone,$endereco,$senha,$confirmar_senha){
            $this->razao_social = $razao_social;
            $this->CNPJ = $CNPJ;
            $this->descricao = $descricao;
            $this->email = $email;
            $this->telefone = $telefone;
            $this->endereco = $endereco;
            $this->senha = password_hash($senha,PASSWORD_DEFAULT);
            $this->confirmar_senha = password_hash($confirmar_senha,PASSWORD_DEFAULT);
        }

        public function salvar(){
            $conn = new mysqli("localhost","root","root","ecoclear_2");
            if($conn->connect_error){
                die("Falha na conexão!");
            }
            $insert = $conn->prepare("INSERT INTO usuario razao_social,CNPJ,descricao,email,telefone,endereco,senha,confirmar_senha) values(?,?)");
            $insert->bind_param("ssssssss",$this->razao_social,$this->CNPJ,$this->descricao,$this->email,$this->telefone,$this->endereco,$this->senha,$this->confirtmar_senha);
            $insert->execute();
            $insert->close();
            $conn->close();
        }
    }

    class Sensor{
        private $nome;
        private $tipo;
        private $localizacao;
        private $status_sensor;
        private $unidade;
        private $fk_cnpj_empresa;

        public function __construct($nome,$tipo,$localizacao,$status_sensor,$unidade,$fk_cnpj_empresa){
            $this->nome = $nome;
            $this->tipo = $tipo;
            $this->localizacao = $localizacao;
            $this->status_sensor = $status_sensor;
            $this->unidade = $unidade;
            $this->fk_cnpj_empresa = $fk_cnpj_empresa;
        }

        public function salvar(){
            $conn = new mysqli("localhost","root","root","ecoclear_2");
            if($conn->connect_error){
                die("Falha na conexão!");
            }

            $stmt = $conn->prepare("INSERT INTO sensor (nome, tipo, localizacao, status_sensor, unidade, fk_cnpj_empresa) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $this->nome,$this->tipo,$this->localizacao,$this->status_sensor,$this->unidade,$this->fk_cnpj_empresa);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
    }
?>