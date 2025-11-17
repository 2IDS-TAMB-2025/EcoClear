<?php
require_once '../app/model/administrador_model.php';
require_once '../app/view/administradorView.php';

class AdministradorController{
    private $modelAdministrador;
    private $view;

    public function __construct($db){
        $this->modelAdministrador = new Administrador($db);
        $this->view = new AdministradorView();
    }

    public function createAdministrador(){
        $data = json_decode(file_get_contents("php://input"),true);
        if( isset($data['cnpj']) &&
            isset($data['razao_social']) &&
            isset($data['descricao_atividade']) &&
            isset($data['telefone']) &&
            isset($data['endereco']) &&
            isset($data['senha']) &&
            isset($data['email'])
        ){
            $this->modelAdministrador->createAdministrador($data['cnpj'],$data['razao_social'],$data['descricao_atividade'],$data['telefone'],$data['endereco'],$data['senha'],$data['email']);
            $this->view->sendResponse(['message' => 'Administrador cadastrado! 💻'],201);
        }
        else{
            $this->view->sendResponse(['message' => 'Dados Inválidos! ☹️'],400);
        }
    }
        public function getAdministrador(){
            $administrador = $this->modelAdministrador->getAdministrador();
            $this->view->sendResponse($administrador);
        }
}
?>