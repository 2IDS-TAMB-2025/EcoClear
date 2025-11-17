<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json; charset=utf-8');

require_once "../model/model_senha.php";

$model = new ModelSenha();

if (!isset($_POST["acao"])) {
    echo json_encode(["status" => "erro", "mensagem" => "Ação não especificada."]);
    exit;
}

$acao = $_POST["acao"];

try {
    // --- Enviar e-mail ---
    if ($acao === "enviar_email") {
        $email = trim($_POST["email"]);
        $empresas = $model->verificarEmail($email);

        if ($empresas && count($empresas) > 0) {
            // Para simplificar, envia o token da primeira empresa
            $empresa = $empresas[0];
            $token = bin2hex(random_bytes(16));
            $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));
            $cnpj = $empresa["CNPJ"];

            $model->salvarToken($cnpj, $email, $token, $expira);

            echo json_encode([
                "status" => "ok",
                "token" => $token,
                "nome" => $empresa["RAZAO_SOCIAL"]
            ]);
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "E-mail não encontrado."]);
        }
    }

    // --- Obter informações da empresa pelo token ---
    elseif ($acao === "buscar_empresa_por_token") {
        if (empty($_POST["token"])) {
            echo json_encode(["status" => "erro", "mensagem" => "Token não informado."]);
            exit;
        }

        $token = $_POST["token"];
        $empresa = $model->buscarCnpjPorToken($token);

        if ($empresa) {
            echo json_encode([
                "status" => "ok",
                "cnpj" => $empresa["CNPJ"],
                "nome" => $empresa["RAZAO_SOCIAL"]
            ]);
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Token inválido ou expirado."]);
        }
    }

    // --- Redefinir senha ---
    elseif ($acao === "redefinir_senha") {
        if (empty($_POST["token"]) || empty($_POST["nova_senha"])) {
            echo json_encode(["status" => "erro", "mensagem" => "Dados incompletos."]);
            exit;
        }

        $token = $_POST["token"];
        $novaSenha = $_POST["nova_senha"];

        if ($model->redefinirSenha($token, $novaSenha)) {
            echo json_encode(["status" => "ok"]);
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Token inválido ou expirado."]);
        }
    }

    else {
        echo json_encode(["status" => "erro", "mensagem" => "Ação inválida."]);
    }

} catch (Throwable $e) {
    echo json_encode(["status" => "erro", "mensagem" => "Erro interno: " . $e->getMessage()]);
    exit;
}
?>