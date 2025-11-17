<?php
require_once "../controller/controller_relatorio.php";

 if(isset($_GET["cpf"])){
        $cpf = "?cpf=".$_GET["cpf"];
    }else{
        $cpf = "";
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Eco Clear</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/logo3 (1).png" type="image/x-icon">    

        <style>
            html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      background-color: #;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .content-box {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 60px;
    max-width: 1000px;
    width: 100%;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.15);
    margin-top: 80px;
    height: 600px;
    }

    .content-box-1 {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 60px;
    max-width: 1000px;
    width: 100%;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.15);
    margin-top: 30px;
    height: 600px;
    margin-bottom: 30px;
    }

    .eco-profile-container {
            position: relative;
            display: inline-block;
            z-index: 100;
            }

            .eco-profile-icon img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.3s ease;
            margin-top: 65%;
            }

            .eco-profile-icon img:hover {
            transform: scale(1.05);
            }

            .eco-dropdown-menu {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            width: 220px;
            background-color: #0e0e0e;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.6);
            font-family: 'Segoe UI', sans-serif;
            animation: fadeIn 0.3s ease forwards;
            }

            @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
            }

            .eco-profile-info {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #333;
            }

            .eco-profile-info img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            }

            .eco-profile-info span {
            display: block;
            margin-top: 8px;
            color: #ccc;
            font-size: 14px;
            }

            .eco-dropdown-menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
            }

            .eco-dropdown-menu li {
            padding: 12px 18px;
            color: #eee;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: background 0.2s ease;
            }

            .eco-dropdown-menu li:hover {
            background-color: #1a1a1a;
            }

            h3 {
            text-align: center;
            margin: 20px;
            }

            .card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            border-radius: 12px;
            padding: 16px;
            transition: background-color 0.5s;
            margin: 1%;
            margin-left: 10%;
            margin-right: 10%;
            }

            .left-section {
            display: flex;
            align-items: center;
            gap: 16px;
            }

            .icon {
            font-size: 32px;
            margin-right: 16px;
            color: #4f4e4e;
            padding-left: 0px;
            }

            .label {
            font-weight: bold;
            font-size: 16px;
            padding-left: 90px;
            }

            .value {
            font-size: 16px;
            color: #333;
            padding-left: 90px;
            }

            .info {
            flex: 1;
            }

            .info h2 {
            margin: 0;
            font-size: 18px;
            }

            .info p {
            margin: 4px 0;
            color: #333;
            }

            .updated {
            font-size: 14px;
            color: #666;
            white-space: nowrap;
            padding-left: 100px;
            }

            .green {
            background-color: #d0f0c0;
            }

            .red {
            background-color: #f8d7da;
            }
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
            }
            h1 {
                text-align: center;
                margin-bottom: 30px;
            }
            form {
                margin-bottom: 20px;
                text-align: center;
            }
            form input[type="text"] {
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
                margin-right: 10px;
            }
            form input[type="submit"] {
                padding: 8px 15px;
                background-color: #76a547;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            form input[type="submit"]:hover {
                background-color: #5b8a3a;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                background-color: #fff;
            }

            table th, table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            table th {
                background-color: #76a547;
                color: white;
            }

            table input {
                max-width: 100%;
                box-sizing: border-box;
            }

            @media screen and (max-width: 768px) {
                table, thead, tbody, th, td, tr {
                    display: block;
                }
                thead tr {
                    display: none;
                }
                td {
                    position: relative;
                    padding-left: 50%;
                    margin-bottom: 10px;
                }
                td:before {
                    position: absolute;
                    top: 0;
                    left: 10px;
                    width: 45%;
                    white-space: nowrap;
                    font-weight: bold;
                    content: attr(data-label);
                }
            }
            .tabela {
                width: 100%;              /* sempre menor que a tela */
                max-width: 90%;       /* limite máximo */
                margin: auto;          /* centraliza */
                border-collapse: collapse;
                background-color: #fff;
                table-layout: fixed;     /* força largura fixa */
            }

            .tabela th, .tabela td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
                word-wrap: break-word;   /* quebra palavras grandes */
            }

            .tabela th {
                background-color: #76a547;
                color: white;
            }

            .tabela input {
                width: 100%;             /* ocupa só a célula */
                max-width: 300px;        /* não deixa crescer demais */
                box-sizing: border-box;
            }


        </style>
    </head>
    <body>
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Carregando...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <img src="img/logo3.png" alt="Logo" class="logo">
                    <h1 class="text-primary">Eco Clear</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="view_relatorio_sensores.php<?php echo $cpf ?>" class="nav-item nav-link active">Administrador</a>
                        <div class="nav-item dropdown"></div>
                        <div class="eco-profile-container">
                            <div class="eco-profile-icon" onclick="toggleProfileMenu()">
                              <img src="img/istockphoto-1495088043-612x612.jpg" alt="Perfil">
                            </div>
                          
                            <div class="eco-dropdown-menu" id="ecoDropdownMenu">
                              <div class="eco-profile-info">
                                <img src="img/istockphoto-1495088043-612x612.jpg" alt="Letícia">
                                <span></span>
                              </div>
                              <ul>
                                <li><a href="index.html" style="color: #fff"><i class="fa-solid fa-right-to-bracket" style="color: #fff"></i> Sair</a></li>
                              </ul>
                            </div>
                          </div>
                          <script>
                            function toggleProfileMenu() {
                                const menu = document.getElementById("ecoDropdownMenu");
                                const isOpen = menu.style.display === "block";

                                // Fecha todos os outros menus, se houver
                                document.querySelectorAll('.eco-dropdown-menu').forEach(el => {
                                    el.style.display = "none";
                                });

                                menu.style.display = isOpen ? "none" : "block";
                            }

                            // Fecha o menu se clicar fora
                            window.addEventListener("click", function (e) {
                                const menu = document.getElementById("ecoDropdownMenu");
                                const icon = document.querySelector(".eco-profile-icon");
                                if (!icon.contains(e.target)) {
                                    menu.style.display = "none";
                                }
                            });

                          </script>
                    </div>
                </div>
            </nav>
  <!-- Navbar End -->

  <div class="container-fluid bg-breadcrumb">
                <div class="container text-center py-5" style="max-width: 900px;">
                    <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Administrador</h4>
                    <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    </ol>    
                </div>
            </div>
            <!-- Header End -->
        </div>
        <!-- Navbar & Hero End -->
        <br><br>
        <h1>Edição de Sensores</h1>
        <form action="../controller/controller_editar.php?cpf=<?= $_GET['cpf']?>" method="POST">
            <table class="tabela">
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>TIPO</th>
                    <th>LOCALIZAÇÃO</th>
                    <th>STATUS DO SENSOR</th>
                    <th>UNIDADE</th>
                    <th>CNPJ</th>
                    <th>Editar</th>
                </tr>
                <?php
                    if(isset($sensor) && count($sensor)){
                        foreach($sensor as $sen){
                            ?>
                            <tr>
                                <td><input type="text" name="id" id="id" readonly value="<?php echo $sen['ID'];?>"></td>
                                <td><input type="text" name="nome" id="nome" value="<?php echo $sen['NOME'];?>"></td>
                                <td><input type="text" name="tipo" id="tipo" value="<?php echo $sen['TIPO'];?>"></td>
                                <td><input type="text" name="localizacao" id="localizacao" value="<?php echo $sen['LOCALIZACAO'];?>"></td>
                                <td><input type="text" name="status_sensor" id="status_sensor" value="<?php echo $sen['STATUS_SENSOR'];?>"></td>
                                <td><input type="text" name="unidade" id="unidade" value="<?php echo $sen['UNIDADE'];?>"></td>
                                <td><input type="text" name="fk_cnpj_empresa" id="fk_cnpj_empresa" value="<?php echo $sen['FK_CNPJ_EMPRESA'];?>"></td>
                                <td><input type="submit" value="Editar"></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
            </table>
        </form>
        <br><br><br>

        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
            <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="footer-item">
                            <a href="index.html" class="p-0">
                                <img src="img/logo3.png" alt="Logo" class="logo1">
                                <h1 class="text-primary">Eco Clear</h1>
                            </a>
                            <p class="text-white mb-0">O projeto Eco Clear tem como objetivo monitorar a poluição industrial através de uma plataforma online, medindo a emissão de poluentes e seus impactos no meio ambiente e na saúde pública.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-2">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">Links rápidos</h4>
                            <a href="view_relatorio_sensores.php<?php echo $cpf ?>" class="text-white mb-0"><i class="fas fa-angle-right me-2"></i> Administrador</a>
                            <a href="feedback_adm.php<?php echo $cpf ?>" class="text-white mb-0"><i class="fas fa-angle-right me-2"></i> Feedback</a>
                            <a href="perfil_adm.php<?php echo $cpf ?>" class="text-white mb-0"><i class="fas fa-angle-right me-2"></i> Meu perfil</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">Suporte</h4>
                            <a href="Documento 4.pdf" class="text-white mb-0"><i class="fas fa-angle-right me-2"></i> Privacidade & Política</a>
                            <a href="Documento 5 1.pdf" class="text-white mb-0"><i class="fas fa-angle-right me-2"></i> Termos & Condições</a>
                            <a href="contact.html" class="text-white mb-0"><i class="fas fa-angle-right me-2"></i> Suporte</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">Entre em contato conosco</h4>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                <p class="text-white mb-0">Tambaú SP/13710-000</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-envelope text-primary me-3"></i>
                                <p class="text-white mb-0">suporteecoclear@gmail.com</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa fa-phone-alt text-primary me-3"></i>
                                <p class="text-white mb-0">(19) 991099306</p>
                            </div>
                            <br>
                            <div class="d-flex">
                                <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="https://www.instagram.com/ecoclear_2025/" target="_blank"><i class="fab fa-instagram text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
       
        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-md-0">
                        <span class="text-body"><a href="index.html" class="border-bottom text-white">Eco Clear</a>,Todos os direitos reservados.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end text-body">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>  

       
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
       

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>