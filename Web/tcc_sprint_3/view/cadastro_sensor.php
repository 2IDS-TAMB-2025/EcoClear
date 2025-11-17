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
    <meta charset="UTF-8">
    <title>Cadastro de Sensor</title>
    <link rel="shortcut icon" href="img/logo3 (1).png" type="image/x-icon">
    <style>
        /* Reset básico */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #76a547, #a0d468);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .container {
            background-color: #fff;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #4a7c2b;
        }

        form label {
            display: block;
            margin: 12px 0 6px;
            font-weight: 600;
            color: #555;
        }

        form input[type="text"] {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            transition: border 0.3s;
        }

        form input[type="text"]:focus {
            border-color: #76a547;
            outline: none;
        }

        form input[type="submit"] {
            margin-top: 20px;
            width: 100%;
            padding: 14px;
            font-size: 16px;
            background-color: #76a547;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        form input[type="submit"]:hover {
            background-color: #5b8a3a;
            transform: scale(1.02);
        }

        /* Responsivo */
        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro de Sensor</h1>
        <form action="../controller/controller.php<?php echo $cpf ?>" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" placeholder="Nome..." required>
            
            <label for="tipo">Tipo:</label>
            <input type="text" name="tipo" id="tipo" placeholder="Tipo..." required>
            
            <label for="localizacao">Localização:</label>
            <input type="text" name="localizacao" id="localizacao" placeholder="Localização..." required>
            
            <label for="status_sensor">Status do Sensor:</label>
            <input type="text" name="status_sensor" id="status_sensor" placeholder="Status do Sensor..." required>
            
            <label for="unidade">Unidade:</label>
            <input type="text" name="unidade" id="unidade" placeholder="Unidade..." required>

            <label for="fk_cnpj_empresa">CNPJ:</label>
            <input type="text" name="fk_cnpj_empresa" id="fk_cnpj_empresa" placeholder="CNPJ..." required>
            
            <input type="submit" value="Cadastrar!">
        </form>
    </div>
</body>
</html>
