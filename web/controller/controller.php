<?php
    require_once "../model/model.php";

    if(isset($_POST["razao_social"]) && isset($_POST["CNPJ"]) && isset($_POST["descricao"]) && isset($_POST["email"]) && 
    isset($_POST["telefone"]) && isset($_POST["endereco"]) && isset($_POST["senha"]) && isset($_POST["confirmar_senha"])){
        $razao_social = $_POST["razao_social"];
        $CNPJ = $_POST["CNPJ"];
        $descricao = $_POST["descricao"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $endereco = $_POST["endereco"];
        $senha = $_POST["senha"];
        $confirmar_senha = $_POST["confirmar_senha"];

        $usuario = new Usuario($razao_social, $CNPJ, $descricao, $email, $telefone, $endereco, $senha, $confirmar_senha);
        $usuario->salvar();
        header("Location:../index2.html");
        exit;
    }
    else{
        echo("Oh Denise sai da live filha!");
    }
?>