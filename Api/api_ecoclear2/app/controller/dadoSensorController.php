<?php
require_once '../app/model/dado_sensor_model.php';
require_once '../app/view/dadoSensorView.php';

class DadoSensorController{
    private $modelDadoSensor;
    private $view;

    public function __construct($db){
        $this->modelDadoSensor = new DadoSensor($db);
        $this->view = new DadoSensorView();
    }

    public function createDadoSensor(){
        $data = json_decode(file_get_contents("php://input"),true);
        if( isset($data['dado']) &&
            isset($data['fk_id_sensor']) 
        ){
            $this->modelDadoSensor->createDadoSensor($data['dado'],$data['fk_id_sensor']);
            $this->view->sendResponse(['message' => 'Dado do sensor cadastrado! 💻'],201);
        }
        else{
            $this->view->sendResponse(['message' => 'Dados Inválidos! ☹️'],400);
        }
    }
        public function getDadoSensor($cnpj){
            $dadoSensor = $this->modelDadoSensor->getDadosMedidasSensores($cnpj);
            $this->view->sendResponse($dadoSensor);
        }

        public function getTodasMedidasSensores($cnpj){
            $dadoSensor = $this->modelDadoSensor->getTodasMedidasSensores($cnpj);
            $this->view->sendResponse($dadoSensor);
        }
}
?>