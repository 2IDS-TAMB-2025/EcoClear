<?php
    require_once '../app/model/feedback_model.php';
    require_once '../app/view/feedbackView.php';

    class FeedbackController {
        private $modelFeedback;
        private $view;

        public function __construct($db){
            $this->modelFeedback = new Feedback($db);
            $this->view = new FeedbackView();
        }

        public function createFeedback(){
            $data = json_decode(file_get_contents("php://input"), true);

            if (isset($data['titulo']) &&
                isset($data['data_hora']) &&
                isset($data['conteudo']) &&
                isset($data['fk_cnpj_empresa'])) 
            {
                $this->modelFeedback->createFeedback(
                    $data['titulo'],
                    $data['data_hora'],
                    $data['conteudo'],
                    $data['fk_cnpj_empresa']
                );

                $this->view->sendResponse(['message' => 'Feedback Cadastrado!'], 201);               
            } else {
                $this->view->sendResponse(['message' => 'Dados inválidos'], 400);
            }
        }

        public function getFeedback(){
            $feedback = $this->modelFeedback->getFeedback();
            $this->view->sendResponse($feedback);
        }
    }
?>
