<?php
require_once '../model/model_sensor.php';
  
$sensor = new Sensor();
$sensores = $sensor->getSensorFkCnpjEmpresa($_GET["cnpj"]);
$dados_sensores = $sensor->getDadosMedidasSensores($_GET["cnpj"]);
$todos_dados_sensores = $sensor->getTodosOsDadosMedidasSensores($_GET["cnpj"]);
?>