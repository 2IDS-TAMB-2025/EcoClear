import 'package:aplicativo_ecoclear/screens/addrelatorio.dart';
import 'package:aplicativo_ecoclear/screens/home_screen.dart';
import 'package:flutter/material.dart';

void main() {
  runApp(MaterialApp(
    home: Relatorios(),
    debugShowCheckedModeBanner: false,
  ));
}

class Relatorios extends StatelessWidget {
  const Relatorios({super.key});

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
          title: Text('Relatórios'),
          actions: [
            IconButton(
              icon: Icon(Icons.add),
              onPressed: () {
                Navigator.push(
                        context,
                        MaterialPageRoute(builder: (context) => AdicionarRelatorioPage()),
                      );
              },
            ),
          ],
          bottom: TabBar(
              labelColor: Colors.white,    
              unselectedLabelColor: Colors.white70, 
              indicatorColor: Colors.white,   
            tabs: [
              Tab(icon: Icon(Icons.insert_drive_file), text: 'Feedback'),
              Tab(icon: Icon(Icons.assignment), text: 'Relatórios Pessoais'),
            ],
          ),
        ),
        body: TabBarView(
          children: [
            Center(child: Text('Nenhum feedback no momento!')),
            Center(child: Column(
              children: [
                ElevatedButton(
                  style: ButtonStyle(
                    elevation: WidgetStateProperty.all(0), 
                    backgroundColor: WidgetStateProperty.all(Colors.transparent),
                    shadowColor: WidgetStateProperty.all(Colors.transparent),
                    padding: WidgetStateProperty.all(EdgeInsets.zero), 
                    shape: WidgetStateProperty.all(RoundedRectangleBorder(
                      borderRadius: BorderRadius.zero,
                    )),
                    overlayColor: WidgetStateProperty.resolveWith<Color>(
                      (Set<WidgetState> states) {
                        if (states.contains(WidgetState.hovered)) {
                          return const Color.fromARGB(255, 103, 103, 103).withOpacity(0.1); 
                        }
                        return Colors.transparent; 
                      },
                    ),
                    mouseCursor: WidgetStateProperty.all(SystemMouseCursors.click), 
                  ),
                  onPressed: () => {}, 
                  child: ListTile(
                    leading:Icon(	Icons.event_note),
                    title:Text("Título"),
                    trailing: Text("22/03"),
                  ),
                ), 
                ElevatedButton(
                  style: ButtonStyle(
                    elevation: WidgetStateProperty.all(0), 
                    backgroundColor: WidgetStateProperty.all(Colors.transparent),
                    shadowColor: WidgetStateProperty.all(Colors.transparent), 
                    padding: WidgetStateProperty.all(EdgeInsets.zero),
                    shape: WidgetStateProperty.all(RoundedRectangleBorder(
                      borderRadius: BorderRadius.zero, 
                    )),
                    overlayColor: WidgetStateProperty.resolveWith<Color>(
                      (Set<WidgetState> states) {
                        if (states.contains(WidgetState.hovered)) {
                          return const Color.fromARGB(255, 103, 103, 103).withOpacity(0.1); 
                        }
                        return Colors.transparent; 
                      },
                    ),
                    mouseCursor: WidgetStateProperty.all(SystemMouseCursors.click), 
                  ),
                  onPressed: () => {}, 
                  child: ListTile(
                    leading:Icon(Icons.event_note),
                    title:Text("Titulo"),
                    trailing: Text("10/02"),
                  ),
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
