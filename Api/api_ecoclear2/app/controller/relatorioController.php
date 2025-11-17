<?php
    require_once '../app/model/relatorio_model.php';
    require_once '../app/view/relatorioView.php';

    class RelatorioController{
        private $modelRelatorio;
        private $view;

        public function __construct($db){
            $this->modelRelatorio = new Relatorio($db);
            $this->view = new RelatorioView();
        }

        //Criar uma artista
        public function createRelatorio(){
            $data = json_decode(file_get_contents("php://input"),true);
            if( isset($data['titulo']) &&
            isset($data['conteudo']) &&
            isset($data['fk_cnpj_empresa'])
            ){
                $this->modelRelatorio->createRelatorio( $data['titulo'],
                                                        $data['conteudo'], 
                                                        $data['fk_cnpj_empresa']);
                                                
                $this->view->sendResponse(['message' => 'Relatório Cadastrado!'],201);               
            }
            else{
                $this->view->sendResponse(['message' => 'Dados inválidos'],400);
            }
        }
        public function getRelatorio(){
            $relatorio = $this->modelRelatorio->getRelatorio();
            $this->view->sendResponse($relatorio);
        }
    }
?>