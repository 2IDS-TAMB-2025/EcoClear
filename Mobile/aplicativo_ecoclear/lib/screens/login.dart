import 'package:flutter/material.dart';
import 'package:aplicativo_ecoclear/screens/home_screen.dart';
import 'package:aplicativo_ecoclear/screens/signup.dart';
import '../controller/api_controller.dart';
import '../model/empresaLogin.dart';
import '../globals.dart' as globals;

class Login extends StatefulWidget {
  const Login({super.key});

  @override
  _LogInState createState() => _LogInState();
}

class _LogInState extends State<Login> {
  final TextEditingController _cnpjController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();
  bool _obscure = true;
  bool _isLoading = false;

  @override
  void dispose() {
    _cnpjController.dispose();
    _passwordController.dispose();
    super.dispose();
  }

  void _onCnpjChanged(String value) {
    final onlyDigits = value.replaceAll(RegExp(r'[^0-9]'), '');
    if (onlyDigits.length > 14) {
      final truncated = onlyDigits.substring(0, 14);
      _cnpjController.value = TextEditingValue(
        text: truncated,
        selection: TextSelection.collapsed(offset: truncated.length),
      );
    } else if (onlyDigits != value) {
      _cnpjController.value = TextEditingValue(
        text: onlyDigits,
        selection: TextSelection.collapsed(offset: onlyDigits.length),
      );
    }
    setState(() {});
  }

