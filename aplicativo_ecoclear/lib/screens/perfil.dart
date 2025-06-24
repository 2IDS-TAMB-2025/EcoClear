import 'package:aplicativo_ecoclear/screens/home_screen.dart';
import 'package:flutter/material.dart';

class PerfilUsuario extends StatelessWidget {
  const PerfilUsuario({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color.fromARGB(255, 148, 143, 143),
      body: SafeArea(
        child: SingleChildScrollView(
          child: Column(
            children: [
               Padding(
                padding: const EdgeInsets.only(top: 10, left:0,right:500,bottom: 0),
                child: 
                GestureDetector(
                  onTap: () {
                    Navigator.pushReplacement(
                    context,
                    MaterialPageRoute(builder: (context) => HomePage()),
                  );
                  },
                    child: Icon(
                      Icons.arrow_back,
                      size: 30,
                      color: Colors.white,
                    ),
                  ),
              ),
              Center(
                child: SizedBox(
                  width: 250,
                  child: Padding(
                    padding: EdgeInsets.all(1),
                    child: Image.asset("assets/imagens/BioClear.png"),
                  ),
                ),
              ),
              SizedBox(height: 10,),
              Container(
                padding: const EdgeInsets.symmetric(horizontal: 30, vertical: 20),
                decoration: const BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.only(
                    topLeft: Radius.circular(40),
                    topRight: Radius.circular(40),
                  ),
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const Center(
                      child: Text(
                        "Perfil do Usuário",
                        style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
                      ),
                    ),
                    const SizedBox(height: 18),
                    buildCampo(label: "Nome da Empresa", hint: "Nome"),
                    const SizedBox(height: 20),
                    buildCampo(label: "CNPJ", hint: "00.000.000/0001-00"),
                    const SizedBox(height: 20),
                    buildCampo(label: "Email", hint: "contato@empresa.com"),
                    const SizedBox(height: 20),
                    buildCampo(label: "Telefone", hint: "(11) 99999-9999"),
                    const SizedBox(height: 25),
                    SizedBox(
                      width: double.infinity,
                      height: 48,
                      child: ElevatedButton(
                        onPressed: () {
                           Navigator.push(
                        context,
                        MaterialPageRoute(builder: (context) => HomePage()),
                      );
                        },
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color.fromARGB(218, 96, 177, 11),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(12),
                          ),
                        ),
                        child: const Text(
                          "Salvar Alterações",
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 16,
                            color: Colors.white,
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget buildCampo({required String label, required String hint}) {
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
