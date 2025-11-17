<?php
require_once '../app/model/poluente_model.php';
require_once '../app/view/poluenteView.php';

class PoluenteController {
    private $modelPoluente;
    private $view;

    public function __construct($db) {
        $this->modelPoluente = new Poluente($db); 
        $this->view = new PoluenteView();
    }

    public function createPoluente() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['dados'], $data['data_hora'], $data['tipo_poluente'])) {
            $success = $this->modelPoluente->createPoluente(
                $data['dados'],
                $data['data_hora'],
                $data['tipo_poluente']
            );

            if ($success) {
                $this->view->sendResponse(['message' => 'Poluente cadastrado! 💻'], 201);
            } else {
                $this->view->sendResponse(['message' => 'Erro ao cadastrar! ⚠️'], 500);
            }
        } else {
            $this->view->sendResponse(['message' => 'Dados Inválidos! ☹️'], 400);
        }
    }

    public function getPoluente() {
        $poluentes = $this->modelPoluente->getPoluente();
        $this->view->sendResponse($poluentes);
    }
}
