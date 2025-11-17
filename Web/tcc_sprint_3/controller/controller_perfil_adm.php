<?php
require_once("./../model/model_perfil_adm.php");

if(isset($_GET["tipo_acao"]) && $_GET["tipo_acao"] == "editar"){
    $adm = new Adm();
    $editar_adm = $adm->editaAdm($_POST["CPF"], $_POST["NOME"], $_POST["DATA_NASC"], $_POST["EMAIL"], $_POST["SENHA"], $_POST["CELULAR"] );
    header("Location: ../view/perfil_adm.php?cpf=".$_POST["CPF"]);
}
else{
    if (isset($_GET["cpf"])) {
        $adm = new Adm();
        $dados_perfil_adm = $adm->getAdmCPF($_GET["cpf"]);
    } else {
        echo "CPF não informado.";
    }
}
?>