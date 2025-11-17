<?php
require_once '../app/model/sensor_model.php';
require_once '../app/view/sensorView.php';

class SensorController{
    private $modelSensor;
    private $view;

    public function __construct($db){
        $this->modelSensor = new Sensor($db);
        $this->view = new SensorView();
    }

    public function createSensor(){ 
        $data = json_decode(file_get_contents("php://input"),true);
        if( isset($data['nome']) &&
            isset($data['tipo']) &&
            isset($data['localizacao']) &&
            isset($data['status_sensor']) &&
            isset($data['unidade']) &&
            isset($data['fk_cnpj_empresa'])
        ){
            $this->modelSensor->createSensor($data['nome'],$data['tipo'],$data['localizacao'],$data['status_sensor'],$data['unidade'],$data['fk_cnpj_empresa']);
            $this->view->sendResponse(['message' => 'Sensor cadastrado! 💻'],201);
        }
        else{
            $this->view->sendResponse(['message' => 'Dados Inválidos! ☹️'],400);
        }
    }
        public function getSensor(){
            $sensor = $this->modelSensor->getSensor();
            $this->view->sendResponse($sensor);
        }
}
?>