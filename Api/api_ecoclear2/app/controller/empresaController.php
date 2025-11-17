<?php
require_once '../app/model/empresa_model.php';
require_once '../app/view/empresaView.php';

class EmpresaController {
    private $modelEmpresa;
    private $view;

    public function __construct($db){
        $this->modelEmpresa = new Empresa($db);
        $this->view = new EmpresaView();
    }

    public function createEmpresa(){ 
        $data = json_decode(file_get_contents("php://input"), true);

        if(isset($data['cnpj'], $data['razao_social'], $data['descricao_atividade'], $data['telefone'], $data['senha'], $data['email'], $data['endereco'])){
            
            $this->modelEmpresa->createEmpresa(
                $data['cnpj'],
                $data['razao_social'],
                $data['descricao_atividade'],
                $data['telefone'],
                $data['senha'],
                $data['email'],
                $data['endereco']
            );

            $this->view->sendResponse(['message' => 'Empresa cadastrada!'], 201);
        } else {
            $this->view->sendResponse(['message' => 'Dados inválidos'], 400);
        }
    }

    public function getEmpresa(){
        $empresa = $this->modelEmpresa->getEmpresa();
        $this->view->sendResponse($empresa);
    }

    public function getEmpresaPeloCNPJ($cnpj){
        $empresa = $this->modelEmpresa->getEmpresaByCNPJ($cnpj);
        $this->view->sendResponse($empresa);
    }

    public function getEmpresaLogin($cnpj, $senha){
        $empresa = $this->modelEmpresa->getEmpresaLogin($cnpj, $senha);
        $this->view->sendResponse($empresa);
    }


    public function updateEmpresa(){ 
        $data = json_decode(file_get_contents("php://input"), true);

        if(isset($data['cnpj'], $data['razao_social'], $data['telefone'], $data['email'])){
            
            $this->modelEmpresa->updateEmpresa(
                $data['cnpj'],
                $data['razao_social'],
                $data['telefone'],
                $data['email']
            );

            $this->view->sendResponse(['message' => 'Empresa Atualizada!'], 201);
        } else {
            $this->view->sendResponse(['message' => 'Dados inválidos'], 400);
        }
    }
}
?>
