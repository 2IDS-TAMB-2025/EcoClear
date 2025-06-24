<?php
require_once "../model/model_relatorio.php";
if(isset($_POST ["pesquisaNome"])){
    $empresa_relatorio = new Empresa();
    $empresas = $empresas_relatorio->getEmpresa($_POST["pesquisaNome"]); 
}
else if(isset($_GET ["id"])){
        $empresas = new Empresa();
        $empresa = $empresas->getEmpresaCNPJ($_GET["razao_social"]);
}
else{
    $empresas_relatorio = new Empresa();
    $empresas = $empresas_relatorio->getEmpresas();
}

?>