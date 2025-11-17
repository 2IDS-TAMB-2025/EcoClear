import 'package:aplicativo_ecoclear/model/empresa.dart';
import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';
import '../controller/api_controller.dart';
import '../model/noticias.dart';
import 'grafico_home.dart';
import 'monitoramento.dart';
import 'perfil.dart';
import 'welcome_screen.dart';
import 'relatorio.dart';
import '../globals.dart' as globals;

class HomePage extends StatelessWidget {
  HomePage({super.key});

  final List catNames = [
    "Monitoramento",
    'Gráficos',
    'Relatórios',
  ];

  final List catPages = [
    RealtimeMonitoringPage(cnpjEmpresa: globals.cnpjUsuario!),
    GraficoHome(cnpjEmpresa: globals.cnpjUsuario!),
    Relatorios(),
  ];

  final List<Color> catColors = [
    const Color.fromRGBO(97, 132, 87, 1),
    const Color.fromRGBO(97, 132, 87, 1),
    const Color.fromRGBO(97, 132, 87, 1),
  ];

  final List<Icon> catIcons = [
    const Icon(Icons.category, color: Colors.white, size: 40),
    const Icon(Icons.table_chart_sharp, color: Colors.white, size: 38),
    const Icon(Icons.assignment, color: Colors.white, size: 38),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: ListView(
        children: [

          // TOPO
          Container(
            padding: const EdgeInsets.only(top: 20, left: 20, right: 20, bottom: 55),
            decoration: const BoxDecoration(
              color: Color.fromARGB(230, 73, 137, 5),
              borderRadius: BorderRadius.only(
                bottomLeft: Radius.circular(22),
                bottomRight: Radius.circular(22),
              ),
            ),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    GestureDetector(
                      onTap: () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(builder: (context) => const WelcomeScreen()),
                        );
                      },
                      child: const Icon(
                        Icons.arrow_back,
                        size: 32,
                        color: Colors.white,
                      ),
                    ),
                  ],
                ),

                const SizedBox(height: 35),

