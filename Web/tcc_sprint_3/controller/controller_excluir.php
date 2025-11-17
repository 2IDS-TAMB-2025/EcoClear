<?php
require_once "../model/model_relatorio.php";
if(isset($_GET["id"])){
    $sensor_exclui = new Sensor();
    $sensor_exclui->excluirSensor($_GET["id"]);
    header('Location:../view/view_relatorio_sensores.php?cpf='.$_GET['cpf']);

}
else{
    echo "Erro!";
    die();
}
?>