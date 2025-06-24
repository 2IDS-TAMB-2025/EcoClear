import 'package:aplicativo_ecoclear/screens/grafico_home.dart';
import 'package:aplicativo_ecoclear/screens/monitoramento.dart';
import 'package:aplicativo_ecoclear/screens/perfil.dart';
import 'package:aplicativo_ecoclear/screens/welcome_screen.dart';
import 'package:flutter/material.dart';
import 'package:aplicativo_ecoclear/screens/relatorio.dart';
import 'package:url_launcher/url_launcher.dart';

class HomePage extends StatelessWidget {
  final List catNames = [
    "Monitoramento",
    'Gráficos',
    'Relatórios',
  ];

  final List catPages = [
    RealtimeMonitoringPage(),
    GraficoHome(),
    Relatorios()
  ];

  final List<Color> catColors = [
    Color.fromRGBO(97, 132, 87, 1),
    Color.fromRGBO(97, 132, 87, 1),
    Color.fromRGBO(97, 132, 87, 1),
  ];

  final List<Icon> catIcons = [
    Icon(Icons.category, color: Colors.white, size: 30),
    Icon(Icons.table_chart_sharp, color: Colors.white, size: 30),
    Icon(Icons.assignment, color: Colors.white, size: 30),
  ];

  final List imgList = [
    'image1',
    'image2',
    'image3',
    'image4',
  ];

  final List noticias = [
    'Moradores reclamam de poluição causada por indústria de fundição de ferro, em Ponta Grossa',
    'Siderúrgica parou de divulgar níveis de emissão de poluente nocivo à saúde',
    'Duas empresa brasileiras emitem mais gases poluentes do que o país inteiro',
    'Estudo: 57 empresas respondem por 80% da poluição de dióxido de carbono do mundo',
  ];

  final List<String> noticiaLinks = [
    'https://g1.globo.com/pr/campos-gerais-sul/noticia/2019/04/05/moradores-reclamam-de-poluicao-causada-por-industria-de-fundicao-de-ferro-em-ponta-grossa.ghtml',
    'https://g1.globo.com/rj/rio-de-janeiro/noticia/2024/09/23/siderurgica-citada-por-poluicao-devastadora-em-santa-cruz-tem-falha-na-divulgacao-niveis-de-emissao-de-poluente-nocivo-a-saude.ghtml',
    'https://gauchazh.clicrbs.com.br/ambiente/noticia/2022/11/duas-empresas-brasileiras-emitem-mais-gases-poluentes-do-que-paises-inteiros-aponta-relatorio-internacional-clas83eba000a0170zvzye26w.html',
    'https://veja.abril.com.br/agenda-verde/estudo-aponta-que-57-empresas-sao-responsaveis-por-80-da-poluicao-de-dioxido-de-carbono-no-mundo/',
  ];

  HomePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: ListView(
        children: [
          Container(
            padding: EdgeInsets.only(top: 15, left: 15, right: 15, bottom: 10),
            decoration: BoxDecoration(
              color: Color.fromARGB(230, 73, 137, 5),
              borderRadius: BorderRadius.only(
                bottomLeft: Radius.circular(20),
                bottomRight: Radius.circular(20),
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
                      child: Icon(
                        Icons.arrow_back,
                        size: 30,
                        color: Colors.white,
                      ),
                    ),
                    Icon(
                      Icons.notifications,
                      size: 30,
                      color: Colors.white,
                    ),
                  ],
                ),
                SizedBox(height: 20),
                Padding(
                  padding: EdgeInsets.only(left: 3, bottom: 15),
                  child: Text(
                    "Olá, ......",
                    style: TextStyle(
                      fontSize: 25,
                      fontWeight: FontWeight.w600,
                      letterSpacing: 1,
                      wordSpacing: 2,
                      color: Colors.white,
                    ),
                  ),
                ),
                Container(
                  margin: EdgeInsets.only(top: 10, left: 15, right: 15, bottom: 25),
                  width: MediaQuery.of(context).size.width,
                  height: 55,
                  alignment: Alignment.center,
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: TextField(
                    decoration: InputDecoration(
                      border: InputBorder.none,
                      hintText: "Pesquisar...",
                      hintStyle: TextStyle(
                        color: Colors.black.withOpacity(0.5),
                      ),
                      prefixIcon: Icon(
                        Icons.search,
                        size: 25,
                      ),
                    ),
                  ),
                ),
              ],
            ),
          ),
          Padding(
            padding: EdgeInsets.only(top: 40, left: 15, right: 15),
            child: Column(
              children: [
                GridView.builder(
                  itemCount: catNames.length,
                  shrinkWrap: true,
                  physics: NeverScrollableScrollPhysics(),
                  gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                    crossAxisCount: 3,
                    childAspectRatio: 1.1,
                  ),
                  itemBuilder: (context, index) {
                    return Column(
                      children: [
                        Container(
                          height: 60,
                          width: 60,
                          decoration: BoxDecoration(
                            color: catColors[index],
                            shape: BoxShape.circle,
                          ),
                          child: Center(
                            child: catIcons[index],
                          ),
                        ),
                        SizedBox(height: 10),
                        TextButton(
                          onPressed: () {
                            Navigator.push(
                              context,
                              MaterialPageRoute(builder: (context) => catPages[index]),
                            );
                          },
                          child: Text(
                            catNames[index],
                            style: TextStyle(
                              fontSize: 16,
                              fontWeight: FontWeight.w500,
                              color: Colors.black.withOpacity(0.7),
                            ),
                          ),
                        )
                      ],
                    );
                  },
                ),
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text(
                      "Notícias",
                      style: TextStyle(
                        fontSize: 18,
                        fontWeight: FontWeight.w600,
                        color: const Color.fromARGB(255, 69, 67, 67),
                      ),
                    ),
                  ],
                ),
                 SizedBox(height: 20),
                GridView.builder(
                  itemCount: imgList.length,
                  shrinkWrap: true,
                  physics: NeverScrollableScrollPhysics(),
                  gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                    crossAxisCount: 2,
                    childAspectRatio:
                        (MediaQuery.of(context).size.height - 50 - 25) / (4 * 240),
                    mainAxisSpacing: 10,
                    crossAxisSpacing: 10,
                  ),
                  itemBuilder: (context, index) {
                    return InkWell(
                      onTap: () {},
                      child: Container(
                        padding: EdgeInsets.all(0),
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(20),
                          color: Color(0xfff5f3ff),
                        ),
                        child: Column(
                          children: [
                            Padding(
                              padding: EdgeInsets.all(10),
                              child: Image.asset(
                                "assets/imagens/${imgList[index]}.png",
                                width: 700,
                              ),
                            ),
                            SizedBox(height: 10),
                            Text(
                              noticias[index],
                              textAlign: TextAlign.center,
                              style: TextStyle(
                                fontSize: 18,
                                fontWeight: FontWeight.w500,
                                color: Colors.black.withOpacity(0.6),
                              ),
                            ),
                            SizedBox(height: 10),
                            GestureDetector(
                              onTap: () async {
                                final url = noticiaLinks[index];
                                if (await canLaunchUrl(Uri.parse(url))) {
                                  await launchUrl(Uri.parse(url), mode: LaunchMode.externalApplication);
                                } else {
                                  throw 'Não foi possível abrir o link: $url';
                                }
                              },
                              child: Text(
                                "Ler mais",
                                style: TextStyle(
                                  fontSize: 14,
                                  fontWeight: FontWeight.w500,
                                   color: Color.fromARGB(230, 73, 137, 5),
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                    );
                  },
                ),
              ],
            ),
          ),
        ],
      ),
      bottomNavigationBar: BottomNavigationBar(
        showUnselectedLabels: true,
        iconSize: 32,
        selectedItemColor: Color.fromRGBO(97, 132, 87, 1),
        selectedFontSize: 18,
        unselectedItemColor: Colors.grey,
        items: [
          BottomNavigationBarItem(icon: Icon(Icons.home), label: 'Home'),
          BottomNavigationBarItem(icon: Icon(Icons.person), label: 'Perfil'),
        ],
        onTap: (index) {
          if (index == 0) {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => HomePage()),
            );
          } else if (index == 1) {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => PerfilUsuario()),
            );
          }
        },
      ),
    );
  }
}