<?php
    require_once '../app/model/perfil_model.php';
    require_once '../app/view/perfilView.php';

    class PerfilController{
        private $modelPerfil;
        private $view;

        public function __construct($db){
            $this->modelPerfil = new Perfil($db);
            $this->view = new PerfilView();
        }

        //Criar uma artista
        public function createPerfil(){
            $data = json_decode(file_get_contents("php://input"),true);
            if( isset($data['CNPJ']) &&
            isset($data['RAZAO_SOCIAL']) &&
            isset($data['DESCRICAO_ATIVIDADE']) &&
            isset($data['EMAIL']) &&
            isset($data['ENDERECO'])
            ){
                $this->modelNoticia->createNoticia( $data['CNPJ'],
                                                  $data['RAZAO_SOCIAL'],
                                                  $data['DESCRICAO_ATIVIDADE'],
                                                  $data['EMAIL'],
                                                  $data['ENDERECO'],);
                                                
                $this->view->sendResponse(['message' => 'Perfil Cadastrado!'],201);               
            }
            else{
                $this->view->sendResponse(['message' => 'Dados inválidos'],400);
            }
        }
        public function getEmpresa(){
            $empresa = $this->modelPerfil->getEmpresa();
            $this->view->sendResponse($empresa);
        }
    }
?>