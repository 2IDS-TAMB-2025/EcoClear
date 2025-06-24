import 'package:aplicativo_ecoclear/screens/relatorio.dart';
import 'package:flutter/material.dart';

void main() {
  runApp(MaterialApp(
    home: AdicionarRelatorioPage(),
    debugShowCheckedModeBanner: false,
  ));
}
class AdicionarRelatorioPage extends StatefulWidget {
  const AdicionarRelatorioPage({super.key});

  @override
  _AdicionarRelatorioPageState createState() => _AdicionarRelatorioPageState();
}

class _AdicionarRelatorioPageState extends State<AdicionarRelatorioPage> {
  final _dataController = TextEditingController();
  final _tituloController = TextEditingController();
  final _relatarController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Color.fromARGB(230, 73, 137, 5),
          foregroundColor: Colors.white,
        leading: IconButton(
          icon: Icon(Icons.arrow_back),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
        title: Text('Adicionar relatório'),
        centerTitle: true,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            TextField(
              controller: _dataController,
              decoration: InputDecoration(
                labelText: 'Data',
                labelStyle: TextStyle(color: Color(0xFF49454f)),
                border: OutlineInputBorder(),
                enabledBorder: OutlineInputBorder(
                  borderSide: BorderSide(color: Color(0xFF49454f)), 
                ),
                focusedBorder: OutlineInputBorder(
                  borderSide: BorderSide(color: Color(0xFF49454f)),
                ),
              ),
              keyboardType: TextInputType.number,
            ),
            SizedBox(height: 16),
            TextField(
              controller: _tituloController,
              decoration: InputDecoration(
                labelText: 'Título',
                labelStyle: TextStyle(color: Color(0xFF49454f)),
                border: OutlineInputBorder(),
                enabledBorder: OutlineInputBorder(
                  borderSide: BorderSide(color: Color(0xFF49454f)),
                ),
                focusedBorder: OutlineInputBorder(
                  borderSide: BorderSide(color: Color(0xFF49454f)),
                                  ),
              ),
            ),
            SizedBox(height: 16),
            TextField(
              controller: _relatarController,
              maxLines: 8,
              decoration: InputDecoration(
                labelText: 'Relatar',
                labelStyle: TextStyle(color: Color(0xFF49454f)),
                border: OutlineInputBorder(),
                enabledBorder: OutlineInputBorder(
                  borderSide: BorderSide(color: Color(0xFF49454f)),
                ),
                focusedBorder: OutlineInputBorder(
                  borderSide: BorderSide(color: Color(0xFF49454f)), 
                ),
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: Padding(
      padding: const EdgeInsets.all(35.0),
        child: ElevatedButton.icon(
          onPressed: () {
          print('Data: ${_dataController.text}');
          print('Título: ${_tituloController.text}');
          print('Relatório: ${_relatarController.text}');

      Navigator.push(
        context,
        MaterialPageRoute(builder: (context) => Relatorios()),
      );
            },
            icon: Icon(Icons.check, color: Colors.white),
            label: Text('Salvar'),
            style: ElevatedButton.styleFrom(
              backgroundColor: Color.fromARGB(230, 73, 137, 5),
              foregroundColor: Colors.white,
              minimumSize: Size(double.infinity, 50),
            ),
          ),
        ),
    );
  }
}
