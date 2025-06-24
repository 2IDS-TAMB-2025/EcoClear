import 'dart:async';
import 'dart:math';
import 'package:aplicativo_ecoclear/screens/home_screen.dart';
import 'package:flutter/material.dart';

class RealtimeMonitoringPage extends StatefulWidget {
  const RealtimeMonitoringPage({super.key});

  @override
  _RealtimeTablePageState createState() => _RealtimeTablePageState();
}

class _RealtimeTablePageState extends State<RealtimeMonitoringPage> {
  Map<String, double> sensorData = {
    'Temperatura': 25.0,
    'CO₂': 1000.0,
    'NO₂': 2.0,
    'SO₂': 4.0,
  };

  late Timer timer;

  @override
  void initState() {
    super.initState();
    timer = Timer.periodic(Duration(seconds: 5), (_) => _updateSensorData());
  }

  void _updateSensorData() {
    setState(() {
      sensorData['Temperatura'] = 20 + Random().nextDouble() * 10;
      sensorData['CO₂'] = 600 + Random().nextDouble() * 700;
      sensorData['NO₂'] = 1 + Random().nextDouble() * 2.5;
      sensorData['SO₂'] = 2 + Random().nextDouble() * 5;
    });
  }

  Icon _getIcon(String key) {
    switch (key) {
      case 'Temperatura':
        return Icon(Icons.thermostat, color: const Color.fromARGB(255, 79, 78, 78));
      case 'CO₂':
        return Icon(Icons.cloud, color: const Color.fromARGB(255, 79, 78, 78));
      case 'NO₂':
        return Icon(Icons.air, color: const Color.fromARGB(255, 79, 78, 78));
      case 'SO₂':
        return Icon(Icons.factory, color: const Color.fromARGB(255, 79, 78, 78));
      default:
        return Icon(Icons.device_unknown);
    }
  }

  String _getUnit(String key) {
    return key == 'Temperatura' ? '°C' : 'ppm';
  }

  Color _getRowColor(String key, double value) {
    switch (key) {
      case 'Temperatura':
        return value > 26 ? Colors.red.shade100 : Colors.green.shade100;
      case 'CO₂':
        return value > 1000 ? Colors.red.shade100 : Colors.green.shade100;
      case 'NO₂':
        return value > 2 ? Colors.red.shade100 : Colors.green.shade100;
      case 'SO₂':
        return value > 5 ? Colors.red.shade100 : Colors.green.shade100;
      default:
        return Colors.grey.shade200;
    }
  }

