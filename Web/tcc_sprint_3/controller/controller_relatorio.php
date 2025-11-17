<?php
require_once "../model/model_relatorio.php";
if(isset($_POST["pesquisaNome"])){
    $sensor_relatorio = new Sensor();
    $sensores = $sensor_relatorio->getSensor($_POST["pesquisaNome"]);

}
else if(isset($_GET["id"])){
    $sensores = new Sensor();
    $sensor = $sensores->getSensorId($_GET["id"]);
}
else{
    $sensores_relatorio = new Sensor();
    $sensores = $sensores_relatorio->getSensores();
}
?>