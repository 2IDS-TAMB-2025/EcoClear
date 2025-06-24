<?php
require_once '../model/model_sensor.php';
  
$sensor = new Sensor();
$sensores = $sensor->getSensorFkCnpjEmpresa($_GET["cnpj"]);
?>