import 'package:aplicativo_ecoclear/screens/home_screen.dart';
import 'package:aplicativo_ecoclear/screens/signup.dart';
import 'package:flutter/material.dart';

class Login extends StatefulWidget {
  const Login({super.key});

  @override
  _LogInState createState() => _LogInState();
}

class _LogInState extends State<Login> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor:Color.fromARGB(255, 148, 143, 143),
      body: SafeArea(
        child: Column(
          children: [
            const SizedBox(height: 40),

    
            Center(
              child: SizedBox(
                width: 200,
                height: 200,
                child: Image.asset(
                    "assets/imagens/BioClear.png", 
                    scale:1.0,),
              ),
            ),

            const SizedBox(height: 30),

      
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
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const Center(
                      child: Text(
                        "Login",
                        style: TextStyle(fontSize: 28, fontWeight: FontWeight.bold),
                      ),
                    ),
                    const SizedBox(height: 40),

               
                    const Text("CNPJ", style: TextStyle(fontSize: 16)),
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
                      child: const TextField(
                        decoration: InputDecoration(
                          hintText: "XX.XXX.XXX/0001-XX",
                          border: InputBorder.none,
                          contentPadding: EdgeInsets.symmetric(horizontal: 16, vertical: 14),
                        ),
                      ),
                    ),

                    const SizedBox(height: 20),

             
                    const Text("Senha", style: TextStyle(fontSize: 16)),
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
                      child: const TextField(
                        obscureText: true,
                        decoration: InputDecoration(
                          hintText: "Senha...",
                          border: InputBorder.none,
                          contentPadding: EdgeInsets.symmetric(horizontal: 16, vertical: 14),
                        ),
                      ),
                    ),

                    const SizedBox(height: 30),

                  SizedBox(
                   width: double.infinity,
                    height: 48,
                    child: ElevatedButton(
                  onPressed: () {
                    Navigator.push(context,
                  MaterialPageRoute(builder: (context) => HomePage()),
                  );
                  },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Color.fromARGB(218, 96, 177, 11),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                ),
                child: const Text(
                  "Login",
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
                      child:  TextButton(
                        onPressed: () {
                          Navigator.push(
                          context,
                          MaterialPageRoute(builder: (context) => SignUpScreen())
                      ); 
                        },
                        child: const Text.rich(
                          TextSpan(
                            text: "Não tem uma conta? ",
                            children: [
                              TextSpan(text: "Cadastre-se",                                  
                                style: TextStyle(
                                    fontWeight: FontWeight.bold,
                                    color: Color.fromARGB(218, 96, 177, 11),
                                  )   
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
          ],
        ),
      ),
    );
  }
}
