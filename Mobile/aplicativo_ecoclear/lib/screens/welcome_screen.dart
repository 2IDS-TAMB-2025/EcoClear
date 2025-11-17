import 'package:flutter/material.dart';
import 'package:aplicativo_ecoclear/screens/login.dart';
import 'package:aplicativo_ecoclear/screens/signup.dart';

class WelcomeScreen extends StatelessWidget {
  const WelcomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            colors: [Color.fromARGB(218, 71, 186, 14),Color.fromARGB(255, 41, 41, 41)],
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
          ),
        ),
        child: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Image.asset(
                "assets/imagens/BioClear.png", // coloque o caminho da sua imagem aqui
                width: 400,
                height: 200,
                fit: BoxFit.contain,
              ),
              const SizedBox(height: 10),
              const SizedBox(height: 50),

              SizedBox (height:15),
                Padding(
                  padding:EdgeInsets.symmetric(horizontal: 10),
                  child: Text("Aplicativo para monitorar e alertar sobre os níveis de poluição gerados pelas empresas, contribuindo para a fiscalização ambiental!", 
                  textAlign:TextAlign.center,
                  style:TextStyle(
                    fontSize: 17,
                    fontWeight: FontWeight.w600,
                    color: const Color.fromARGB(255, 255, 255, 255).withOpacity(0.8),
                  ),
                  ),
                ),


              const SizedBox(height: 40),
              // Botão SIGN IN
              OutlinedButton(
                style: OutlinedButton.styleFrom(
                  side: const BorderSide(color: Colors.white),
                  foregroundColor: Colors.white,
                  padding: const EdgeInsets.symmetric(horizontal: 110, vertical: 15),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(30),
                  ),
                ),
                onPressed: () {
                  Navigator.push(
                        context,
                        MaterialPageRoute(builder: (context) => Login()),
                      );
                },
                child: const Text(
                  "ENTRAR",
                  style: TextStyle(fontSize: 16),
                ),
              ),
              const SizedBox(height: 20),
              // Botão SIGN UP
              ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.white.withOpacity(0.8),
                  foregroundColor: const Color.fromARGB(255, 31, 30, 30),
                  padding: const EdgeInsets.symmetric(horizontal: 80, vertical: 15),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(30),
                  ),
                ),
                onPressed: () {
                  Navigator.push(
                          context,
                          MaterialPageRoute(builder: (context) => SignUpScreen())
                      ); 
                },
                child: const Text(
                  "CADASTRAR-SE",
                  style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
