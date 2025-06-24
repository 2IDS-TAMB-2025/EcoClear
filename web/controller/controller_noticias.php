<?php
  require_once '../model/model_noticias.php';

  $noticias_relatorio = new Noticias();
  $noticias = $noticias_relatorio->getNoticias();
?> 