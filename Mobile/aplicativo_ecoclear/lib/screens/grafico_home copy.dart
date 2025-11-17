import 'package:aplicativo_ecoclear/screens/home_screen.dart';
import 'package:flutter/material.dart';
import 'package:fl_chart/fl_chart.dart';

class GraficoHome extends StatelessWidget {
  const GraficoHome({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: GraficoHomePage(),
    );
  }
}

class GraficoHomePage extends StatelessWidget {
  const GraficoHomePage({super.key});

  @override
  Widget build(BuildContext context) {
    return DefaultTabController(
      length: 2,
      child: Scaffold(
        appBar: AppBar(
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
          title: Text('Visualizar Gráficos'),
          bottom: TabBar(
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
            // aba 1 
            Padding(
              padding: const EdgeInsets.all(70.0),
              child: BarChart(
                BarChartData(
                  alignment: BarChartAlignment.spaceAround,
                  maxY: 250,
                  barTouchData: BarTouchData(enabled: false),
                  titlesData: FlTitlesData(
                    topTitles: AxisTitles(
                      sideTitles: SideTitles(showTitles: false),
                    ),
                    leftTitles: AxisTitles(
                      sideTitles: SideTitles(
                        showTitles: true,
                        interval: 50,
                        getTitlesWidget: (value, _) => Transform.translate(
                          offset: Offset(-6, 0), 
                          child: Text(
                            '${value.toInt()}°C',
                            style: TextStyle(
                              fontSize: 12,
                              color: Colors.black,
                            ),
                          ),
                        ),
                      ),
                    ),
                    rightTitles: AxisTitles(
                      sideTitles: SideTitles(showTitles: false),
                    ),
                    bottomTitles: AxisTitles(
                      sideTitles: SideTitles(
                        showTitles: true,
                        getTitlesWidget: (value, _) {
                          switch (value.toInt()) {
                            case 0:
                              return Text('Jan');
                            case 1:
                              return Text('Fev');
                            case 2:
                              return Text('Mar');
                            case 3:
                              return Text('Abr');
                            case 4:
                              return Text('Mai');
                            case 5:
                              return Text('Jun');
                            default:
                              return Text('');
                          }
                        },
                      ),
                    ),
                  ),
                  borderData: FlBorderData(show: false),
                  barGroups: [
                    BarChartGroupData(x: 0, barRods: [
                      BarChartRodData(toY: 180, color: Color(0xffbec2bd), width: 18),
                    ]),
                    BarChartGroupData(x: 1, barRods: [
                      BarChartRodData(toY: 200, color:  Color(0xff444b42), width: 18),
                    ]),
                    BarChartGroupData(x: 2, barRods: [
                      BarChartRodData(toY: 150, color: Color(0xff829980), width: 18),
                    ]),
                    BarChartGroupData(x: 3, barRods: [
                      BarChartRodData(toY: 220, color: Color(0xff8c9792), width: 18),
                    ]),
                    BarChartGroupData(x: 4, barRods: [
                      BarChartRodData(toY: 170, color: Color(0xff76a540), width: 18),
                    ]),
                    BarChartGroupData(x: 5, barRods: [
                      BarChartRodData(toY: 190, color: const Color.fromARGB(255, 155, 193, 156), width: 18),
                    ]),
                  ],
                ),
              ),
            ),

            // Aba 2
            Padding(
              padding: const EdgeInsets.all(70.0),
              child: BarChart(
                BarChartData(
                  alignment: BarChartAlignment.spaceAround,
                  maxY: 20,
                  barTouchData: BarTouchData(enabled: false),
                  titlesData: FlTitlesData(
                    leftTitles: AxisTitles(
                      sideTitles: SideTitles(
                        showTitles: true,
                        interval: 5,
                        getTitlesWidget: (value, _) => Transform.translate(
                          offset: Offset(-6, 0),
                          child: Text(
                            '${value.toInt()}',
                            style: TextStyle(fontSize: 12),
                          ),
                        ),
                      ),
                    ),
                    bottomTitles: AxisTitles(
                      sideTitles: SideTitles(
                        showTitles: true,
                        getTitlesWidget: (value, _) {
                          switch (value.toInt()) {
                            case 0:
                              return Text('CO₂');
                            case 1:
                              return Text('N0₂');
                            case 2:
                              return Text('SO₂');
                            default:
                              return Text('');
                          }
                        },
                      ),
                    ),
                  ),
                  borderData: FlBorderData(show: false),
                  barGroups: [
                    BarChartGroupData(x: 0, barRods: [
                      BarChartRodData(toY: 8, color: Color(0xff76a540), width: 20),
                    ]),
                    BarChartGroupData(x: 1, barRods: [
                      BarChartRodData(toY: 12, color: Color(0xffbec2bd), width: 20),
                    ]),
                    BarChartGroupData(x: 2, barRods: [
                      BarChartRodData(toY: 16, color:  Color(0xff8c9792), width: 20),
                    ]),
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