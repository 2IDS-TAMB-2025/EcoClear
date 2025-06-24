<?php
    require_once "../model/model_noticias.php";

    if(isset($_POST["titulo"]) && isset($_POST["data_publicacao"]) && isset($_POST["imagem"]) && isset($_POST["link"])){
        $titulo = $_POST["titulo"];
        $data_publicacao = $_POST["data_publicacao"];
        $imagem = $_POST["imagem"];
        $link = $_POST["link"];

        $noticias = new Noticia($titulo,$data_publicacao,$imagem,$link);
        $noticias->salvar();
        header("Location: ../view/view_relatorio_usuarios.php");
        exit;
    }
    else{
        echo("Denise sai da live!");
    }
?>