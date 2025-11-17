import 'package:aplicativo_ecoclear/controller/api_controller.dart';
import 'package:aplicativo_ecoclear/model/dadosSensor.dart';
import 'package:aplicativo_ecoclear/screens/home_screen.dart';
import 'package:flutter/material.dart';

class RealtimeMonitoringPage extends StatefulWidget {
  final String cnpjEmpresa;
  const RealtimeMonitoringPage({super.key, required this.cnpjEmpresa});

  @override
  _RealtimeTablePageState createState() => _RealtimeTablePageState();
}

class _RealtimeTablePageState extends State<RealtimeMonitoringPage> {
  List<DadosSensor> sensores = [];
  bool loading = true;

  @override
  void initState() {
    super.initState();
    fetchSensores();
  }

  Future<void> fetchSensores() async {
    setState(() => loading = true);
    try {
      final data = await ApiController.fetchDadosSensorCNPJ(
          cnpj: widget.cnpjEmpresa);
      setState(() {
        sensores = data;
        loading = false;
      });
    } catch (e) {
      print("Erro ao carregar sensores: $e");
      setState(() {
        sensores = [];
        loading = false;
      });
    }
  }

  Color getRowColor(String tipo, double valor) {
    switch (tipo) {
      case "Sensor de Temperatura":
        if (valor <= 26) return Color(0xFFA6E6A6);
        if (valor <= 30) return Color.fromARGB(255, 254, 230, 156);
        return Color(0xFFFF9999);
      case "Sensor de Umidade":
        if (valor <= 60) return Color.fromARGB(255, 173, 234, 173);
        if (valor <= 80) return Color(0xFFFFE599);
        return Color(0xFFFF9999);
      case "Sensor de Gás":
        if (valor <= 1000) return Color.fromARGB(255, 173, 234, 173);
        if (valor <= 3000) return Color(0xFFFFE599);
        return Color(0xFFFF9999);
      default:
        return Colors.grey[200]!;
    }
  }

  String getUnit(String tipo) {
    switch (tipo) {
      case "Sensor de Temperatura":
        return "°C";
      case "Sensor de Umidade":
        return "%";
      case "Sensor de Gás":
        return "ppm";
      default:
        return "";
    }
  }

  Icon getIcon(String tipo) {
    switch (tipo) {
      case "Sensor de Temperatura":
        return const Icon(Icons.thermostat, color: Color.fromARGB(243, 79, 78, 78));
      case "Sensor de Umidade":
        return const Icon(Icons.cloud, color: Color.fromARGB(243, 79, 78, 78));
      case "Sensor de Gás":
        return const Icon(Icons.air, color: Color.fromARGB(243, 79, 78, 78));
      default:
        return const Icon(Icons.device_unknown);
    }
  }

