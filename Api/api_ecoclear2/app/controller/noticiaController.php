<?php
    require_once '../app/model/noticia_model.php';
    require_once '../app/view/noticiaView.php';

    class NoticiaController{
        private $modelNoticia;
        private $view;

        public function __construct($db){
            $this->modelNoticia = new Noticia($db);
            $this->view = new NoticiaView();
        }

        //Criar uma artista
        public function createNoticia(){
            $data = json_decode(file_get_contents("php://input"),true);
            if( isset($data['titulo']) &&
            isset($data['data_publicacao']) &&
            isset($data['imagem']) &&
            isset($data['link'])
            ){
                $this->modelNoticia->createNoticia( $data['titulo'],
                                                  $data['data_publicacao'],
                                                  $data['imagem'],
                                                  $data['link'],);
                                                
                $this->view->sendResponse(['message' => 'Noticia Cadastrada!'],201);               
            }
            else{
                $this->view->sendResponse(['message' => 'Dados inválidos'],400);
            }
        }
        public function getNoticias(){
            $noticias = $this->modelNoticia->getNoticias();
            $this->view->sendResponse($noticias);
        }
    }
?>