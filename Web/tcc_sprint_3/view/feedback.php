<?php
 if(isset($_GET["cnpj"])){
        $cnpj = "?cnpj=".$_GET["cnpj"];
    }else{
        $cnpj = "";
    }

    require_once "../controller/controller_feedback.php";
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

            #emcima {
                display: flex;
                justify-content: center;
                background: rgba(255, 255, 255, 0.9);
            }
            nav button {
                background: none;
                border: none;
                color:  #76A540;
                padding: 14px;
                cursor: pointer;
                font-size: 16px;
            }
            nav button.active {
                border-bottom: 2px solid #76A540;
                font-weight: bold;
            }
            .container {
                padding: 20px;
            }
            .card {
                display: flex;
                align-items: center;
                background-color: white;
                padding: 15px;
                border-radius: 10px;
                margin-bottom: 10px;
            }
            .icon {
                font-size: 28px;
                margin-right: 15px;
            }
            .danger {
                background-color: #ffcccc;
            }
            .safe {
                background-color: #ccffcc;
            }
            .info-section h2 {
                background-color: #ccffcc;
                padding: 5px;
            }
            /* Áreas de conteúdo */
            .bloco {
                padding: 60px;
                padding-left: 80px;
                padding-right: 80px;
            }

            /* Cartões de mensagens */
            .cartao {
                display: flex;
                align-items: center;
                background-color: white;
                padding: 15px;
                border-radius: 10px;
                margin-bottom: 10px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .icone {
                font-size: 28px;
                margin-right: 15px;
            }
            .alerta {
                background-color: #ffcccc;
            }
            .seguro {
                background-color: #ccffcc;
            }

            .info-section {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 16px;
            
            color: #000;
            font-family: "Inter", sans-serif;
            }

            .info-section h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #76A540;
            font-weight: 700;
            }

            #formRelatorio {
            display: flex;
            flex-direction: column;
            gap: 18px;
            }

            #formRelatorio input[type="date"],
            #formRelatorio input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #333;
            border-radius: 10px;
            background: #fff;
            color: #000;
            font-size: 15px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            }

            #formRelatorio input[type="date"]:focus,
            #formRelatorio input[type="text"]:focus {
            border-color: #76A540;
            box-shadow: 0 0 8px #76A540;
            outline: none;
            }

            #formRelatorio button[type="submit"] {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #76A540;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            }

            #formRelatorio button[type="submit"]:hover {
            background: #76A540;
            transform: translateY(-2px);
            }

            /* --- Lista de relatos --- */
            #listaRelatos {
            margin-top: 25px;
            padding: 15px;
            background: #fff;
            border-radius: 10px;
            min-height: 60px;
            font-size: 14px;
            color: #000;
            }

            .relatorio {
            background: #f2f2f2;
            color: #000;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 600;
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
                        <a href="about2.php<?php echo $cnpj ?>" class="nav-item nav-link">Sobre nós</a>
                        <a href="service2.php<?php echo $cnpj ?>" class="nav-item nav-link">Monitoramento em tempo real</a>
                        <a href="noticia_view2.php<?php echo $cnpj ?>" class="nav-item nav-link">Notícias</a>
                        <div class="nav-item dropdown"></div>
                        <a href="contact2.php<?php echo $cnpj ?>" class="nav-item nav-link">Contatos</a>
                        <a href="feedback.php<?php echo $cnpj ?>" class="nav-item nav-link active">FeedBack</a>
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
                    <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">FeedBack</h4>
                    <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    </ol>    
                </div>
            </div>
            <!-- Header End -->
        </div>
        <!-- Navbar & Hero End -->

    
        <nav id="emcima">
            <button class="tab-button active" data-tab="controle">Feedback</button>
            <button class="tab-button" data-tab="info">Relatórios</button>
        </nav>

        <div class="tab-content" id="controle">
            <div class="bloco" id="controle">
                <?php 
                if(count($feedbacks) == 0){
                    echo "<div class='cartao alerta'>";
                    echo "<span class='icone'>⚠️</span>";
                    echo "Sem feedbacks!";
                    echo "</div>";
                }
                else{
                    foreach($feedbacks as $feedback){
                        echo "<div class='cartao seguro'>";
                        echo "<span class='icone'>📌</span>";
                        echo $feedback["CONTEUDO"];
                        echo "</div>";
                    }
                }
                ?>
        </div>
        </div>

        <div class="tab-content info-section" id="info" style="display:none">
            <form id="formRelatorio">
                <input type="date" id="data" placeholder="Data" required>
                <input type="text" id="descricao" placeholder="descricao" required>
                <button type="submit">Relatar</button>
            </form>

            <div id="listaRelatos"></div>
        </div>

        <script>
        document.querySelectorAll(".tab-button").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll(".tab-button").forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                document.querySelectorAll(".tab-content").forEach(c => c.style.display = "none");
                document.getElementById(btn.dataset.tab).style.display = "block";
            });
        });

         class Relatorio {
            constructor(data, descricao) {
                this.data = data;
                this.descricao = descricao;
            }

            apresentar() {
                return `${this.data} | ${this.descricao}`;
            }
        }

        // array para armazenar relatórios
        const relatorios = [];

        const form = document.getElementById('formRelatorio');
        const listaRelatos = document.getElementById('listaRelatos');

        // Evento de envio do formulário
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const data = document.getElementById('data').value; // já é string no formato yyyy-mm-dd
            const descricao = document.getElementById('descricao').value.trim();

            if (data && descricao) {
                // Cria novo objeto Relatorio
                const novoRelatorio = new Relatorio(data, descricao);
                relatorios.push(novoRelatorio);

                // Atualiza a lista na tela
                atualizarLista();

                // Limpa o formulário
                form.reset();
            } else {
                // Opcional: mensagem de erro simples
                alert('Por favor, preencha a data e a descrição.');
            }
        });

        function atualizarLista() {
            listaRelatos.innerHTML = '';
            relatorios.forEach(r => {
                const div = document.createElement('div');
                div.classList.add('relatorio'); // aplica o fundo verde
                div.textContent = r.apresentar();
                listaRelatos.appendChild(div);
            });
        }
        </script>

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
                                <p class="text-white mb-0">Ecoclear@gmail.com</p>
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
