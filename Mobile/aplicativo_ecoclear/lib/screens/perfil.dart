// Este é seu arquivo de tela (ex: screens/perfil_usuario_screen.dart)

import 'package:aplicativo_ecoclear/controller/api_controller.dart';
import 'package:aplicativo_ecoclear/screens/home_screen.dart';
import 'package:flutter/material.dart';
import '../model/empresa.dart'; // <-- IMPORTE SEU MODELO AQUI
import '../globals.dart' as globals;

class PerfilUsuario extends StatefulWidget {
  const PerfilUsuario({super.key});

  @override
  State<PerfilUsuario> createState() => _PerfilUsuarioState();
}

class _PerfilUsuarioState extends State<PerfilUsuario> {
  // Future para o FutureBuilder
  late Future<Empresa> _empresaFuture;

  // Objeto para guardar os dados da empresa quando carregados
  Empresa? _empresa;

  // Controladores para os campos de texto
  final _razaoSocialController = TextEditingController();
  final _cnpjController = TextEditingController();
  final _emailController = TextEditingController();
  final _telefoneController = TextEditingController();
  // Adicione controladores para os outros campos se for editá-los
  // final _enderecoController = TextEditingController();
  // final _descricaoController = TextEditingController();

  bool _isLoading = false; // Para mostrar feedback no botão salvar

  @override
  void initState() {
    super.initState();
    // Inicia a busca pelos dados da empresa
    _empresaFuture = _loadEmpresaData();
  }

