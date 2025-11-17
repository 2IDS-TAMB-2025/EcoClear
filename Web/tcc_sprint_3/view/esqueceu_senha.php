<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Clear - Recuperar Senha</title>
    <link rel="stylesheet" href="cadastra_login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="shortcut icon" href="img/logo3 (1).png" type="image/x-icon">
</head>
<body>
<div class="container">
    <div class="content first-content">
        <div class="first-column">
            <a href="cadastro_login.php" class="voltar"><i class="fas fa-arrow-left"></i> Voltar</a>
            <h2 class="title title-primary">Recupere sua senha!</h2>
            <p class="description description-primary">Siga as instruções para recuperação de senha.</p>
        </div>
        <div class="second-column-1" style="justify-content: center;">
            <h2 class="title title-primary" style="color:#76a540">Esqueceu a senha?</h2>
            <p class="description description-primary">Insira seu e-mail abaixo para receber instruções sobre como redefinir sua senha.</p>

            <form class="form" id="forgotPasswordForm">
                <label class="label-input" for="email">
                    <i class="far fa-envelope icon-modify"></i>
                    <input type="email" id="email" placeholder="Digite seu e-mail" required>
                </label>
                <button type="submit" class="btn btn-second">Enviar</button>
            </form>
        </div>
    </div>
</div>

<!-- EmailJS -->
<script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){
    emailjs.init("m34sMlzOzZ_Z3h-Yi"); // Public Key

    const form = document.getElementById("forgotPasswordForm");
    const emailInput = document.getElementById("email");

    form.addEventListener("submit", async function(e){
        e.preventDefault();

        const email = emailInput.value.trim();
        if (!email) return alert("Digite um e-mail válido.");

        try {
            const resposta = await fetch("../controller/controller_senha.php", {
                method: "POST",
                body: new URLSearchParams({
                    acao: "enviar_email",
                    email: email
                })
            });

            const dados = await resposta.json();
            
            if (dados.status === "ok") {
                const link = `http://10.141.128.38/tcc_sprint_3/view/reset_senha.php?token=${encodeURIComponent(dados.token)}`;
                console.log(link);
                
                const templateParams = {
                    to_email: email,
                    message: `Olá ${dados.nome}!\nClique no link abaixo para redefinir sua senha:\n\n${link}\n\nO link expira em 1 hora.`,
                    link_recuperacao: link
                };

                await emailjs.send("service_ecoclear", "template_ecoclear", templateParams);
                alert("E-mail de recuperação enviado! Verifique sua caixa de entrada.");
                emailInput.value = "";
            } else {
                alert(dados.mensagem || "Erro ao processar solicitação.");
            }
        } catch (err) {
            console.error(err);
            alert("Erro de conexão. Verifique o console.");
        }
    });
});
</script>
</body>
</html>