import 'package:flutter/material.dart';
import '../controller/api_controller.dart';
import '../model/relatorio.dart';
import 'relatorio.dart';
import '../globals.dart' as globals; // ✅ Importa a global

void main() {
  runApp(MaterialApp(
    home: const AdicionarRelatorioPage(),
    debugShowCheckedModeBanner: false,
  ));
}

class AdicionarRelatorioPage extends StatefulWidget {
  const AdicionarRelatorioPage({super.key});

  @override
  _AdicionarRelatorioPageState createState() => _AdicionarRelatorioPageState();
}

class _AdicionarRelatorioPageState extends State<AdicionarRelatorioPage> {
  final _cnpjController = TextEditingController(); // ✅ novo controller
  final _tituloController = TextEditingController();
  final _relatarController = TextEditingController();

  bool _isLoading = false;

  @override
  void initState() {
    super.initState();
    _cnpjController.text = globals.cnpjUsuario ?? ''; // ✅ pega o valor salvo
  }

  @override
  void dispose() {
    _cnpjController.dispose();
    _tituloController.dispose();
    _relatarController.dispose();
    super.dispose();
  }

  // Função que formata a data e hora sem precisar do intl

  Future<void> _salvarRelatorio() async {
    final titulo = _tituloController.text.trim();
    final conteudo = _relatarController.text.trim();
    final cnpj = _cnpjController.text.trim();

    if (titulo.isEmpty || conteudo.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Preencha todos os campos!')),
      );
      return;
    }

    // ✅ inclui o CNPJ ao criar o relatório
    final relatorio = Relatorio(
      titulo: titulo,
      conteudo: conteudo,
      fk_cnpj_empresa: cnpj,
    );

    setState(() => _isLoading = true);

    try {
      await ApiController.postRelatorio(relatorio);
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Relatório enviado com sucesso!')),
        );
        _tituloController.clear();
        _relatarController.clear();

        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (context) => const Relatorios()),
        );
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Erro ao enviar relatório: $e')),
        );
      }
    } finally {
      setState(() => _isLoading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: const Color.fromARGB(230, 73, 137, 5),
        foregroundColor: Colors.white,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () => Navigator.pop(context),
        ),
        title: const Text('Adicionar relatório'),
        centerTitle: true,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: SingleChildScrollView(
          child: Column(
            children: [
              // ✅ Campo CNPJ (desabilitado)
              TextField(
                controller: _cnpjController,
                decoration: const InputDecoration(
                  labelText: 'CNPJ da Empresa',
                  labelStyle: TextStyle(color: Color(0xFF49454f)),
                  border: OutlineInputBorder(),
                  enabledBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Color(0xFF49454f)),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Color(0xFF49454f)),
                  ),
                ),
                enabled: false, // ✅ desabilitado
              ),
              const SizedBox(height: 16),

              TextField(
                controller: _tituloController,
                decoration: const InputDecoration(
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
              const SizedBox(height: 16),

              TextField(
                controller: _relatarController,
                maxLines: 8,
                decoration: const InputDecoration(
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
      ),
      bottomNavigationBar: Padding(
        padding: const EdgeInsets.all(35.0),
        child: ElevatedButton.icon(
          onPressed: _isLoading ? null : _salvarRelatorio,
          icon: const Icon(Icons.check, color: Colors.white),
          label: Text(_isLoading ? 'Salvando...' : 'Salvar'),
          style: ElevatedButton.styleFrom(
            backgroundColor: const Color.fromARGB(230, 73, 137, 5),
            foregroundColor: Colors.white,
            minimumSize: const Size(double.infinity, 50),
          ),
        ),
      ),
    );
  }
}
