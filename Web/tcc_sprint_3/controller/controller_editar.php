<?php
    require_once '../model/model_relatorio.php';
    if(isset($_POST["nome"]) && isset($_POST["tipo"]) && isset($_POST["localizacao"]) && isset($_POST["status_sensor"]) && isset($_POST["unidade"]) && isset($_POST["fk_cnpj_empresa"])){
        $sensor = new Sensor();
        $sensor->editaSensor($_POST["id"],$_POST["nome"],$_POST["tipo"],$_POST["localizacao"],$_POST["status_sensor"],$_POST["unidade"],$_POST["fk_cnpj_empresa"]);
        echo "Editado com sucesso";
        header("Location: ../view/view_relatorio_sensores.php?cpf=".$_GET['cpf']);
    }
?>