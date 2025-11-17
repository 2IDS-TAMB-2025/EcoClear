<?php 
    if(isset($_GET["cnpj"])){
        $cnpj = "?cnpj=".$_GET["cnpj"];
    }else{
        $cnpj = "";
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

        <!-- Topbar Start -->
    
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="index2.php<?php echo $cnpj ?>" class="navbar-brand p-0">
                    <img src="img/logo3.png" alt="Logo" class="logo">
                    <h1 class="text-primary">Eco Clear</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index2.php<?php echo $cnpj ?>" class="nav-item nav-link">Início</a>
                        <a href="about2.php<?php echo $cnpj ?>" class="nav-item nav-link active">Sobre nós</a>
                        <a href="service2.php<?php echo $cnpj ?>" class="nav-item nav-link">Monitoramento em tempo real</a>
                        <a href="noticia_view2.php<?php echo $cnpj ?>" class="nav-item nav-link">Notícias</a>
                        <div class="nav-item dropdown"></div>
                        <a href="contact2.php<?php echo $cnpj ?>" class="nav-item nav-link">Contatos</a>
                        <a href="feedback.php<?php echo $cnpj ?>" class="nav-item nav-link">FeedBack</a>
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
                                <li><a href="perfil.php<?php echo $cnpj ?>" style="color: #fff"><i class="fa-solid fa-user" style="color: #fff"></i> Meu perfil</a></li>
                                <li><a href="service2.php<?php echo $cnpj ?>" style="color: #fff"><i class="fa-solid fa-desktop" style="color: #fff"></i> Monitoramento</a></li>
                                <li><a href="contact2.php<?php echo $cnpj ?>" style="color: #fff"><i class="fa-solid fa-question" style="color: #fff"></i> Ajuda</a></li>
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

            <!-- Header Start -->
            <div class="container-fluid bg-breadcrumb">
                <div class="container text-center py-5" style="max-width: 900px;">
                    <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Sobre nós</h4>
                    <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    </ol>    
                </div>
            </div>
            <!-- Header End -->
        </div>
        <!-- Navbar & Hero End -->


        <!-- Abvout Start -->
        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.2s">
                        <div>
                            <h4 class="text-primary">Nossos serviços</h4>
                            <h1 class="display-5 mb-4">Junte-se a nós nessa missão</h1>
                            <p class="mb-4">A poluição atmosférica gerada por indústrias é um dos principais desafios ambientais da atualidade, impactando diretamente a qualidade do ar, a saúde da população e o equilíbrio ecológico. A emissão descontrolada de poluentes, como dióxido de enxofre, óxidos de nitrogênio e material particulado, contribui para problemas respiratórios, mudanças climáticas e chuvas ácidas. Diante desse cenário, nosso projeto surge como uma solução inovadora, oferecendo um site que permite o monitoramento em tempo real da emissão de poluentes por empresas industriais. Com essa ferramenta, as indústrias poderão acompanhar seus índices de poluição, adotar medidas corretivas eficazes e garantir o cumprimento das regulamentações ambientais, promovendo um desenvolvimento mais sustentável e responsável.
                            </p>
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-6 col-xl-6">
                               
                                </div>
                               
                                <div class="col-sm-6">
                                    <div class="d-flex">
                                     
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 wow fadeInRight" data-wow-delay="0.2s">
                        <div class="bg-primary rounded position-relative overflow-hidden">
                            <img src="img/poluicao2.jpg" class="img-fluid rounded w-100" alt="">
                            
                            <div class="rounded-bottom">
                                <img src="img/ambiente2.png" class="img-fluid rounded-bottom w-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Team Start -->
<div class="container-fluid team pb-5">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Quem somos?</h4>
                    <h1 class="display-5 mb-4">Nossa equipe</h1>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/maria.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="team-title">
                                <h4 class="mb-0">Maria Fernanda</h4>
                                <p class="mb-0">Analista de Banco de Dados e Product Owner (PO)</p>
                            </div>
                            <div class="team-icon">
                                <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="https://www.instagram.com/mafe_kluiz/" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/analivia.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="team-title">
                                <h4 class="mb-0">Ana Lívia</h4>
                                <p class="mb-0">Analista de Banco de Dados <br/><br/><br/></p>
                            </div>
                            <div class="team-icon">
                                <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="https://www.instagram.com/anazsilvah/" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/eu.jpeg" class="img-fluid" alt="">
                            </div>
                            <div class="team-title">
                                <h4 class="mb-0">Fernanda</h4>
                                <p class="mb-0">Programadora Front-end<br/><br/><br/></p>
                            </div>
                            <div class="team-icon">
                                <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="https://www.instagram.com/ferstocco_/" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/leticia.jpeg" class="img-fluid" alt="">
                            </div>
                            <div class="team-title">
                                <h4 class="mb-0">Letícia</h4>
                                <p class="mb-0"> Programadora Front-End<br/><br/></p>
                            </div>
                            <div class="team-icon">
                                <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="https://www.instagram.com/leticia_voltarelli/" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="img/pedrootavio.png" class="img-fluid" alt="">
                                </div>
                                <div class="team-title">
                                    <h4 class="mb-0">Pedro Otávio</h4>
                                    <p class="mb-0">Programador Back-End<br/><br/><br/></p>
                                </div>
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="https://www.instagram.com/_pedrim07_/" target="_blank"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="img/murilo.jpeg" class="img-fluid" alt="">
                                </div>
                                <div class="team-title">
                                    <h4 class="mb-0">Murilo R.</h4>
                                    <p class="mb-0">Programador Back-End e Scrum Master (SM)<br/><br/></p>
                                </div>
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="https://www.instagram.com/eu_muril0_0/" target="_blank"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="img/sophia.jpeg" class="img-fluid" alt="">
                                </div>
                                <div class="team-title">
                                    <h4 class="mb-0">Sophia</h4>
                                    <p class="mb-0">Desenvolvedora Full Stack<br/><br/><br/></p>
                                </div>
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="https://www.instagram.com/sophiaocarneiro/" target="_blank"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="img/lorena.jpeg" class="img-fluid" alt="">
                                </div>
                                <div class="team-title">
                                    <h4 class="mb-0">Lorena</h4>
                                    <p class="mb-0">Desenvolvedora Full Stack<br/><br/><br/></p>
                                </div>
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="https://www.instagram.com/loregncalo/" target="_blank"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                        </div>
                </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Team End -->

       <!-- Footer Start -->
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
                        <a href="index2.php<?php echo $cnpj ?>" class="text-white mb-0"><i class="fas fa-angle-right me-2"></i> Início</a>
                            <a href="about2.php<?php echo $cnpj ?>" class="text-white mb-0"><i class="fas fa-angle-right me-2"></i> Sobre nós</a>
                            <a href="service2.php<?php echo $cnpj ?>" class="text-white mb-0"><i class="fas fa-angle-right me-2"></i> Monitoramento em tempo real</a>
                            <a href="noticia_view2.php<?php echo $cnpj ?>" class="text-white mb-0"><i class="fas fa-angle-right me-2"></i> Notícias</a>
                            <a href="perfil.php<?php echo $cnpj ?>" class="text-white mb-0"><i class="fas fa-angle-right me-2"></i> Meu perfil</a>
                            <a href="contact2.php<?php echo $cnpj ?>" class="text-white mb-0"><i class="fas fa-angle-right me-2"></i> Contatos</a>
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