                FutureBuilder<List<Empresa>>(
                  future: ApiController.fetchEmpresaPeloCNPJ(
                      cnpj: globals.cnpjUsuario!),
                  builder: (context, snapshot) {
                    if (snapshot.connectionState == ConnectionState.waiting) {
                      return const Text(
                        "Olá, ...",
                        style: TextStyle(
                          fontSize: 26,
                          fontWeight: FontWeight.w600,
                          color: Colors.white,
                        ),
                      );
                    } else if (snapshot.hasError ||
                        !snapshot.hasData ||
                        snapshot.data!.isEmpty) {
                      return Text(
                        "Olá, ${globals.cnpjUsuario}",
                        style: const TextStyle(
                          fontSize: 26,
                          fontWeight: FontWeight.w600,
                          color: Colors.white,
                        ),
                      );
                    } else {
                      final empresa = snapshot.data!.first;
                      return Text(
                        "Olá, ${empresa.razao_social}",
                        style: const TextStyle(
                          fontSize: 26,
                          fontWeight: FontWeight.w600,
                          color: Colors.white,
                        ),
                      );
                    }
                  },
                ),
              ],
            ),
          ),

          // MENU DE CATEGORIAS
          Padding(
            padding: const EdgeInsets.only(top: 35, left: 20, right: 20),
            child: Column(
              children: [
                GridView.builder(
                  itemCount: catNames.length,
                  shrinkWrap: true,
                  physics: const NeverScrollableScrollPhysics(),
                  gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
                    crossAxisCount: 3,
                    childAspectRatio: 0.85,
                  ),
                  itemBuilder: (context, index) {
                    return Column(
                      children: [
                        Container(
                          height: 72,
                          width: 72,
                          decoration: BoxDecoration(
                            color: catColors[index],
                            shape: BoxShape.circle,
                          ),
                          child: Center(child: catIcons[index]),
                        ),
                        const SizedBox(height: 6),
                        TextButton(
                          onPressed: () {
                            Navigator.push(
                              context,
                              MaterialPageRoute(builder: (context) => catPages[index]),
                            );
                          },
                          child: Text(
                            catNames[index],
                            textAlign: TextAlign.center,
                            style: TextStyle(
                              fontSize: 13,
                              fontWeight: FontWeight.w500,
                              color: Colors.black.withOpacity(0.72),
                            ),
                          ),
                        )
                      ],
                    );
                  },
                ),

                const SizedBox(height: 25),

                const Row(
                  children: [
                    Text(
                      "Notícias",
                      style: TextStyle(
                        fontSize: 20,
                        fontWeight: FontWeight.w700,
                        color: Color.fromARGB(255, 69, 67, 67),
                      ),
                    ),
                  ],
                ),

                const SizedBox(height: 18),

                // 🔥 AQUI COMEÇA O TRECHO CORRIGIDO 🔥
                FutureBuilder<List<Noticias>>(
                  future: ApiController.fetchNoticias(),
                  builder: (context, snapshot) {
                    if (snapshot.connectionState == ConnectionState.waiting) {
                      return const Center(child: CircularProgressIndicator());
                    } else if (snapshot.hasError) {
                      return const Center(child: Text("Erro ao carregar notícias"));
                    } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
                      return const Center(child: Text("Nenhuma notícia disponível"));
                    }

                    final noticias = snapshot.data!;

                    return GridView.builder(
                      itemCount: noticias.length,
                      shrinkWrap: true,
                      physics: const NeverScrollableScrollPhysics(),
                      gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
                        crossAxisCount: 2,
                        childAspectRatio: 1.8, // 🔥 COMPACTO E SEM ESPAÇO EM BRANCO
                        mainAxisSpacing: 8,
                        crossAxisSpacing: 8,
                      ),
                      itemBuilder: (context, index) {
                        final noticia = noticias[index];

                        return Container(
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(12),
                            color: const Color(0xfff5f3ff),
                          ),
                          padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 6),
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.start,
                            mainAxisSize: MainAxisSize.max,
                            children: [
                              Text(
                                noticia.titulo,
                                textAlign: TextAlign.center,
                                maxLines: 3,
                                overflow: TextOverflow.ellipsis,
                                style: TextStyle(
                                  fontSize: 13,
                                  fontWeight: FontWeight.w600,
                                  color: Colors.black.withOpacity(0.78),
                                ),
                              ),

                              const SizedBox(height: 4),

                              GestureDetector(
                                onTap: () async {
                                  final url = noticia.link;
                                  if (await canLaunchUrl(Uri.parse(url))) {
                                    await launchUrl(
                                      Uri.parse(url),
                                      mode: LaunchMode.externalApplication,
                                    );
                                  }
                                },
                                child: const Text(
                                  "Ler mais",
                                  style: TextStyle(
                                    fontSize: 12,
                                    fontWeight: FontWeight.bold,
                                    color: Color.fromARGB(230, 73, 137, 5),
                                  ),
                                ),
                              ),
                            ],
                          ),
                        );
                      },
                    );
                  },
                ),
                // 🔥 FIM DO TRECHO CORRIGIDO 🔥
              ],
            ),
          ),
        ],
      ),

      // MENU INFERIOR
      bottomNavigationBar: BottomNavigationBar(
        showUnselectedLabels: true,
        iconSize: 32,
        selectedItemColor: const Color.fromRGBO(97, 132, 87, 1),
        selectedFontSize: 18,
        unselectedItemColor: Colors.grey,
        items: const [
          BottomNavigationBarItem(icon: Icon(Icons.home), label: 'Home'),
          BottomNavigationBarItem(icon: Icon(Icons.person), label: 'Perfil'),
        ],
        onTap: (index) {
          if (index == 0) {
            Navigator.push(context, MaterialPageRoute(builder: (context) => HomePage()));
          } else if (index == 1) {
            Navigator.push(context, MaterialPageRoute(builder: (context) => PerfilUsuario()));
          }
        },
      ),
    );
  }
}
