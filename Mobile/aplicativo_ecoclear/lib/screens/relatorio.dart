import 'package:flutter/material.dart';
import 'package:aplicativo_ecoclear/screens/addrelatorio.dart';
import 'package:aplicativo_ecoclear/screens/home_screen.dart';
import '../controller/api_controller.dart';
import '../model/relatorio.dart';
import '../globals.dart' as globals;

void main() {
  runApp(MaterialApp(
    home: const Relatorios(),
    debugShowCheckedModeBanner: false,
  ));
}

class Relatorios extends StatefulWidget {
  const Relatorios({super.key});

  @override
  State<Relatorios> createState() => _RelatoriosState();
}

class _RelatoriosState extends State<Relatorios> {
  late Future<List<Relatorio>> _relatoriosFuture;

  @override
  void initState() {
    super.initState();
    _relatoriosFuture = ApiController.fetchRelatorio();
  }

  Future<void> _recarregarRelatorios() async {
    setState(() {
      _relatoriosFuture = ApiController.fetchRelatorio();
    });
  }

  @override
  Widget build(BuildContext context) {
    return DefaultTabController(
      length: 2,
      child: Scaffold(
        appBar: AppBar(
          backgroundColor: const Color.fromARGB(230, 73, 137, 5),
          foregroundColor: Colors.white,
          leading: IconButton(
            icon: const Icon(Icons.arrow_back),
            onPressed: () {
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(builder: (context) => HomePage()),
              );
            },
          ),
          title: const Text('Relatórios'),
          centerTitle: true,
          actions: [
            IconButton(
              icon: const Icon(Icons.add),
              tooltip: 'Adicionar Relatório',
              onPressed: () async {
                await Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => const AdicionarRelatorioPage()),
                );
                _recarregarRelatorios(); // Atualiza a lista após adicionar
              },
            ),
          ],
          bottom: const TabBar(
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
            // Aba 1 - Feedback
            const Center(
              child: Text(
                'Nenhum feedback no momento!',
                style: TextStyle(fontSize: 16),
              ),
            ),

            // Aba 2 - Relatórios Pessoais
            RefreshIndicator(
              onRefresh: _recarregarRelatorios,
              child: FutureBuilder<List<Relatorio>>(
                future: _relatoriosFuture,
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return const Center(child: CircularProgressIndicator());
                  } else if (snapshot.hasError) {
                    return Center(
                      child: Text(
                        'Erro ao carregar relatórios:\n${snapshot.error}',
                        textAlign: TextAlign.center,
                        style: const TextStyle(color: Colors.red),
                      ),
                    );
                  } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
                    return const Center(
                      child: Text(
                        'Nenhum relatório disponível.',
                        style: TextStyle(fontSize: 16),
                      ),
                    );
                  } else {
                    //final relatorios = snapshot.data!;
                    final todosRelatorios = snapshot.data!;
                    final relatorios = todosRelatorios
                        .where((r) => r.fk_cnpj_empresa == globals.cnpjUsuario)
                        .toList();
                    return ListView.builder(
                      itemCount: relatorios.length,
                      itemBuilder: (context, index) {
                        final relatorio = relatorios[index];
                        return Card(
                          margin: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
                          elevation: 2,
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(10),
                          ),
                          child: ListTile(
                            leading: const Icon(Icons.description, color: Color(0xFF4CAF50)),
                            title: Text(
                              relatorio.titulo,
                              style: const TextStyle(fontWeight: FontWeight.bold),
                            ),
                            subtitle: Text(
                              relatorio.conteudo,
                              maxLines: 2,
                              overflow: TextOverflow.ellipsis,
                            ),
                            onTap: () {
                              // Detalhe do relatório (pode abrir outra tela)
                              showDialog(
                                context: context,
                                builder: (context) => AlertDialog(
                                  title: Text(relatorio.titulo),
                                  content: Column(
                                    mainAxisSize: MainAxisSize.min,
                                    crossAxisAlignment: CrossAxisAlignment.start,
                                    children: [
                                      Text(relatorio.conteudo),
                                    ],
                                  ),
                                  actions: [
                                    TextButton(
                                      onPressed: () => Navigator.pop(context),
                                      child: const Text('Fechar'),
                                    ),
                                  ],
                                ),
                              );
                            },
                          ),
                        );
                      },
                    );
                  }
                },
              ),
            ),
          ],
        ),
      ),
    );
  }
}