  @override
  Widget build(BuildContext context) {
    return DefaultTabController(
      length: 2,
      child: Scaffold(
        appBar: AppBar(
          title: const Text(
            'Monitoramento em Tempo Real',
            style: TextStyle(
              fontSize: 20, 
            ),
          ),
          backgroundColor: const Color.fromARGB(230, 73, 137, 5),
          foregroundColor: Colors.white,
          leading: IconButton(
            icon: const Icon(Icons.arrow_back),
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(builder: (context) => HomePage()),
              );
            },
          ),
          bottom: const TabBar(
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
            // Aba 1 — Controle
            loading
                ? const Center(child: CircularProgressIndicator())
                : sensores.isEmpty
                    ? Center(
                        child: Card(
                          color: Colors.orangeAccent,
                          child: Padding(
                            padding: const EdgeInsets.all(16.0),
                            child: Text(
                              "⚠️ Nenhum dado de sensor encontrado para este CNPJ.",
                              textAlign: TextAlign.center,
                              style: const TextStyle(
                                  fontSize: 16, fontWeight: FontWeight.bold),
                            ),
                          ),
                        ),
                      )
                    : RefreshIndicator(
                        onRefresh: fetchSensores,
                        child: ListView.builder(
                          padding: const EdgeInsets.only(top: 70, bottom: 16), // 🔥 AUMENTA A DISTÂNCIA
                          itemCount: sensores.length,
                          itemBuilder: (context, index) {
                            final sensor = sensores[index];
                            final nome = sensor.nome;
                            final tipo = sensor.tipo;
                            final valor = double.tryParse(sensor.dado) ?? 0.0;
                            final cor = getRowColor(tipo, valor);
                            final unidade = getUnit(tipo);
                            final icone = getIcon(tipo);

                            return Card(
                              color: cor,
                              margin: const EdgeInsets.symmetric(
                                  vertical: 18, horizontal: 24),
                              shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(16)),
                              child: Padding(
                                padding: const EdgeInsets.symmetric(
                                    vertical: 20, horizontal: 16),
                                child: Column(
                                  mainAxisSize: MainAxisSize.min,
                                  crossAxisAlignment: CrossAxisAlignment.center,
                                  children: [
                                    Row(
                                      mainAxisSize: MainAxisSize.min,
                                      mainAxisAlignment: MainAxisAlignment.center,
                                      children: [
                                        Icon(
                                          icone.icon,
                                          color: icone.color,
                                          size: 30, // ícone menor
                                        ),
                                        const SizedBox(width: 10),
                                        Text(
                                          nome,
                                          style: const TextStyle(
                                              fontWeight: FontWeight.bold,
                                              fontSize: 18),
                                        ),
                                      ],
                                    ),
                                    const SizedBox(height: 8),
                                    Text(
                                      "$tipo\nValor: $valor $unidade",
                                      textAlign: TextAlign.center,
                                      style: const TextStyle(fontSize: 15),
                                    ),
                                  ],
                                ),
                              ),
                            );
                          },
                        ),
                      ),

            // Aba 2 — Informações
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
                    const SizedBox(height: 10),
                    const Text(
                      'Embora não haja um padrão único para a temperatura do ar emitido por indústrias, é fundamental que as emissões térmicas não causem desconforto ou riscos à saúde dos trabalhadores e da comunidade próxima. As normas de conforto térmico recomendam que a temperatura em ambientes de trabalho seja mantida entre 20°C e 26°C. Temperaturas acima desse intervalo podem indicar uma situação de alerta, necessitando de ações corretivas para garantir a segurança e o bem-estar das pessoas.',
                      style: TextStyle(fontSize: 14, height: 1.5),
                    ),
                    const SizedBox(height: 25),
                    // Umidade
                    Center(
                      child: Text(
                        'Umidade',
                        style: TextStyle(
                          fontSize: 20,
                          fontWeight: FontWeight.bold,
                          backgroundColor: Colors.green.shade100,
                        ),
                      ),
                    ),
                    const SizedBox(height: 10),
                    const Text(
                      'A umidade relativa do ar é a quantidade de vapor de água presente na atmosfera em relação ao máximo que o ar pode reter na mesma temperatura. Níveis adequados de umidade são fundamentais para o conforto, saúde humana e conservação de materiais. Tanto a baixa quanto a alta umidade podem trazer riscos e desconfortos.',
                      style: TextStyle(fontSize: 14, height: 1.6),
                    ),
                    const SizedBox(height: 25),
                    const Text(
                      '• < 30%: Umidade baixa. Pode causar ressecamento da pele, irritação nos olhos, sangramento nasal, aumento da eletricidade estática e maior risco de infecções respiratórias.\n\n'
                      '• 30–60%: Faixa considerada ideal para a maioria dos ambientes internos. Proporciona conforto térmico, reduz riscos de alergias e mantém a integridade de móveis, equipamentos e estruturas.\n\n'
                      '• 60–80%: Umidade alta. Pode favorecer a proliferação de ácaros, fungos e mofos, além de causar sensação de abafamento e desconforto térmico.\n\n'
                      '• > 80%: Umidade excessiva. Eleva significativamente o risco de doenças respiratórias, proliferação de fungos e deterioração de materiais, exigindo ventilação ou desumidificação do ambiente.\n\n',
                      style: TextStyle(fontSize: 14, height: 1.6),
                    ),
                    const SizedBox(height: 25),
                    // Gases
                    Center(
                      child: Text(
                        'Gases',
                        style: TextStyle(
                          fontSize: 20,
                          fontWeight: FontWeight.bold,
                          backgroundColor: Colors.green.shade100,
                        ),
                      ),
                    ),
                    const SizedBox(height: 10),
                    const Text(
                      'A qualidade do ar refere-se à concentração de gases e poluentes presentes no ambiente. Em pequenas quantidades, esses gases não costumam ser prejudiciais, mas em ambientes fechados ou mal ventilados podem se acumular e se tornar perigosos. Entre os principais contaminantes monitorados estão: amônia (NH₃), dióxido de carbono (CO₂), monóxido de carbono (CO), óxidos de nitrogênio (NOₓ), benzeno, fumaça e compostos orgânicos voláteis (COVs).',
                      style: TextStyle(fontSize: 14, height: 1.6),
                    ),
                    const SizedBox(height: 25),
                    const Text(
                      '• 0 – 300 ppm: Qualidade do ar boa – ar limpo, sem riscos à saúde.\n\n'
                      '• 300 – 1.000 ppm: Qualidade do ar moderada – pode causar leve desconforto em pessoas mais sensíveis (crianças, idosos e pessoas com problemas respiratórios).\n\n'
                      '• 1.000 – 3.000 ppm: Qualidade do ar ruim – possível surgimento de dor de cabeça, fadiga, irritação nos olhos e desconforto respiratório.\n\n'
                      '• 3.000 – 10.000 ppm: Qualidade do ar muito ruim – risco de náuseas, tontura, sonolência e dificuldade de concentração.\n\n'
                      '• > 10.000 ppm: Qualidade do ar perigosa – exposição prolongada pode causar intoxicação severa, exigindo evacuação imediata e ventilação do ambiente.\n\n',
                      style: TextStyle(fontSize: 14, height: 1.6),
                    ),
                    const SizedBox(height: 25),
                    const Text(
                      'Contato e Suporte',
                      style: TextStyle(
                        fontSize: 18,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    const SizedBox(height: 10),
                    const Text(
                      'Para dúvidas, sugestões ou suporte técnico, entre em contato pelo e-mail: suporteecoclear@gmail.com.',
                      style: TextStyle(fontSize: 12, height: 1.5),
                    ),
                    const SizedBox(height: 25),
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
