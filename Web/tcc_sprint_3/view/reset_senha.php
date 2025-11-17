<?php
$token = $_GET["token"] ?? "";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha - Eco Clear</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <style>
        body { font-family: 'Segoe UI', Roboto, Arial, sans-serif; background: linear-gradient(135deg, #a8e063, #56ab2f); margin:0; height:100vh; display:flex; justify-content:center; align-items:center; }
        .container { background-color:#fff; border-radius:16px; box-shadow:0 6px 20px rgba(0,0,0,0.15); padding:40px 50px; width:100%; max-width:420px; text-align:center; }
        h2 { color:#76a540; margin-bottom:10px; font-size:26px; }
        p { color:#444; font-size:14px; margin-bottom:25px; }
        .label-input { position:relative; display:flex; align-items:center; background:#f5f5f5; border-radius:8px; padding:10px 14px; margin-bottom:20px; }
        .label-input i { color:#76a540; margin-right:10px; }
        input[type="password"] { border:none; outline:none; background:transparent; font-size:15px; flex:1; }
        .btn { background-color:#76a540; border:none; color:white; padding:12px 20px; border-radius:8px; cursor:pointer; font-weight:600; width:100%; transition:background-color 0.3s ease, transform 0.2s; }
        .btn:hover { background-color:#5b8a34; transform:scale(1.02); }
        .footer { font-size:13px; color:#888; margin-top:20px; }
        .footer a { color:#76a540; text-decoration:none; }
        .footer a:hover { text-decoration:underline; }
    </style>
</head>
<body>
<div class="container">
    <img src="img/logo.png" alt="Eco Clear Logo" style="height: 60px; margin-bottom:10px;">
    <h2>Redefinir Senha</h2>
    <p>Digite sua nova senha abaixo.</p>
    <p id="empresaInfo" style="font-weight:bold; color:#333;"></p>

    <form id="resetForm">
        <input type="hidden" id="token" value="<?= htmlspecialchars($token) ?>">
        <label class="label-input" for="novaSenha">
            <i class="fas fa-lock"></i>
            <input type="password" id="novaSenha" placeholder="Nova senha" required>
        </label>
        <button type="submit" class="btn">Salvar nova senha</button>
    </form>

    <div class="footer">
        <p>Voltar para o <a href="cadastro_login.php">login</a></p>
    </div>
</div>

<script>
window.addEventListener("DOMContentLoaded", async () => {
    const token = document.getElementById("token").value;
    if (!token) return document.getElementById("empresaInfo").innerText = "Token inválido.";

    try {
        const resposta = await fetch("../controller/controller_senha.php", {
            method: "POST",
            body: new URLSearchParams({ acao: "buscar_empresa_por_token", token })
        });
        const dados = await resposta.json();
        if (dados.status === "ok") {
            document.getElementById("empresaInfo").innerText =
                `Olá, empresa ${dados.nome}! Redefina sua senha abaixo.`;
        } else {
            document.getElementById("empresaInfo").innerText = "Token inválido ou expirado.";
        }
    } catch (error) {
        console.error(error);
        document.getElementById("empresaInfo").innerText = "Erro ao carregar informações.";
    }
});

document.getElementById("resetForm").addEventListener("submit", async function(e){
    e.preventDefault();
    const token = document.getElementById("token").value;
    const senha = document.getElementById("novaSenha").value.trim();
    if (senha.length < 6) return alert("A senha deve ter pelo menos 6 caracteres.");

    try {
        const resposta = await fetch("../controller/controller_senha.php", {
            method: "POST",
            body: new URLSearchParams({ acao: "redefinir_senha", token, nova_senha: senha })
        });
        const dados = await resposta.json();
        if (dados.status === "ok") {
            alert("Senha redefinida com sucesso!");
            window.location.href = "cadastro_login.php";
        } else {
            alert(dados.mensagem || "Erro ao redefinir senha.");
        }
    } catch (error) {
        console.error(error);
        alert("Erro de conexão. Verifique o console.");
    }
});
</script>
</body>
</html>