<?php

require_once "../model/model_feedback.php";

   if($_SERVER['REQUEST_METHOD'] == "GET"){
      $feedback = new Feedback();
      $feedbacks = $feedback->pegarFeedbacks($_GET["cnpj"]);
   }
   else{
      if(isset($_POST["cnpj"]) && isset($_POST["mensagem"])){
         $cnpj = $_POST["cnpj"];
         $conteudo = $_POST["mensagem"];

         $feedback = new Feedback();
         $feedback->salvar($cnpj,$conteudo);
         header("Location: ../view/feedback_adm.php");
         exit;
      }
      else{
      echo("Dados inválidos!");
      }
   }
   
?>