  Future<void> _login() async {
    final cnpj = _cnpjController.text.trim();
    final senha = _passwordController.text.trim();

    if (cnpj.length != 14 || senha.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text("Preencha CNPJ e senha corretamente!")),
      );
      return;
    }

    setState(() {
      _isLoading = true;
    });

    try {
      final empresaLogin = EmpresaLogin(cnpj: cnpj, senha: senha);
      await ApiController.post(empresaLogin);
      globals.cnpjUsuario = cnpj;

      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (context) => HomePage()),
      );
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text("Erro no login: ${e.toString()}")),
      );
    } finally {
      setState(() {
        _isLoading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    final double h = MediaQuery.of(context).size.height;
    final bool cnpjValido = _cnpjController.text.length == 14;

    return Scaffold(
      backgroundColor: Colors.transparent,
      body: Stack(
        children: [
          // Fundo com degradê cobrindo toda a tela
          Container(
            height: MediaQuery.of(context).size.height * 0.45, // cobre até ~metade da tela
            decoration: const BoxDecoration(
              gradient: LinearGradient(
                colors: [
                  Color.fromARGB(218, 71, 186, 14),
                  Color.fromARGB(255, 41, 41, 41),
                ],
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
              ),
            ),
          ),

          // Logo EcoClear
          SafeArea(
            child: Padding(
              padding: const EdgeInsets.only(left: 22.0, top: 22.0),
              child: const Text(
                "\nEcoClear",
                style: TextStyle(
                  color: Colors.white,
                  fontSize: 32,
                  fontWeight: FontWeight.w800,
                  height: 0.95,
                ),
              ),
            ),
          ),

          // Ícone de menu
          SafeArea(
            child: Align(
              alignment: Alignment.topRight,
            ),
          ),

          // Card branco de login
          Align(
            alignment: Alignment.bottomCenter,
            child: SingleChildScrollView(
              child: Container(
                margin: EdgeInsets.only(top: h * 0.35),
                padding: const EdgeInsets.fromLTRB(20, 26, 20, 28),
                decoration: const BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.only(
                    topLeft: Radius.circular(40),
                    topRight: Radius.circular(40),
                  ),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black26,
                      blurRadius: 10,
                      offset: Offset(0, -2), // sombra suave entre degradê e branco
                    ),
                  ],
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const Center(
                      child: Text(
                        "Entrar",
                        style: TextStyle(fontSize: 28, fontWeight: FontWeight.bold),
                      ),
                    ),
                    const SizedBox(height: 20),

                    // Campo de CNPJ
                    Container(
                      padding: const EdgeInsets.all(16),
                      decoration: BoxDecoration(
                        color: const Color(0xFFF7F7F8),
                        borderRadius: BorderRadius.circular(18),
                      ),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const Text("CNPJ", style: TextStyle(fontSize: 14, color: Color.fromARGB(218, 39, 102, 8))),
                          const SizedBox(height: 8),
                          Container(
                            padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                            decoration: BoxDecoration(
                              color: Colors.white,
                              borderRadius: BorderRadius.circular(12),
                              boxShadow: [
                                BoxShadow(
                                  color: Colors.grey.withOpacity(0.12),
                                  blurRadius: 6,
                                  offset: const Offset(0, 2),
                                ),
                              ],
                            ),
                            child: Row(
                              children: [
                                Expanded(
                                  child: TextField(
                                    controller: _cnpjController,
                                    keyboardType: TextInputType.number,
                                    onChanged: _onCnpjChanged,
                                    decoration: const InputDecoration(
                                      hintText: "XX.XXX.XXX/0001-XX",
                                      border: InputBorder.none,
                                      contentPadding: EdgeInsets.symmetric(horizontal: 6, vertical: 6),
                                    ),
                                  ),
                                ),
                                const SizedBox(width: 6),
                                Icon(
                                  Icons.check,
                                  size: 20,
                                  color: cnpjValido ? Colors.green : Colors.grey,
                                )
                              ],
                            ),
                          ),

                          const SizedBox(height: 14),

                          // Campo de senha
                          const Text("Senha", style: TextStyle(fontSize: 14, color: Color.fromARGB(218, 39, 102, 8))),
                          const SizedBox(height: 8),
                          Container(
                            padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                            decoration: BoxDecoration(
                              color: Colors.white,
                              borderRadius: BorderRadius.circular(12),
                              boxShadow: [
                                BoxShadow(
                                  color: Colors.grey.withOpacity(0.12),
                                  blurRadius: 6,
                                  offset: const Offset(0, 2),
                                ),
                              ],
                            ),
                            child: Row(
                              children: [
                                Expanded(
                                  child: TextField(
                                    controller: _passwordController,
                                    obscureText: _obscure,
                                    decoration: const InputDecoration(
                                      hintText: "Senha...",
                                      border: InputBorder.none,
                                      contentPadding: EdgeInsets.symmetric(horizontal: 6, vertical: 6),
                                    ),
                                  ),
                                ),
                                GestureDetector(
                                  onTap: () => setState(() => _obscure = !_obscure),
                                  child: Container(
                                    width: 34,
                                    height: 34,
                                    decoration: BoxDecoration(
                                      color: const Color.fromARGB(255, 127, 175, 127).withOpacity(0.2),
                                      shape: BoxShape.circle,
                                    ),
                                    child: Icon(
                                      _obscure ? Icons.visibility_off : Icons.visibility,
                                      size: 18,
                                      color: const Color.fromARGB(255, 66, 109, 60),
                                    ),
                                  ),
                                ),
                              ],
                            ),
                          ),
                        ],
                      ),
                    ),

                    const SizedBox(height: 24),

                    // Botão Entrar
                    SizedBox(
                      width: double.infinity,
                      height: 48,
                      child: ElevatedButton(
                        onPressed: _isLoading ? null : _login,
                        style: ElevatedButton.styleFrom(
                          padding: EdgeInsets.zero,
                          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(24)),
                          elevation: 6,
                        ),
                        child: _isLoading
                            ? const CircularProgressIndicator(color: Colors.white)
                            : Ink(
                                decoration: BoxDecoration(
                                  gradient: const LinearGradient(
                                    colors: [Color.fromARGB(218, 71, 186, 14), Color.fromARGB(255, 41, 41, 41)],
                                    begin: Alignment.centerLeft,
                                    end: Alignment.centerRight,
                                  ),
                                  borderRadius: BorderRadius.circular(24),
                                ),
                                child: Container(
                                  alignment: Alignment.center,
                                  child: const Text(
                                    "ENTRAR",
                                    style: TextStyle(
                                      color: Colors.white,
                                      fontWeight: FontWeight.bold,
                                      fontSize: 16,
                                    ),
                                  ),
                                ),
                              ),
                      ),
                    ),

                    const SizedBox(height: 18),

                    // Botão "Cadastre-se"
                    Center(
                      child: TextButton(
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => const SignUpScreen()),
                          );
                        },
                        child: const Text.rich(
                          TextSpan(
                            text: "Não tem uma conta? ",
                            children: [
                              TextSpan(
                                text: "Cadastre-se",
                                style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  color: Color.fromARGB(218, 39, 102, 8),
                                ),
                              ),
                            ],
                          ),
                          style: TextStyle(color: Colors.black54),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
