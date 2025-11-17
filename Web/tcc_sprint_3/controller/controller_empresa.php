<?php
session_start();  // Inicia a sessão para armazenar mensagens

require_once '../model/model_empresa.php';

if ($_GET["tipo_acao"] == "login") {
    if (isset($_POST["loginCnpj"]) && isset($_POST["loginSenha"])) {
        $empresas = new Empresa();  // Cria a instância da classe Empresa
        $empresa = $empresas->getEmpresaLogin($_POST["loginCnpj"], $_POST["loginSenha"]);
        if (count($empresa) > 0) {
            $_SESSION['msg'] = "Login realizado com sucesso!";
            header("Location: ../view/index2.php?cnpj=" . $_POST["loginCnpj"]);
            exit;
        } else {
            $_SESSION['msg'] = "CNPJ ou senha inválidos!";
            header("Location: ../view/cadastro_login.php");
            exit;
        }
    } else {
        $_SESSION['msg'] = "Preencha os dados!";
        header("Location: ../view/cadastro_login.php");
        exit;
    }
} 
else if ($_GET["tipo_acao"] == "cadastrar") {
    if (isset($_POST["razaoSocial"]) &&
        isset($_POST["cnpj"]) &&
        isset($_POST["descricaoAtividades"]) &&
        isset($_POST["email"]) &&
        isset($_POST["telefone"]) &&
        isset($_POST["endereco"]) &&
        isset($_POST["senha"]) &&
        isset($_POST["reSenha"])
    ) { 
        // Captura as senhas
        $senha = $_POST["senha"];
        $reSenha = $_POST["reSenha"];

        // Cria a instância da classe Empresa
        $empresas = new Empresa();

         // **Verifica se o CNPJ já existe**
        if (count($empresas->getEmpresa($_POST["cnpj"])) > 0) {
            $_SESSION['msg'] = "O CNPJ já está cadastrado!";
            header("Location: ../view/cadastro_login.php");
            exit;
        }

        // Verifica se as senhas coincidem
        if ($empresas->validarSenha($senha, $reSenha)) {  // Passando as duas senhas para a validação
            // Se as senhas coincidirem, salva a empresa
            $empresa = $empresas->inserirEmpresa(
                $_POST["razaoSocial"],
                $_POST["cnpj"],
                $_POST["descricaoAtividades"],
                $_POST["email"],
                $_POST["telefone"],
                $_POST["endereco"],
                $senha // Passa a senha para salvar
            );

            if ($empresa) {
                $_SESSION['msg'] = "Cadastro realizado com sucesso! Faça o login.";
                header("Location: ../view/cadastro_login.php");
                exit;
            } else {
                $_SESSION['msg'] = "Erro ao cadastrar a empresa. Tente novamente.";
                header("Location: ../view/cadastro_login.php");
                exit;
            }
        } else {
            $_SESSION['msg'] = "As senhas não coincidem!";
            header("Location: ../view/cadastro_login.php");
            exit;
        }
    } else {
        $_SESSION['msg'] = "Preencha todos os campos!";
        header("Location: ../view/cadastro_login.php");
        exit;
    }
}

require_once '../model/model_administrador.php';

if ($_GET["tipo_acao"] == "adm") {
    if (isset($_POST["admEmail"]) && isset($_POST["admSenha"])) {
        $adminModel = new Administrador();
        $email = $_POST["admEmail"];
        $senha = $_POST["admSenha"];

        // Busca administrador por email e senha
        $administrador = $adminModel->getAdministradorEmail($email);

        if (count($administrador) > 0) {
            // Verifica a senha
            if ($administrador[0]['SENHA'] === $senha) {
                $_SESSION['msg'] = "Login administrativo realizado com sucesso!";
                header("Location: ../view/view_relatorio_sensores.php?cpf=" . $administrador[0]['CPF']);
                exit;
            } else {
                $_SESSION['msg'] = "Senha incorreta para o administrador!";
                header("Location: ../view/login_adm.html");
                exit;
            }
        } else {
            $_SESSION['msg'] = "Administrador não encontrado!";
            header("Location: ../view/login_adm.html");
            exit;
        }
    } else {
        $_SESSION['msg'] = "Preencha os dados!";
        header("Location: ../view/login_adm.html");
        exit;
    }
}
?>
