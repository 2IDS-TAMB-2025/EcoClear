<?php
require_once '../model/model_empresa.php';
if($_GET["tipo_acao"] == "login"){
    if(isset($_POST["loginCnpj"]) && isset($_POST["loginSenha"])){
        $empresas = new Empresa();
        $empresa = $empresas->getEmpresaLogin($_POST["loginCnpj"],$_POST["loginSenha"]);
        if(count($empresa) > 0){
            header("Location: ../view/index2.php?cnpj=".$_POST["loginCnpj"]);
        }
        else{
            header("Location: ../view/cadastro_login.html");
        }
    }
    else{
        echo "Preencha os dados!";
        die();
    }
}
else if($_GET["tipo_acao"] == "cadastrar"){
    if( isset($_POST["razaoSocial"]) && 
        isset($_POST["cnpj"]) &&
        isset($_POST["descricaoAtividades"]) &&
        isset($_POST["email"]) &&
        isset($_POST["telefone"]) &&
        isset($_POST["endereco"]) &&
        isset($_POST["senha"])){
        $empresas = new Empresa();
        $empresa = $empresas->inserirEmpresa($_POST["razaoSocial"],$_POST["cnpj"],$_POST["descricaoAtividades"],$_POST["email"],$_POST["telefone"], $_POST["endereco"],$_POST["senha"]);
        
        if($empresa){
            header("Location: ../view/cadastro_login.html");
            echo "Cadastro realizado com sucesso! Faça o login.";
        }
        else{
            header("Location: ../view/cadastro_login.html");
        }
    }
    else{
        echo "Preencha os dados!";
        die();
    }
}

?>