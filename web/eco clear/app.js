document.addEventListener('DOMContentLoaded', () => {
  const registerForm = document.getElementById('registerForm');
  const loginForm = document.getElementById('loginForm');
  const forgotPasswordForm = document.getElementById('forgotPasswordForm');
  var btnSignin = document.querySelector("#signin");
var btnSignup = document.querySelector("#signup");

var body = document.querySelector("body");


btnSignin.addEventListener("click", function () {
   body.className = "sign-in-js"; 
});

btnSignup.addEventListener("click", function () {
    body.className = "sign-up-js";
})

  if (registerForm) {
    registerForm.addEventListener('submit', function (e) {
      e.preventDefault();

      const razaoSocial = this.razaoSocial.value.trim();
      const cnpj = this.cnpj.value.trim();
      const descricaoAtividades = this.descricaoAtividades.value.trim();
      const email = this.email.value.trim();
      const telefone = this.telefone.value.trim();
      const endereco = this.endereco.value.trim();
      const senha = this.senha.value;
      const reSenha = this.reSenha.value;

      if (senha !== reSenha) {
        alert('As senhas não coincidem. Por favor, verifique.');
        return;
      }

      if (!razaoSocial || !cnpj || !descricaoAtividades || !email || !telefone || !endereco || !senha) {
        alert('Por favor, preencha todos os campos.');
        return;
      }

      alert('Cadastro realizado com sucesso!');
      this.reset();

      // Redirect to login page (assuming cadastro_login.html)
      window.location.href = 'cadastro_login.html';
    });
  }

  if (loginForm) {
    loginForm.addEventListener('submit', function (e) {
      e.preventDefault();

      const loginCnpj = this.loginCnpj.value.trim();
      const loginSenha = this.loginSenha.value;

      if (!loginCnpj || !loginSenha) {
        alert('Por favor, preencha todos os campos.');
        return;
      }

      alert('Login realizado com sucesso!');
      this.reset();

      // Redirect to index2.html after login
      window.location.href = '../index2.html';
    });
  }

  if (forgotPasswordForm) {
    forgotPasswordForm.addEventListener('submit', function (e) {
      e.preventDefault();

      const emailInput = this.email.value.trim();

      if (!emailInput) {
        alert('Por favor, insira um e-mail válido.');
        return;
      }

      // Simulate sending email
      alert(`Instruções para redefinir a senha foram enviadas para: ${emailInput}`);

      this.reset();
    });
  }
});
