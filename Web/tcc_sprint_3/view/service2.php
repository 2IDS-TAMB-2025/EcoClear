<?php
    require_once "../controller/controller_feedback.php";
    require_once "../controller/controller_sensor.php";
    if(isset($_GET["cnpj"])){
        $cnpj = "?cnpj=".$_GET["cnpj"];
    }else{
        $cnpj = "";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <head>
    <!-- <meta http-equiv="refresh" content="10"> -->
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

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@2.0.0"></script>
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            
            canvas {
                max-width: 800px;
                margin: auto;
                }
            header {
                background-color: #1e88e5;
                color: white;
                padding: 20px;
                text-align: center;
            }
    
            .filters {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                margin: 20px 0;
            }
    
            .filters select {
                margin: 10px;
                padding: 8px;
                font-size: 16px;
            }
    
            .chart-container {
                width: 90%;
                max-width: 900px;
                margin: 30px auto;
                background-color: white;
                padding: 20px;
                border-radius: 16px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            }
    
            canvas {
                width: 100% !important;
                height: auto !important;
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
            float: left;
            height: 100px;
            }

            .cardGrafico {
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
            table {
                width: 80%;
                border-collapse: collapse;
                font-family: Arial, sans-serif;
                margin: 20px auto 0 auto; 
            }

            th {
                background-color: #2e7d32; /* Verde escuro */
                color: white;
                padding: 10px;
                text-align: left;
                border: 1px solid #ccc;
            }

            td {
                padding: 8px;
                border: 1px solid #ccc;
            }

            tr:nth-child(even) {
                background-color: #e8f5e9; /* Verde claro */
            }

            tr:hover {
                background-color: #c8e6c9; /* Hover verde mais forte */
            } 

            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
            }
            header {
                background-color: rgb(73, 137, 5);
                color: white;
                padding: 10px;
                text-align: center;
            }
            nav {
                display: flex;
                justify-content: center;
            }
            nav button {
                background: none;
                border: none;
                color: white;
                padding: 14px;
                cursor: pointer;
                font-size: 16px;
            }
            nav button.active {
                border-bottom: 2px solid white;
                font-weight: bold;
            }

            .container1 {
                display: flex;
                flex-wrap: wrap;  
                gap: 10px;        
                padding: 10px;
                justify-content: center;
            }

            .card {
                flex: 1 1 200px;  
                width: 350px;
                background-color: white;
                padding: 16px;
                border-radius: 10px;
                text-align: center;
                margin-left: 33px;
                margin-right: 33px;
            }

            .icon {
                font-size: 28px;
                margin-bottom: 10px;
            }

            .safe {
    background-color: #ccffcc; /* Verde claro */
}

.warning {
    background-color: #fff3cd; /* Amarelo claro */
}

.danger {
    background-color: #f8d7da; /* Vermelho claro */
}
            .info-section h2 {
                background-color: #ccffcc;
                padding: 5px;
            }
            
            .textodados {
                background-color: #ccffcc;
                border-radius: 12px;
                padding: 20px;
                width: 80%;       
                margin: 20px auto;
                box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
                }

    .textodados h3 {
      margin: 0 0 15px 0;
      text-align: center;
      color: #333;
    }

    .textodados p {
      margin: 8px 60px;
      font-size: 14px;
      color: #555;
      line-height: 1.5;
      text-align: justify;
    }

    .textodados ul {
          font-size: 14px;
            color: #444;
            margin: 10px 0 0 15px;
            list-style-type: none;
            padding-left: 30%;
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
                        <a href="service2.php<?php echo $cnpj ?>" class="nav-item nav-link active">Monitoramento em tempo real</a>
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
                    <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Monitoramento em tempo real</h4>
                    <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    </ol>    
                </div>
            </div>
            <!-- Header End -->
        </div>
        <!-- Navbar & Hero End -->



</br></br>

    <h3>Acompanhe o monitoramento em tempo real da sua empresa.</h3>
    <!-- <div class="linha-blocos">
        <div id="monitor"></div><br>
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

        <div class="container1" id="controle">
        </div>
    </div> -->
    <div style="clear: both;"></div>

    <div class="container1">
    <?php
    function getRowColor($tipo, $valor) {
        switch ($tipo) {
            case "Sensor de Temperatura":
                if ($valor <= 26) return "safe";
                else if ($valor <= 30) return "warning";
                return "danger";
            case "Sensor de Umidade":
                if ($valor <= 60) return "safe";
                else if ($valor <= 80) return "warning";
                return "danger";
            case "Sensor de Gás":
                if ($valor <= 1000) return "safe";
                else if ($valor <= 3000) return "warning";
                return "danger";
            default:
                return "";
        }
    }

    function getUnit($tipo) {
        switch ($tipo) {
            case "Sensor de Temperatura": return "°C";
            case "Sensor de Umidade": return "%";
            case "Sensor de Gás": return "ppm";
            default: return "";
        }
    }

    if (isset($dados_sensores) && count($dados_sensores) > 0) {
        foreach ($dados_sensores as $dado) {
            $nome = $dado["NOME"];
            $tipo = $dado["TIPO"];
            $valor = $dado["DADO"];
            $classe = getRowColor($tipo, $valor);
            $unidade = getUnit($tipo);
            echo "<div class='card {$classe}'>";
            echo "<div><strong>{$nome}</strong> <br> {$tipo} <br>{$valor} {$unidade}</div>";
            echo "</div>";
        }
    } else {
        echo "<div class='card alerta'><strong>⚠️ Nenhum dado de sensor encontrado.</strong></div>";
    }
    ?>
</div>


                </br><br>
    <div style="display: flex; justify-content: center; align-items: flex-start; gap: 20px;">
    <!-- Gráfico de Linha Vendas -->
    <div style="width: 500px; height: 400px; margin-top:4%;">
        <canvas id="vendasChart"></canvas>
    </div>

    <!-- Gráfico de Pizza Vendas -->
    <div id="graficoPizza" style="width: 500px; height: 400px;clear:both"></div>
    </div>

    <div style="display: flex; justify-content: center; align-items: flex-start; gap: 20px;">
    <!-- Gráfico de Linha Gases -->
    <div style="width: 500px; height: 400px; margin-top:4%;">
        <canvas id="gases"></canvas>
    </div>

    <!-- Gráfico de Pizza Gases -->
    <div id="graficoPizzaGases" style="width: 500px; height: 400px;"></div>
    </div>

    <!-- Scripts unificados -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    // --- Dados vindos do PHP ---
    const dadosSensores = <?php echo json_encode($todos_dados_sensores); ?>;

    // Vamos separar por tipo de sensor:
    const tempLabels = [];
    const tempValores = [];
    const gasLabels = [];
    const gasValores = [];
    const umiLabels = [];
    const umiValores = [];

    dadosSensores.forEach((item, index) => {
        const nome = item.NOME || `Sensor ${index+1}`;
        const tipo = item.TIPO;
        const valor = parseFloat(item.DADO);

        if (tipo.includes("Temperatura")) {
            tempLabels.push(nome);
            tempValores.push(valor);
        } else if (tipo.includes("Gás")) {
            gasLabels.push(nome);
            gasValores.push(valor);
        } else if (tipo.includes("Umidade")) {
            umiLabels.push(nome);
            umiValores.push(valor);
        }
    });

    // --- Gráfico de Linha - Temperatura ---
    const ctxTemp = document.getElementById('vendasChart').getContext('2d');
    new Chart(ctxTemp, {
        type: 'line',
        data: {
            labels: tempLabels,
            datasets: [{
                label: 'Temperatura (°C)',
                data: tempValores,
                borderColor: 'rgba(80, 208, 106, 0.89)',
                backgroundColor: 'rgba(72, 213, 72, 0.3)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: false }
            }
        }
    });

    // --- Gráfico de Linha - Gases ---
    const ctxGases = document.getElementById('gases').getContext('2d');
    new Chart(ctxGases, {
        type: 'line',
        data: {
            labels: gasLabels,
            datasets: [{
                label: 'Gases (ppm)',
                data: gasValores,
                borderColor: 'rgba(255, 99, 132, 0.9)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: false }
            }
        }
    });

    // --- Gráfico de Pizza - Temperatura ---
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChartPizza);

    function drawChartPizza() {
        const dataTemp = [['Sensor', 'Temperatura']];
        tempLabels.forEach((label, i) => dataTemp.push([label, tempValores[i]]));

        const data = google.visualization.arrayToDataTable(dataTemp);
        const options = {
            title: 'Temperatura por Sensor',
            pieHole: 0.4,
            colors: ['#6CC56F', '#2e7d32', '#58B04D', '#3aa724', '#7AC56B', '#4E963B'],
            backgroundColor: 'transparent'
        };
        const chart = new google.visualization.PieChart(document.getElementById('graficoPizza'));
        chart.draw(data, options);

        // --- Gráfico de Pizza - Gases ---
        const dataGas = [['Sensor', 'Gás']];
        gasLabels.forEach((label, i) => dataGas.push([label, gasValores[i]]));

        const data2 = google.visualization.arrayToDataTable(dataGas);
        const options2 = {
            title: 'Gases por Sensor',
            pieHole: 0.4,
            colors: ['#f57f17', '#ffb300', '#ffa000', '#ffca28'],
            backgroundColor: 'transparent'
        };
        const chart2 = new google.visualization.PieChart(document.getElementById('graficoPizzaGases'));
        chart2.draw(data2, options2);
    }
</script>

        
        <!-- Services Start -->

        <table border="1">
            <tr>
                <th>NOME</th>
                <th>TIPO</th>
                <th>LOCALIZACAO</th>
                <th>STATUS DO SENSOR</th>
            </tr>
            <?php
                if(isset($sensores) && count($sensores) > 0){
                foreach($sensores as $Sensor){

            ?> 
                <tr>
                    <td><?php echo $Sensor["NOME"];?></td>
                    <td><?php echo $Sensor["TIPO"];?></td>
                    <td><?php echo $Sensor["LOCALIZACAO"];?></td>
                    <td><?php echo $Sensor["STATUS_SENSOR"];?></td>

                </tr>
            <?php 
                }
            }   
            ?> 
        </table><br/><br/><br/>

        <?php
                if(isset($sensores) && count($sensores) > 0){
                foreach($sensores as $Sensor){

            ?> 
               
            <?php 
                }
            }   
            ?>

        <h3>Informações e Dados</h3><br>
            <div class="textodados">
    <h3>Temperatura</h3>
    <p>
      Embora não haja um padrão único para a temperatura do ar emitido por indústrias,
      é fundamental que as emissões térmicas não causem desconforto ou riscos à saúde
      dos trabalhadores e da comunidade próxima. As normas de conforto térmico recomendam
      que a temperatura em ambientes de trabalho seja mantida entre 20°C e 26°C.
      Temperaturas acima desse intervalo podem indicar uma situação de alerta, 
      necessitando de ações corretivas para garantir a segurança e o bem-estar das pessoas.
    </p>
  </div>

  <div class="textodados">
    <h3>Umidade</h3>
    <p>
      A umidade relativa do ar é a quantidade de vapor de água presente na atmosfera
      em relação ao máximo que o ar pode reter na mesma temperatura. Níveis adequados
      de umidade são fundamentais para o conforto, saúde humana e conservação de materiais.
    </p>
    <ul>
      <li>&lt; 30%: Umidade baixa – ressecamento da pele, irritação nos olhos, risco de infecções.</li>
      <li>30–60%: Ideal – proporciona conforto térmico e preserva estruturas.</li>
      <li>60–80%: Umidade alta – favorece proliferação de ácaros e fungos.</li>
      <li>&gt; 80%: Excessiva – risco de doenças respiratórias e deterioração de materiais.</li>
    </ul>
  </div>

  <div class="textodados">
    <h3>Gases</h3>
    <p>
      A qualidade do ar refere-se à concentração de gases e poluentes presentes no ambiente.
      Em pequenas quantidades, esses gases não costumam ser prejudiciais, mas em ambientes fechados
      podem se acumular e se tornar perigosos.
    </p>
    <ul>
      <li>0 – 300 ppm: Qualidade boa – ar limpo.</li>
      <li>300 – 1.000 ppm: Moderada – pode causar leve desconforto.</li>
      <li>1.000 – 3.000 ppm: Ruim – dor de cabeça, fadiga, irritação nos olhos.</li>
      <li>3.000 – 10.000 ppm: Muito ruim – risco de náuseas, tontura e sonolência.</li>
      <li>&gt; 10.000 ppm: Perigosa – risco de intoxicação severa.</li>
    </ul>
  </div>
  <br><br>


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