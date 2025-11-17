<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT,OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    
    require_once '../app/controller/administradorController.php';
    require_once '../app/controller/dadoSensorController.php';
    require_once '../app/controller/poluenteController.php';
    require_once '../app/controller/noticiaController.php';
    require_once '../app/controller/perfilController.php';
    require_once '../app/controller/empresaController.php';
    require_once '../app/controller/relatorioController.php';
    require_once '../app/controller/sensorController.php';
    require_once '../app/controller/feedbackController.php';
    require_once '../config/db.php';

    $database = new DataBase();
    $db = $database->getConnection();

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/', $uri);

    $administradorController = new AdministradorController($db);
    $dadoSensorController = new DadoSensorController($db);
    $poluenteController = new PoluenteController($db);
    $sensorController = new SensorController($db);
    $noticiaController = new NoticiaController($db);
    $perfilController = new PerfilController($db);
    $relatorioController = new RelatorioController($db);
    $empresaController = new EmpresaController($db);
    $feedbackController = new FeedbackController($db);

    //ROTA: localhost/api_ecoclear2/administrador
    if ($uri[2] == "administrador") {
        if ($method == "POST") {
            $administradorController->createAdministrador();
        } else if ($method == "GET") {
            $administradorController->getAdministrador();
        }
    }

    //ROTA: localhost/api_ecoclear2/dadoSensor
    if ($uri[2] == "dadoSensor") {
        if ($method == "POST") {
            $dadoSensorController->createDadoSensor();
        } else if ($method == "GET") {
            $dadoSensorController->getDadoSensor($_GET["cnpj"]);
        }
    }

    if ($uri[2] == "todasMedidasSensores") {
        if ($method == "GET") {
            $dadoSensorController->getTodasMedidasSensores($_GET["cnpj"]);
        }
    }

    //ROTA: localhost/api_ecoclear2/poluente
    if ($uri[2] == "poluente") {
        if ($method == "POST") {
            $poluenteController->createPoluente();
        } else if ($method == "GET") {
            $poluenteController->getPoluente();
        }
    }

    //ROTA: localhost/api_ecoclear2/noticia
    if ($uri[2] == "noticia") {
        if ($method == "POST") {
            $noticiaController->createNoticia();
        } else if ($method == "GET") {
            $noticiaController->getNoticias();
        }
    }

    //ROTA: localhost/api_ecoclear2/relatorio
    if ($uri[2] == "relatorio") {
        if ($method == "POST") {
            $relatorioController->createRelatorio();
        } else if ($method == "GET") {
            $relatorioController->getRelatorio();
        }
    }

    //ROTA: localhost/api_ecoclear2/empresa
    if ($uri[2] == "empresa") {
        if ($method == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            if(isset($data['cnpj'], $data['senha'])){
                $empresaController->getEmpresaLogin($data['cnpj'], $data['senha']);
            }
            if(isset($data['cnpj'], $data['razao_social'], $data['descricao_atividade'], $data['telefone'], $data['senha'], $data['email'], $data['endereco'])){
                $empresaController->createEmpresa();
            }
        } else if ($method == "GET") {
            if(isset($_GET["cnpj"])){
                $empresaController->getEmpresaPeloCNPJ($_GET["cnpj"]);
            }
            else{
                $empresaController->getEmpresa();
            }
            
        }else if($method == "PUT"){
            $empresaController->updateEmpresa();
        }
    }

    //ROTA: localhost/api_ecoclear2/sensor
    if ($uri[2] == "sensor") {
        if ($method == "POST") {
            $sensorController->createSensor();
        } else if ($method == "GET") {
            $sensorController->getSensor();
        }
    }

    //ROTA: localhost/api_ecoclear2/feedback
    if ($uri[2] == "feedback") {
        if ($method == "POST") {
            $feedbackController->createFeedback();
        } else if ($method == "GET") {
            $feedbackController->getFeedback();
        }
    }
?>