  /// Carrega os dados da API e popula os controladores
  Future<Empresa> _loadEmpresaData() async {
    try {
      final empresa = await ApiController.fetchEmpresa(cnpj: globals.cnpjUsuario!);
      // Guarda a empresa e popula os campos
      setState(() {
        _empresa = empresa;
        _razaoSocialController.text = empresa.razao_social;
        _cnpjController.text = empresa.cnpj;
        _emailController.text = empresa.email;
        _telefoneController.text = empresa.telefone;
      });
      return empresa;
    } catch (e) {
      // Mostra erro se falhar ao carregar
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Erro ao carregar dados: ${e.toString()}')),
      );
      rethrow;
    }
  }

  /// Salva as alterações feitas pelo usuário
  Future<void> _saveChanges() async {
    if (_empresa == null) return; // Não faz nada se os dados não foram carregados

    setState(() {
      _isLoading = true; // Ativa o loading no botão
    });

    try {
      // Cria um novo objeto Empresa com os dados atualizados dos controladores
      // É importante incluir TODOS os campos, mesmo os não editados
      Empresa updatedEmpresa = Empresa(
        razao_social: _razaoSocialController.text,
        email: _emailController.text,
        telefone: _telefoneController.text,
        // Mantém os dados originais que não estão sendo editados na tela
        cnpj: _empresa!.cnpj, // CNPJ geralmente não é editável
        descricao_atividade: "",
        senha: "", // Cuidado ao reenviar senhas!
        endereco: "",
      );

      // Envia os dados atualizados para a API
      await ApiController.updateEmpresa(updatedEmpresa);

      // Sucesso!
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text('Perfil atualizado com sucesso!'),
          backgroundColor: Colors.green,
        ),
      );
      // Volta para a Home
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (context) => HomePage()),
      );
    } catch (e) {
      // Erro ao salvar
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Erro ao salvar: ${e.toString()}'),
          backgroundColor: Colors.red,
        ),
      );
    } finally {
      setState(() {
        _isLoading = false; // Desativa o loading do botão
      });
    }
  }

  @override
  void dispose() {
    // Sempre limpe os controladores no dispose
    _razaoSocialController.dispose();
    _cnpjController.dispose();
    _emailController.dispose();
    _telefoneController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color.fromARGB(255, 148, 143, 143),
      body: SafeArea(
        child: SingleChildScrollView(
          child: Column(
            children: [
              // --- Botão Voltar Corrigido ---
              Padding(
                padding: const EdgeInsets.symmetric(vertical: 10, horizontal: 16),
                child: Align(
                  alignment: Alignment.centerLeft,
                  child: GestureDetector(
                    onTap: () {
                      Navigator.pushReplacement(
                        context,
                        MaterialPageRoute(builder: (context) => HomePage()),
                      );
                    },
                    child: const Icon(
                      Icons.arrow_back,
                      size: 30,
                      color: Colors.white,
                    ),
                  ),
                ),
              ),
              Center(
                child: SizedBox(
                  width: 250,
                  child: Padding(
                    padding: const EdgeInsets.all(1),
                    child: Image.asset("assets/imagens/BioClear.png"),
                  ),
                ),
              ),
              const SizedBox(height: 10),
              Container(
                width: double.infinity, // Garante que o container ocupe a largura
                padding: const EdgeInsets.symmetric(horizontal: 30, vertical: 20),
                decoration: const BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.only(
                    topLeft: Radius.circular(40),
                    topRight: Radius.circular(40),
                  ),
                ),
                // --- FUTURE BUILDER PARA CARREGAR OS DADOS ---
                child: FutureBuilder<Empresa>(
                  future: _empresaFuture,
                  builder: (context, snapshot) {
                    // 1. Estado de Carregamento
                    if (snapshot.connectionState == ConnectionState.waiting) {
                      return const Center(
                        child: Padding(
                          padding: EdgeInsets.all(40.0),
                          child: CircularProgressIndicator(),
                        ),
                      );
                    }
                    // 2. Estado de Erro
                    if (snapshot.hasError) {
                      return Center(
                        child: Text("Erro ao carregar perfil: ${snapshot.error}"),
                      );
                    }
                    // 3. Estado de Sucesso (Dados Carregados)
                    if (snapshot.hasData) {
                      // Constrói o formulário com os dados
                      return _buildProfileForm();
                    }
                    // 4. Estado Vazio (default)
                    return const Center(child: Text("Nenhum dado encontrado."));
                  },
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  /// Widget que constrói o formulário (separado para clareza)
  Widget _buildProfileForm() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Center(
          child: Text(
            "Perfil do Usuário",
            style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
          ),
        ),
        const SizedBox(height: 18),
        // Campos de texto agora usam os controladores
        buildCampo(
          label: "Nome da Empresa",
          controller: _razaoSocialController,
        ),
        const SizedBox(height: 20),
        buildCampo(
          label: "CNPJ",
          controller: _cnpjController,
          readOnly: true, // CNPJ geralmente não deve ser editado
        ),
        const SizedBox(height: 20),
        buildCampo(
          label: "Email",
          controller: _emailController,
        ),
        const SizedBox(height: 20),
        buildCampo(
          label: "Telefone",
          controller: _telefoneController,
        ),
        const SizedBox(height: 25),
        SizedBox(
          width: double.infinity,
          height: 48,
          child: ElevatedButton(
            // Desabilita o botão enquanto está salvando
            onPressed: _isLoading ? null : _saveChanges, 
            style: ElevatedButton.styleFrom(
              backgroundColor: const Color.fromARGB(218, 96, 177, 11),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(12),
              ),
            ),
            // Mostra "loading" ou o texto
            child: _isLoading
                ? const CircularProgressIndicator(color: Colors.white)
                : const Text(
                    "Salvar Alterações",
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                      fontSize: 16,
                      color: Colors.white,
                    ),
                  ),
          ),
        ),
      ],
    );
  }

  /// Widget helper modificado para aceitar um controller
  Widget buildCampo({
    required String label,
    required TextEditingController controller,
    bool readOnly = false,
  }) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(label, style: const TextStyle(fontSize: 16)),
        const SizedBox(height: 8),
        Container(
          decoration: BoxDecoration(
            // Cor diferente se for apenas leitura
            color: readOnly ? Colors.grey[200] : Colors.grey[100],
            borderRadius: BorderRadius.circular(12),
            boxShadow: [
              BoxShadow(
                color: Colors.grey.withOpacity(0.2),
                blurRadius: 8,
                offset: const Offset(0, 2),
              ),
            ],
          ),
          child: TextField(
            controller: controller, // Usa o controlador
            readOnly: readOnly,     // Define se o campo pode ser editado
            decoration: const InputDecoration(
              border: InputBorder.none,
              contentPadding: EdgeInsets.symmetric(horizontal: 16, vertical: 14),
            ),
          ),
        ),
      ],
    );
  }
}