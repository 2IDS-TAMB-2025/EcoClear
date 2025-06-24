import 'package:flutter/material.dart';

class SignUpScreen extends StatelessWidget {
  const SignUpScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color.fromARGB(255, 148, 143, 143),
      body: SafeArea(
        child: Column(
          children: [
            const SizedBox(height: 40),

          
            Center(
              child: SizedBox(
                width: 200,
                height: 200,
                child: Image.asset("assets/imagens/BioClear.png"),
              ),
            ),

            const SizedBox(height: 20),

            
            Expanded(
              child: Container(
                padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 32),
                decoration: const BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.only(
                    topLeft: Radius.circular(40),
                    topRight: Radius.circular(40),
                  ),
                ),
                child: SingleChildScrollView(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [

                      const Center(
                        child: Text(
                          "Cadastre-se",
                          style: TextStyle(fontSize: 28, fontWeight: FontWeight.bold),
                        ),
                      ),
                      const SizedBox(height: 30),

                      buildInput(label: "Nome Empresa", hint: "Nome Empresa"),
                      const SizedBox(height: 16),

                      buildInput(label: "CNPJ", hint: "XX.XXX.XXX/0001-XX"),
                      const SizedBox(height: 16),

                      buildInput(label: "Senha", hint: "Senha...", obscure: true),
                      const SizedBox(height: 16),

                      buildInput(label: "Confirme a Senha", hint: "Confirme a Senha", obscure: true),
                      const SizedBox(height: 30),

                     
                      SizedBox(
                        width: double.infinity,
                        height: 48,
                        child: ElevatedButton(
                          onPressed: () {
                            Navigator.pop(context); 
                          },
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Color.fromARGB(218, 96, 177, 11),
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                          ),
                          child: const Text(
                            "Cadastre-se",
                            style: TextStyle(
                              fontWeight: FontWeight.bold,
                              fontSize: 16,
                              color: Colors.white,
                            ),
                            
                          ),
                        ),
                      ),

                      const SizedBox(height: 20),

                      Center(
                        child: TextButton(
                          onPressed: () {
                            Navigator.pop(context); 
                          },
                          child: const Text.rich(
                            TextSpan(
                              text: "Já possui uma conta? ",
                              children: [
                                TextSpan(
                                  text: "Log In",
                                  style: TextStyle(
                                    fontWeight: FontWeight.bold,
                                     color: Color.fromARGB(218, 96, 177, 11),
                                  ),
                                ),
                              ],
                            ),
                            style: TextStyle(color: Colors.black),
                          ),
                        ),
                      )
                    ],
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget buildInput({
    required String label,
    required String hint,
    bool obscure = false,
  }) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(label, style: const TextStyle(fontSize: 16)),
        const SizedBox(height: 8),
        Container(
          decoration: BoxDecoration(
            color: Colors.grey[100],
            borderRadius: BorderRadius.circular(12),
            boxShadow: [
              BoxShadow(
                color: Colors.grey.withOpacity(0.2),
                blurRadius: 8,
                offset: const Offset(0, 2),
              ),
            ],
          ),
          child: TextField(
            obscureText: obscure,
            decoration: InputDecoration(
              hintText: hint,
              border: InputBorder.none,
              contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
            ),
          ),
        ),
      ],
    );
  }
}
