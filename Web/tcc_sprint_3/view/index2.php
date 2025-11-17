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
        <link rel="stylesheet" href="lib/animate/animate.min.css"/>
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
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Topbar Start -->
       
        <!-- Topbar End -->

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
                        <a href="index2.php" class="nav-item nav-link active">Início</a>
                        <a href="about2.php<?php echo $cnpj ?>" class="nav-item nav-link">Sobre nós</a>
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

            <!-- Carousel Start -->
            <div class="header-carousel owl-carousel">
                <div class="header-carousel-item">
                    <img src="img/imagem2.jpg" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row gy-0 gx-5">
                                <div class="col-lg-0 col-xl-5"></div>
                                <div class="col-xl-7 animated fadeInLeft">
                                    <div class="text-sm-center text-md-end">
                                        <h4 class="text-primary text-uppercase fw-bold mb-4"> Eco Clear</h4>
                                        <h1 class="display-4 text-uppercase text-white mb-4">Transformando a Indústria para um Futuro Mais Limpo.</h1>
                                        <p class="mb-5 fs-5">O site Eco Clear é uma ferramenta essencial para auxiliar as empresas no desafio da poluição industrial.
                                        </p>
                                        <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2" href="blog.html">Saiba Mais</a>
                                        <div class="d-flex justify-content-center justify-content-md-end flex-shrink-0 mb-4">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                                            <h2 class="text-white me-2"></h2>
                                            <div class="d-flex justify-content-end ms-2">
                                                <a class="btn btn-md-square btn-light rounded-circle mx-2" href="https://www.instagram.com/ecoclear_2025/" target="_blank"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-carousel-item">
                    <img src="img/ind2.jpg" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row g-5">
                                <div class="col-12 animated fadeInUp">
                                    <div class="text-center">
                                        <h4 class="text-primary text-uppercase fw-bold mb-4">Eco Clear</h4>
                                        <h1 class="display-4 text-uppercase text-white mb-4">Uma empresa sustentável não apenas preserva o futuro, mas também transforma o presente, criando valor para todos de forma responsável e inovadora.</h1>
                                        <div class="d-flex justify-content-center flex-shrink-0 mb-4">
                                         
                                       
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h2 class="text-white me-2"> Nos siga:</h2>
                                            <div class="d-flex justify-content-end ms-2"></div>
                                                <a class="btn btn-md-square btn-light rounded-circle mx-2" href="https://www.instagram.com/ecoclear_2025/" target="_blank"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel End -->
        </div>
        <!-- Navbar & Hero End -->


        <!-- Abvout Start -->
        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.2s">
                        <div>
                            <h4 class="text-primary">Conheça um pouco</h4>
                            <h1 class="display-5 mb-4">Eco Clear</h1>
                            <p class="mb-4">O projeto Eco Clear tem como objetivo monitorar a poluição industrial através de uma plataforma online, medindo a emissão de poluentes e seus impactos no meio ambiente e na saúde pública. Ele inclui a instalação de sensores perto das indústrias para coletar dados sobre a qualidade do ar, análise de poluentes em chaminés, disponibilização de dados públicos, relatórios trimestrais e treinamento de profissionais. O projeto busca promover a conscientização ambiental e apoiar ações de sustentabilidade, contribuindo para o controle da poluição e práticas responsáveis.
                               
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-5 wow fadeInRight" data-wow-delay="0.2s">
                        <img id="thim" src="img/industrias.jpeg">
                    </div>
                </div>
               
            </div>
        </div>
        <!-- About End -->

        <!-- Services Start -->
        <div class="container-fluid service pb-5">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Nossa função</h4>
                    <h1 class="display-5 mb-4">O que buscamos?</h1>
                    <p class="mb-0" style="text-align: justify;">Um projeto voltado para o controle da poluição industrial tem impactos positivos no meio ambiente e na sociedade. Ele reduz a emissão de poluentes, o que melhora a qualidade do ar, da água e do solo, ajudando a preservar os ecossistemas e reduzir a degradação ambiental. Isso resulta em uma melhora da saúde pública, diminuindo doenças respiratórias e cardiovasculares causadas pela poluição.

                        Além disso, ao adotar práticas mais limpas, as empresas diminuem sua pegada ambiental e atendem a exigências regulatórias, evitando multas e melhorando sua imagem no mercado. Embora a implementação do projeto exija investimentos iniciais e possa enfrentar resistência das indústrias, os benefícios superam os desafios, promovendo um futuro mais sustentável e saudável.
                    </p>
                </div>
                <div class="container-fluid offer-section pb-5">
                    <div class="container pb-5">
                        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                            <h1 class="display-5 mb-4">Benefícios</h1>
                            <p class="mb-0">
                            </p>
                        </div>
                        <div class="row g-5 align-items-center">
                            <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.2s">
                                <div class="nav nav-pills bg-light rounded p-5">
                                    <a class="accordion-link p-4 active mb-4" data-bs-toggle="pill" href="#collapseOne">
                                        <h5 class="mb-0">Melhoria ambiental: Contribui para a qualidade do ar, água e solo, e preservação dos ecossistemas.</h5>
                                    </a>
                                    <a class="accordion-link p-4 mb-4" data-bs-toggle="pill" href="#collapseTwo">
                                        <h5 class="mb-0">Saúde pública: Reduz riscos de doenças respiratórias, cardiovasculares e outras associadas à poluição</h5>
                                    </a>
                                    <a class="accordion-link p-4 mb-4" data-bs-toggle="pill" href="#collapseThree">
                                        <h5 class="mb-0">Redução da pegada ambiental: Diminui a liberação de substâncias nocivas no meio ambiente.</h5>
                                    </a>
                                    <a class="accordion-link p-4 mb-0" data-bs-toggle="pill" href="#collapseFour">
                                        <h5 class="mb-0">Sustentabilidade empresarial: Promove práticas mais responsáveis e atende a exigências regulatórias.
                                        </h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.4s">
                                <div class="tab-content">
                                    <div id="collapseOne" class="tab-pane fade show p-0 active">
                                        <div class="row g-4">
                                            <div class="col-md-7">
                                                <img src="img/beneficio01.jpg" class="img-fluid w-100 rounded" alt="">
                                            </div>
                                            <div class="col-md-5">
                                                <h1 class="display-5 mb-4">Melhoria ambiental:</h1>
                                                <p class="mb-4">A melhoria ambiental promovida por projetos de controle da poluição industrial contribui diretamente para a qualidade do ar, da água e do solo, ao reduzir a emissão de poluentes e tratar resíduos de forma adequada. Isso ajuda a preservar os ecossistemas, evitando a contaminação de recursos naturais essenciais para a vida. A redução da poluição também favorece a biodiversidade, garantindo um ambiente mais saudável para plantas, animais e seres humanos.
                                                </p>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseTwo" class="tab-pane fade show p-0">
                                        <div class="row g-4">
                                            <div class="col-md-7">
                                                <img src="img/beneficio02.jpg" class="img-fluid w-100 rounded" alt="">
                                            </div>
                                            <div class="col-md-5">
                                                <h1 class="display-5 mb-4">Saúde:</h1>
                                                <p class="mb-4">A redução da poluição industrial tem um impacto direto na saúde pública, pois diminui a liberação de substâncias tóxicas no ar, na água e no solo. Isso reduz significativamente os riscos de doenças respiratórias (como asma e bronquite), cardiovasculares (como infartos e derrames) e outras condições graves associadas à poluição, como câncer e problemas neurológicos. Com a diminuição dos poluentes, a qualidade do ar melhora, resultando em uma população mais saudável e menos sobrecarregada por doenças relacionadas à poluição.
                                                </p>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseThree" class="tab-pane fade show p-0">
                                        <div class="row g-4">
                                            <div class="col-md-7">
                                                <img src="img/beneficio04.jpg" class="img-fluid w-100 rounded" alt="">
                                            </div>
                                            <div class="col-md-5">
                                                <h1 class="display-5 mb-4">Redução da pegada ambiental:</h1>
                                                <p class="mb-4">A redução da pegada ambiental significa diminuir a quantidade de substâncias nocivas lançadas no meio ambiente pelas atividades industriais. Isso é alcançado por meio da adoção de tecnologias mais limpas e eficientes, que minimizam a emissão de poluentes no ar, água e solo. Ao reduzir a pegada ambiental, as empresas contribuem para a preservação dos recursos naturais, a melhoria da qualidade do ambiente e a diminuição dos impactos negativos sobre a saúde e os ecossistemas.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseFour" class="tab-pane fade show p-0">
                                        <div class="row g-4">
                                            <div class="col-md-7">
                                                <img src="img/beneficio07.jpg" class="img-fluid w-100 rounded" alt="">
                                            </div>
                                            <div class="col-md-5">
                                                <h1 class="display-5 mb-4">Sustentabilidade empresarial</h1>
                                                <p class="mb-4">Sustentabilidade empresarial envolve adotar práticas que minimizem os impactos ambientais e sociais das operações de uma empresa, garantindo o uso eficiente dos recursos naturais e a redução de resíduos e poluentes. Além disso, busca cumprir as exigências regulatórias ambientais, como limites de emissão e gestão de resíduos, evitando multas e sanções. Essas práticas não só protegem o meio ambiente, mas também melhoram a imagem da empresa, atraindo consumidores e investidores que valorizam a responsabilidade social e ambiental.
                                                </p>
                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="display-5 mb-41">Colaboradores</h1>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="img/bnt (1).png" class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a class="h4 d-inline-block mb-4">Indústrias e Empresas</a>
                                <p class="mb-4">Parcerias entre indústrias e empresas sustentáveis promovem tecnologias limpas, reduzem o impacto ambiental e criam oportunidades de negócios, contribuindo para um futuro mais verde e equilibrado.
                                </p>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="img/pesquisa.png" class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a class="h4 d-inline-block mb-4">Instituições de  Pesquisa e Universidades</a>
                                <p class="mb-4">Universidades e instituições de pesquisa colaboram com empresas no desenvolvimento de soluções sustentáveis e capacitação de profissionais, contribuindo para a redução da poluição e um futuro sustentável.
                                </p>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="img/Captura de tela 2025-04-08 084221.png" class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a class="h4 d-inline-block mb-4">Investidores e Acionistas</a>
                                <p class="mb-4">Investidores e acionistas apoiam empresas contra a poluição fornecendo capital, influenciando práticas sustentáveis e garantindo conformidade ambiental. Isso gera valor a longo prazo, melhorando a imagem da empresa e atraindo clientes e talentos.
                                </p>
                           
                            </div>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Services End -->

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