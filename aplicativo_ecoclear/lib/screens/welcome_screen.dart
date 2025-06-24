import 'package:aplicativo_ecoclear/screens/login.dart';
import 'package:flutter/material.dart';

class WelcomeScreen extends StatelessWidget{
  const WelcomeScreen({super.key});

  @override
  Widget build(BuildContext context){
    return Material(
      child: SizedBox(
        width: MediaQuery.of(context).size.width,
        height: MediaQuery.of(context).size.height,
        child: Stack(
          children:[
            Stack(children:[
              Container(
                width: MediaQuery.of(context).size.width,
                height: MediaQuery.of(context).size.height/ 1.6,
                decoration: BoxDecoration(
                  color:Colors.white,
                ),
              ),
              Container(
                width: MediaQuery.of(context).size.width,
                height: MediaQuery.of(context).size.height/ 1.6,
                decoration: BoxDecoration(
                  color:const Color.fromARGB(255, 148, 143, 143),
                  borderRadius: 
                  BorderRadius.only(bottomRight: Radius.circular(70)),
                ),
                child: Center(
                  child: Image.asset(
                    "assets/imagens/BioClear.png", 
                    scale:0.8,),
                ), 
              ),
            ],
            ),
            Align(
          alignment: Alignment.bottomCenter,
          child: Container(
            width: MediaQuery.of(context).size.width,
            height: MediaQuery.of(context).size.height / 2.800,
            padding: EdgeInsets.only(top: 20, bottom:15),
            decoration:BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.only(topLeft: Radius.circular(70),
              ),
            ),
            child: Column(
              children:[
                Text(
                  "Seja Bem-vindo ao EcoClear! ",
                  style:TextStyle(
                    fontSize: 25,
                    fontWeight: FontWeight.w600,
                    letterSpacing: 1,
                    wordSpacing: 2,
                  )
                ),
                SizedBox (height:15),
                Padding(
                  padding:EdgeInsets.symmetric(horizontal: 10),
                  child: Text("Aplicativo para monitorar e alertar sobre os níveis de poluição gerados pelas empresas, contribuindo para a fiscalização ambiental!", 
                  textAlign:TextAlign.center,
                  style:TextStyle(
                    fontSize: 17,
                    color: Colors.black.withOpacity(0.6),
                  ),
                  ),
                ),
                SizedBox(height: 25),
                Material(
                  color: Color.fromARGB(218, 96, 177, 11),
                  borderRadius: BorderRadius.circular(10),
                  child:InkWell(
                    onTap: (){
                      Navigator.push(
                        context,
                        MaterialPageRoute(builder: (context) => Login()),
                      );
                    },
                    child: Container(
                      padding: EdgeInsets.symmetric(
                        vertical: 15, horizontal:80),
                      child: Text(
                        "Entrar",
                        style: TextStyle(
                          color: Colors.white,
                          fontSize:22,
                          fontWeight: FontWeight.bold,
                          letterSpacing: 1,
                        ),
                      ),
                      ),
                    ),
                  ),
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