  @override
  void dispose() {
    timer.cancel();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return DefaultTabController(
      length: 2,
      child: Scaffold(
        appBar: AppBar(
          title: Text('Monitoramento em Tempo Real'),
          backgroundColor: Color.fromARGB(230, 73, 137, 5),
          foregroundColor: Colors.white,
          leading: IconButton(
            icon: Icon(Icons.arrow_back),
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(builder: (context) => HomePage()),
              );
            },
          ),
          bottom: TabBar(
            labelColor: Colors.white,
            unselectedLabelColor: Colors.white70,
            indicatorColor: Colors.white,
            tabs: [
              Tab(icon: Icon(Icons.thermostat), text: 'Controle'),
              Tab(icon: Icon(Icons.assignment), text: 'Informações e Dados'),
            ],
          ),
        ),
        body: TabBarView(
          children: [
            // Aba 1 
            Padding(
              padding: const EdgeInsets.all(70.0),
              child: Column(
                  children: sensorData.entries.map((entry) {
                    final key = entry.key;
                    final value = entry.value;
                    return Container(
                      width: double.infinity,
                      margin: EdgeInsets.only(bottom: 12),
                      padding: EdgeInsets.all(16),
                      decoration: BoxDecoration(
                        color: _getRowColor(key, value),
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Row(
                        children: [
                          _getIcon(key),
                          SizedBox(width: 16),
                          Expanded(
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Text(key, style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
                                SizedBox(height: 4),
                                Text('Valor: ${value.toStringAsFixed(1)} ${_getUnit(key)}'),
                                Text('Atualizado há: 5s', style: TextStyle(color: Colors.grey[700])),
                              ],
                            ),
                          ),
                        ],
                      ),
                    );
                  }).toList(),
                ),
            ),

            // Aba 2 - Informações
            Padding(
              padding: const EdgeInsets.all(26.0),
              child: SingleChildScrollView(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Center(
                        child: Text(
                          'Temperatura Emanada por Indústrias',
                          style: TextStyle(
                            fontSize: 20, 
                            fontWeight: FontWeight.bold, 
                            backgroundColor: Colors.green.shade100,
                          ),
                        ),
                      ),
                    SizedBox(height: 10),
                    Text(
                      'Embora não haja um padrão único para a temperatura do ar emitido por indústrias, é fundamental que as emissões térmicas não causem desconforto ou riscos à saúde dos trabalhadores e da comunidade próxima. As normas de conforto térmico recomendam que a temperatura em ambientes de trabalho seja mantida entre 20°C e 26°C. Temperaturas acima desse intervalo podem indicar uma situação de alerta, necessitando de ações corretivas para garantir a segurança e o bem-estar das pessoas.',
                      style: TextStyle(fontSize: 14, height: 1.5),
                    ),
                    SizedBox(height: 25),


                    //carbono

                    Center(
                        child: Text(
                          'Dióxido de Carbono (CO₂)',
                          style: TextStyle(
                            fontSize: 20, 
                            fontWeight: FontWeight.bold, 
                            backgroundColor: Colors.green.shade100,
                          ),
                        ),
                      ),
                    
                    SizedBox(height: 10),
                    Text(
                      'O dióxido de carbono (CO₂) é um gás incolor e inodoro, amplamente presente no ambiente e gerado em diversos processos industriais (como fermentação, combustão e respiração humana). Embora não seja tóxico em pequenas quantidades, pode se tornar perigoso em ambientes fechados e mal ventilados.',
                      style: TextStyle(fontSize: 14, height: 1.6),
                    ),
                    SizedBox(height: 25),
                    Text(
                      '• 400–1.000 ppm: Faixa segura, comum em ambientes bem ventilados, sem riscos à saúde.\n\n'
                      '• 1.000–30.000 ppm: Indica ventilação deficiente e riscos à saúde — sonolência e fadiga já aparecem em 1.000–2.000 ppm; 3.900 ppm é o limite NR 15 para 48 h/semana; acima de 5.000 ppm surgem dor de cabeça e tontura; e em 30.000 ppm ocorrem náuseas, taquicardia e desorientação.\n\n'
                      '• > 50.000 ppm: Considerado IDLH (Perigo Imediato à Vida e à Saúde), níveis acima de 50.000 ppm podem causar perda de consciência, colapso respiratório e morte, exigindo evacuação imediata e uso de proteção respiratória autônoma.',
                      style: TextStyle(fontSize: 14, height: 1.6),
                    ),
                    SizedBox(height: 25),



                  //Outro


                  Center(
                        child: Text(
                          'Dióxido de Nitrogênio (NO₂)',
                          style: TextStyle(
                            fontSize: 20, 
                            fontWeight: FontWeight.bold, 
                            backgroundColor: Colors.green.shade100,
                          ),
                        ),
                      ),
                    SizedBox(height: 10),
                    Text(
                      '​O dióxido de nitrogênio (NO₂) é um gás tóxico, de coloração castanho-avermelhada e odor acre, resultante principalmente da queima de combustíveis fósseis, como em motores a diesel e processos industriais. Sua exposição pode causar sérios efeitos à saúde humana, especialmente no sistema respiratório.',
                      style: TextStyle(fontSize: 14, height: 1.6),
                    ),
                    SizedBox(height: 25),
                    Text(
                      '• 0,2–1 ppm: Faixa segura segundo a NR 15. O NO₂ pode ser percebido pelo odor a partir de 0,2 ppm, mas até 1 ppm não causa efeitos significativos à saúde, exceto leve irritação em pessoas mais sensíveis.\n\n'
                      '• 1–5 ppm: Concentrações entre 1 e 5 ppm indicam ventilação inadequada e risco crescente à saúde. A partir de 1 ppm, recomenda-se melhorar a ventilação. Em 5 ppm, a exposição contínua pode causar irritação nasal, tosse e desconforto respiratório com exposição prolongada.\n\n'
                      '• 5–20 ppm: Concentrações acima de 5 ppm já podem causar irritação intensa nos olhos e sistema respiratório. Em 20 ppm, atinge o limite de Perigo Imediato à Vida e à Saúde, com risco de edema pulmonar, bronquite aguda, dificuldade respiratória severa, e até colapso respiratório e morte. Exposições desse valor exigem evacuação imediata e uso de proteção respiratória autônoma.',
                      style: TextStyle(fontSize: 14, height: 1.6),
                    ),
                    SizedBox(height: 25),


                    //Outro


                  Center(
                        child: Text(
                          'Dióxido de Enxofre (SO₂)',
                          style: TextStyle(
                            fontSize: 20, 
                            fontWeight: FontWeight.bold, 
                            backgroundColor: Colors.green.shade100,
                          ),
                        ),
                      ),
                    SizedBox(height: 10),
                    Text(
                      'O SO₂ é um gás incolor, de odor pungente e altamente irritante, especialmente para o sistema respiratório. É comumente emitido em processos industriais, especialmente em combustão de combustíveis fósseis e na produção de ácido sulfúrico.',
                      style: TextStyle(fontSize: 14, height: 1.6),
                    ),
                    SizedBox(height: 25),
                    Text(
                      '• 2-5 ppm: Concentrações de até 2 ppm estão dentro do limite da NR 15 para jornadas de 48h semanais no Brasil. Até 5 ppm, conforme a OSHA, ainda são consideradas seguras para exposição contínua de 8 horas, embora acima desse valor já se recomende ações corretivas para evitar riscos à saúde.\n\n'
                      '• 5-20 ppm: Pode ocorrer tosse intensa, broncoespasmo, desconforto respiratório e agravamento de condições pulmonares preexistentes. Acima de 20 ppm, a exposição intensa pode causar danos pulmonares graves, como bronquite química aguda.\n\n'
                      '• 100 ppm – Classificado como IDLH (Immediately Dangerous to Life or Health), com risco real de edema pulmonar, colapso respiratório e morte em exposições curtas. Nessas condições, é obrigatório o uso de proteção respiratória autônoma e evacuação imediata da área.',
                      style: TextStyle(fontSize: 14, height: 1.6),
                    ),
                    SizedBox(height: 25),

                    Text(
                      'Contato e Suporte',
                      style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                    ),
                    SizedBox(height: 10),
                    Text(
                      'Para dúvidas, sugestões ou suporte técnico, entre em contato pelo e-mail: suporteecoclear@gmail.com.',
                      style: TextStyle(fontSize: 12, height: 1.5),
                    ),
                    SizedBox(height: 25),
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
