import 'dart:math'; // NECESSÁRIO PARA min/max
import 'package:aplicativo_ecoclear/controller/api_controller.dart';
import 'package:aplicativo_ecoclear/model/dadosSensor.dart';
import 'package:aplicativo_ecoclear/screens/home_screen.dart';
import 'package:flutter/material.dart';
import 'package:fl_chart/fl_chart.dart';

class GraficoHome extends StatelessWidget {
  final String cnpjEmpresa;
  const GraficoHome({super.key, required this.cnpjEmpresa});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: GraficoHomePage(cnpjEmpresa: cnpjEmpresa),
    );
  }
}

class GraficoHomePage extends StatefulWidget {
  final String cnpjEmpresa;
  const GraficoHomePage({super.key, required this.cnpjEmpresa});

  @override
  State<GraficoHomePage> createState() => _GraficoHomePageState();
}

class _GraficoHomePageState extends State<GraficoHomePage> {
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
      // Chama a função da API para buscar os dados.
      final data =
          await ApiController.fetchTodosDadosSensorCNPJ(cnpj: widget.cnpjEmpresa);
      setState(() {
        sensores = data;
        loading = false;
      });
    } catch (e) {
      // Em caso de erro, apenas loga e seta o estado para vazio/não carregando.
      print("Erro ao carregar sensores: $e");
      setState(() {
        sensores = [];
        loading = false;
      });
    }
  }

  // --- FUNÇÕES AUXILIARES PARA EIXO Y DINÂMICO ---

  // Função auxiliar para obter o valor MÍNIMO do eixo Y
  double _getMinY(List<FlSpot> spots, {double margin = 0.05}) {
    if (spots.isEmpty) return 0;
    // Calcula o mínimo e subtrai uma margem
    final minVal = spots.map((spot) => spot.y).reduce(min);
    return max(0, minVal - (minVal * margin)); // Garante que não é negativo
  }

  // Função auxiliar para obter o valor MÁXIMO do eixo Y
  double _getMaxY(List<FlSpot> spots, {double margin = 0.05}) {
    if (spots.isEmpty) return 1;
    // Calcula o máximo e adiciona uma margem
    final maxVal = spots.map((spot) => spot.y).reduce(max);
    return maxVal + (maxVal * margin);
  }

  @override
  Widget build(BuildContext context) {
    // -----------------------------------------------------------------
    // 1. LÓGICA DO GRÁFICO DE TEMPERATURA (ABA 1)
    // -----------------------------------------------------------------
    final tempSensores = sensores
        .where((s) => s.tipo == "Sensor de Temperatura")
        .toList()
      ..sort((a, b) => a.data_hora.compareTo(b.data_hora));

    final List<FlSpot> tempSpots = tempSensores.asMap().entries.map((entry) {
      final index = entry.key.toDouble();
      final sensor = entry.value;
      final y = double.tryParse(sensor.dado) ?? 0;
      return FlSpot(index, y);
    }).toList();

    // Eixos dinâmicos de temperatura
    final tempMinY = _getMinY(tempSpots, margin: 0.1); // Margem de 10%
    final tempMaxY = _getMaxY(tempSpots, margin: 0.1); // Margem de 10%
    final tempYInterval = 1.0; // Intervalo fixo de 1 grau

    // -----------------------------------------------------------------
    // 2. LÓGICA DO GRÁFICO DE GASES (ABA 2) - CORREÇÃO AQUI
    // -----------------------------------------------------------------
    final gasSensores = sensores
        // MUDANÇA: "Sensor de Gases" (plural) para "Sensor de Gás" (singular)
        .where((s) => s.tipo == "Sensor de Gás") 
        .toList()
      ..sort((a, b) => a.data_hora.compareTo(b.data_hora));

    final List<FlSpot> gasSpots = gasSensores.asMap().entries.map((entry) {
      final index = entry.key.toDouble();
      final sensor = entry.value;
      // O dado da API para Gás está como '1200' (ppm), que equivale a 1.200
      // Se '1200' significa 1.200 ppm, e o gráfico mostra 1.200, a conversão para double deve usar o valor '1200' direto
      // ou se '1200' é na verdade 1.200 *partes por milhão*, e o eixo é em 'ppm', está correto usar o valor inteiro.
      // Se o valor for 1.200, e o gráfico mostrar 1.200, usamos o valor do dado.
      // Se o dado for '1200' mas o gráfico mostra '1.200', a conversão é necessária (ex: '1200' / 1000)
      // Baseado na sua imagem, o valor '1.200' é usado no eixo. Vamos assumir que '1200' significa 1.200 ppm.
      final y = double.tryParse(sensor.dado) ?? 0;
      // O gráfico da imagem parece estar plotando em valores de '1.200'. Se o 'dado' da API for '1200' e o desejado no eixo é '1.200',
      // o dado deve ser dividido por 1000 para refletir o formato do eixo: 1.200, 1.220, etc.
      // NO ENTANTO, para manter a consistência da sua API (que manda '1200' e seu gráfico renderiza '1.200'), 
      // vou *assumir* que você tem um passo de conversão do valor Y
      // Se a intenção é mostrar 1.200 ppm, e o dado é '1200', não há conversão.
      // Se a intenção é mostrar no formato '1.200', '1.220' etc (como na imagem), o dado deve ser formatado.
      // Pelo eixo do seu gráfico na imagem, o valor '1200' (da API) corresponde ao '1.200' no eixo Y.
      // Portando, a divisão por 1000 é necessária para a escala.
      final scaledY = (double.tryParse(sensor.dado) ?? 0) / 1000.0;
      return FlSpot(index, scaledY);
    }).toList();

    // Eixos dinâmicos de gases
    final gasMinY = _getMinY(gasSpots, margin: 0.05); // Margem de 5%
    final gasMaxY = _getMaxY(gasSpots, margin: 0.05); // Margem de 5%
    // Intervalo de Y do seu exemplo (ex: 0.020)
    final gasYInterval = 0.020; // Ajuste se necessário

    // -----------------------------------------------------------------
    // 3. WIDGET DE BUILD
    // -----------------------------------------------------------------
    return DefaultTabController(
      length: 2,
      child: Scaffold(
        appBar: AppBar(
          backgroundColor: const Color.fromARGB(230, 73, 137, 5),
          foregroundColor: Colors.white,
          leading: IconButton(
            icon: const Icon(Icons.arrow_back),
            onPressed: () {
              // É melhor usar pop se esta tela foi "empurrada"
              if (Navigator.canPop(context)) {
                Navigator.pop(context);
              } else {
                // Caso não possa "popar", usa o push (seu código original)
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => HomePage()),
                );
              }
            },
          ),
          title: const Text('Visualizar Gráficos'),
          bottom: const TabBar(
            labelColor: Colors.white,
            unselectedLabelColor: Colors.white70,
            indicatorColor: Colors.white,
            tabs: [
              Tab(icon: Icon(Icons.thermostat), text: 'Temperatura'),
              Tab(icon: Icon(Icons.assignment), text: 'Emissão de Gases'),
            ],
          ),
        ),
        body: TabBarView(
          children: [
            // -------------------------------------------------------
            // ABA 1 — GRÁFICO DE TEMPERATURA 
            // -------------------------------------------------------
            loading
                ? const Center(child: CircularProgressIndicator())
                : tempSensores.isEmpty
                    ? const Center(child: Text("⚠️ Nenhum dado de temperatura"))
                    : SingleChildScrollView(
                        padding: const EdgeInsets.all(16.0),
                        child: Column(
                          children: [
                            SizedBox(
                              height: 250,
                              child: Column(
                                children: [
                                  Container(
                                    margin: const EdgeInsets.only(bottom: 8),
                                    padding: const EdgeInsets.symmetric(
                                        horizontal: 10, vertical: 5),
                                  ),
                                  // Gráfico de Linha/Área
                                  Expanded(
                                    child: Container(
                                      padding: const EdgeInsets.only(
                                        right: 10,
                                        top: 10,
                                        bottom: 10,
                                      ), // Espaçamento
                                      decoration: const BoxDecoration(
                                        color: Color.fromARGB(
                                            252, 253, 246, 249),
                                      ),
                                      child: LineChart(
                                        LineChartData(
                                          minY: tempMinY, // DINÂMICO
                                          maxY: tempMaxY, // DINÂMICO
                                          minX: 0,
                                          maxX: tempSpots.isEmpty
                                              ? 1
                                              : tempSpots.last.x,
                                          
                                          borderData:
                                              FlBorderData(show: false),
                                          
                                          gridData: FlGridData(
                                            show: true,
                                            drawVerticalLine: false,
                                            getDrawingHorizontalLine: (value) {
                                              return const FlLine(
                                                color: Color(0xffE0E0E0),
                                                strokeWidth: 1,
                                              );
                                            },
                                            horizontalInterval:
                                                tempYInterval, // DINÂMICO
                                          ),

                                          titlesData: FlTitlesData(
                                            topTitles: const AxisTitles(
                                                sideTitles: SideTitles(
                                                    showTitles: false)),
                                            rightTitles: const AxisTitles(
                                                sideTitles: SideTitles(
                                                    showTitles: false)),
                                            
                                            // Eixo Y
                                            leftTitles: AxisTitles(
                                              sideTitles: SideTitles(
                                                showTitles: true,
                                                interval:
                                                    tempYInterval, // DINÂMICO
                                                reservedSize: 30,
                                                getTitlesWidget:
                                                    (value, meta) {
                                                  // Mostra apenas inteiros
                                                  if (value != value.toInt()) {
                                                    return const Text('');
                                                  }
                                                  return Text(
                                                    value.toInt().toString(),
                                                    style: const TextStyle(
                                                        fontSize: 10),
                                                  );
                                                },
                                              ),
                                            ),
                                            
                                            // Eixo X
                                            bottomTitles: AxisTitles(
                                              sideTitles: SideTitles(
                                                showTitles: true,
                                                reservedSize: 20,
                                                interval: 1,
                                                getTitlesWidget:
                                                    (value, meta) {
                                                  final index = value.toInt();
                                                  if (tempSensores.isEmpty)
                                                    return const Text('');

                                                  if (index == 0 ||
                                                      index ==
                                                          tempSensores.length -
                                                              1) {
                                                    return Text(
                                                      tempSensores[index].nome,
                                                      style: const TextStyle(
                                                          fontSize: 10),
                                                    );
                                                  }
                                                  return const Text('');
                                                },
                                              ),
                                            ),
                                          ),
                                          lineBarsData: [
                                            LineChartBarData(
                                              spots: tempSpots,
                                              isCurved: false,
                                              color: const Color(0xff57C457),
                                              barWidth: 2,
                                              
                                              belowBarData: BarAreaData(
                                                show: true,
                                                color: const Color(0xffD9F3D0)
                                                    .withOpacity(0.9),
                                              ),

                                              dotData: FlDotData(
                                                show: true,
                                                getDotPainter: (spot, percent,
                                                    barData, index) {
                                                  if (index == 0 ||
                                                      index ==
                                                          tempSensores.length -
                                                              1) {
                                                    return FlDotCirclePainter(
                                                      radius: 4,
                                                      color: const Color(
                                                          0xff57C457),
                                                      strokeWidth: 0,
                                                    );
                                                  }
                                                  return FlDotCirclePainter(
                                                      radius: 0);
                                                },
                                              ),
                                            ),
                                          ],
                                        ),
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                            ),
                            
                            const SizedBox(height: 20),

                            // Tabela com os dados
                            DataTable(
                              columns: const [
                                DataColumn(label: Text('Sensor')),
                                DataColumn(label: Text('Valor')),
                                DataColumn(label: Text('Data/Hora')),
                              ],
                              rows: tempSensores
                                  .map(
                                    (sensor) => DataRow(cells: [
                                      DataCell(Text(sensor.nome)),
                                      DataCell(Text(sensor.dado)),
                                      DataCell(Text(sensor.data_hora)),
                                    ]),
                                  )
                                  .toList(),
                            ),
                          ],
                        ),
                      ),

            // -------------------------------------------------------
            // ABA 2 — GRÁFICO DE GASES (CORRIGIDO)
            // -------------------------------------------------------
            loading
                ? const Center(child: CircularProgressIndicator())
                : gasSensores.isEmpty
                    ? const Center(
                        child: Text("⚠️ Nenhum dado de gases"))
                    : SingleChildScrollView(
                        padding: const EdgeInsets.all(16.0),
                        child: Column(
                          children: [
                            SizedBox(
                              height: 250,
                              child: Column(
                                children: [
                                  // Legenda (adaptada da sua imagem)
                                  Container(
                                    margin: const EdgeInsets.only(bottom: 8),
                                    padding: const EdgeInsets.symmetric(
                                        horizontal: 10, vertical: 5)
                                  ),
                                  // Gráfico de Linha/Área
                                  Expanded(
                                    child: Container(
                                      padding: const EdgeInsets.only(
                                        right: 10,
                                        top: 10,
                                        bottom: 10,
                                      ), // Espaçamento
                                      decoration: const BoxDecoration(
                                        color: Color.fromARGB(
                                            252, 253, 246, 249), // Fundo
                                      ),
                                      child: LineChart(
                                        LineChartData(
                                          // Eixos dinâmicos
                                          minY: gasMinY,
                                          maxY: gasMaxY,
                                          minX: 0,
                                          maxX: gasSpots.isEmpty
                                              ? 1
                                              : gasSpots.last.x,
                                          
                                          borderData:
                                              FlBorderData(show: false),
                                          
                                          gridData: FlGridData(
                                            show: true,
                                            drawVerticalLine: false,
                                            getDrawingHorizontalLine: (value) {
                                              return const FlLine(
                                                color: Color(0xffE0E0E0),
                                                strokeWidth: 1,
                                              );
                                            },
                                            horizontalInterval:
                                                gasYInterval, // CORRIGIDO
                                          ),

                                          titlesData: FlTitlesData(
                                            topTitles: const AxisTitles(
                                                sideTitles: SideTitles(
                                                    showTitles: false)),
                                            rightTitles: const AxisTitles(
                                                sideTitles: SideTitles(
                                                    showTitles: false)),
                                            
                                            // Eixo Y (Gases ppm)
                                            leftTitles: AxisTitles(
                                              sideTitles: SideTitles(
                                                showTitles: true,
                                                interval:
                                                    gasYInterval, // CORRIGIDO
                                                reservedSize:
                                                    40, // Espaço para decimais
                                                getTitlesWidget:
                                                    (value, meta) {
                                                  // Formata para 3 casas decimais (como na imagem)
                                                  final text = value
                                                      .toStringAsFixed(3);
                                                  return Text(
                                                    text,
                                                    style: const TextStyle(
                                                        fontSize: 10),
                                                  );
                                                },
                                              ),
                                            ),
                                            
                                            // Eixo X
                                            bottomTitles: AxisTitles(
                                              sideTitles: SideTitles(
                                                showTitles: true,
                                                reservedSize: 20,
                                                interval: 1,
                                                getTitlesWidget:
                                                    (value, meta) {
                                                  final index = value.toInt();
                                                  if (gasSensores.isEmpty)
                                                    return const Text('');

                                                  // Lógica para mostrar primeiro e último
                                                  if (index == 0 ||
                                                      index ==
                                                          gasSensores.length -
                                                              1) {
                                                    return Text(
                                                      gasSensores[index]
                                                          .nome, // CORRIGIDO
                                                      style: const TextStyle(
                                                          fontSize: 10),
                                                    );
                                                  }
                                                  return const Text('');
                                                },
                                              ),
                                            ),
                                          ),
                                          lineBarsData: [
                                            LineChartBarData(
                                              spots: gasSpots, // CORRIGIDO
                                              isCurved: false,
                                              color: const Color(
                                                  0xffe91e63), // Rosa/Vermelho
                                              barWidth: 2,
                                              
                                              // Preenchimento de Área
                                              belowBarData: BarAreaData(
                                                show: true,
                                                color: const Color(0xfff8bbd0)
                                                    .withOpacity(
                                                        0.9), // Rosa claro
                                              ),

                                              // Configuração dos Pontos
                                              dotData: FlDotData(
                                                show: true,
                                                getDotPainter: (spot, percent,
                                                    barData, index) {
                                                  // Mostrar o ponto apenas no primeiro e último
                                                  if (index == 0 ||
                                                      index ==
                                                          gasSensores.length -
                                                              1) {
                                                    return FlDotCirclePainter(
                                                      radius: 4,
                                                      color: const Color(
                                                          0xffe91e63), // Rosa/Vermelho
                                                      strokeWidth: 0,
                                                    );
                                                  }
                                                  return FlDotCirclePainter(
                                                      radius:
                                                          0); // Oculta os demais
                                                },
                                              ),
                                            ),
                                          ],
                                        ),
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                            ),
                            
                            const SizedBox(height: 20),

                            // Tabela de dados de Gases
                            DataTable(
                              columns: const [
                                DataColumn(label: Text('Sensor')),
                                DataColumn(label: Text('Valor')),
                                DataColumn(label: Text('Data/Hora')),
                              ],
                              rows: gasSensores // CORRIGIDO
                                  .map(
                                    (sensor) => DataRow(cells: [
                                      DataCell(Text(sensor.nome)),
                                      DataCell(Text(sensor.dado)),
                                      DataCell(Text(sensor.data_hora)),
                                    ]),
                                  )
                                  .toList(),
                            ),
                          ],
                        ),
                      ),
          ],
        ),
      ),
    );
  }
}