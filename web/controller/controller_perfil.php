<?php
require_once("./../model/model_perfil.php");

if(isset($_GET["tipo_acao"]) && $_GET["tipo_acao"] == "editar"){
    $empresa = new Empresa();
    $editar_empresa = $empresa->editaEmpresa($_POST["CNPJ"], $_POST["RAZAO_SOCIAL"], $_POST["DESCRICAO_ATIVIDADE"], $_POST["EMAIL"], $_POST["CONTATO"], $_POST["ENDERECO"] );
    header("Location: ../view/perfil.php?cnpj=".$_POST["CNPJ"]);
}
else{
    if (isset($_GET["cnpj"])) {
        $empresa = new Empresa();
        $dados_perfil = $empresa->getEmpresaCNPJ($_GET["cnpj"]);
    } else {
        echo "CNPJ não informado.";
    }
}
?>