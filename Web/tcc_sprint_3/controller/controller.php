<?php

require_once "../model/model.php";

session_start();

// Verifique se o CPF está sendo passado via GET ou se já está na sessão
$cpf = isset($_GET["cpf"]) ? "?cpf=" . $_GET["cpf"] : (isset($_SESSION['cpf']) ? "?cpf=" . $_SESSION['cpf'] : "");

   if(isset($_POST["nome"]) && isset($_POST["tipo"]) && isset($_POST["localizacao"]) && isset($_POST["status_sensor"]) && isset($_POST["unidade"]) && isset($_POST["fk_cnpj_empresa"])){
    $nome = $_POST["nome"];
    $tipo = $_POST["tipo"];
    $localizacao = $_POST["localizacao"];
    $status_sensor = $_POST["status_sensor"];
    $unidade = $_POST["unidade"];
    $fk_cnpj_empresa = $_POST["fk_cnpj_empresa"];

    $sensor = new Sensor($nome,$tipo,$localizacao,$status_sensor,$unidade,$fk_cnpj_empresa);
    $sensor->salvar();
    header("Location: ../view/view_relatorio_sensores.php" . $cpf);
   exit;
   }
   else{
    echo("Denise sai da live!");
   }
?>