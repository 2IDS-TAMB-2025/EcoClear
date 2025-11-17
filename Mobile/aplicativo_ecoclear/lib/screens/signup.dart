import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:aplicativo_ecoclear/screens/login.dart';

// importa a model e o controller
import '../model/empresa.dart';
import '../controller/api_controller.dart';

class SignUpScreen extends StatefulWidget {
  const SignUpScreen({super.key});

  @override
  State<SignUpScreen> createState() => _SignUpScreenState();
}

class _SignUpScreenState extends State<SignUpScreen> {
  // Controllers
  final TextEditingController _razaoController = TextEditingController();
  final TextEditingController _cnpjController = TextEditingController();
  final TextEditingController _descController = TextEditingController();
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _phoneController = TextEditingController();
  final TextEditingController _addressController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();
  final TextEditingController _confirmController = TextEditingController();

  // UI state
  bool _obscurePass = true;
  bool _obscureConfirm = true;
  String? _passwordError;
  bool _loading = false;

  @override
  void dispose() {
    _razaoController.dispose();
    _cnpjController.dispose();
    _descController.dispose();
    _emailController.dispose();
    _phoneController.dispose();
    _addressController.dispose();
    _passwordController.dispose();
    _confirmController.dispose();
    super.dispose();
  }

  // Validators
  bool get _razaoOk => _razaoController.text.trim().isNotEmpty;
  bool get _cnpjOk => _cnpjController.text.trim().length == 14;
  bool get _descOk => _descController.text.trim().isNotEmpty;
  bool get _emailOk {
    final e = _emailController.text.trim();
    if (e.isEmpty) return false;
    final regex = RegExp(r"^[\w\-.]+@([\w-]+\.)+[\w-]{2,4}$");
    return regex.hasMatch(e);
  }

  bool get _phoneOk => _phoneController.text.trim().length == 11;
  bool get _addressOk => _addressController.text.trim().isNotEmpty;
  bool get _passwordsFilled =>
      _passwordController.text.isNotEmpty && _confirmController.text.isNotEmpty;
  bool get _passwordsMatch =>
      _passwordController.text == _confirmController.text &&
      _passwordController.text.isNotEmpty;

  bool get _allValid =>
      _razaoOk &&
      _cnpjOk &&
      _descOk &&
      _emailOk &&
      _phoneOk &&
      _addressOk &&
      _passwordsFilled &&
      _passwordsMatch;

  void _onAnyChanged() {
    setState(() {
      if (_confirmController.text.isNotEmpty ||
          _passwordController.text.isNotEmpty) {
        if (_passwordController.text != _confirmController.text) {
          _passwordError = "Passwords do not match";
        } else {
          _passwordError = null;
        }
      } else {
        _passwordError = null;
      }
    });
  }

  Color _checkColor(bool ok) => ok ? Colors.green : Colors.grey.shade400;

  Future<void> _cadastrarEmpresa() async {
    if (!_allValid) return;

    setState(() => _loading = true);

    final empresa = Empresa(
      cnpj: _cnpjController.text.trim(),
      razao_social: _razaoController.text.trim(),
      descricao_atividade: _descController.text.trim(),
      telefone: _phoneController.text.trim(),
      senha: _passwordController.text.trim(),
      email: _emailController.text.trim(),
      endereco: _addressController.text.trim()
    );

    try {
      await ApiController.postEmpresa(empresa);

      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text("Empresa cadastrada com sucesso!"),
            backgroundColor: Colors.green,
          ),
        );

        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (_) => const Login()),
        );
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text("Erro ao cadastrar: $e"),
            backgroundColor: Colors.red,
          ),
        );
      }
    } finally {
      if (mounted) setState(() => _loading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    final double h = MediaQuery.of(context).size.height;
    final double topHeight = h * 0.30;

    return Scaffold(
      backgroundColor: const Color(0xFFF2F2F2),
      body: Stack(
        children: [
          // topo com gradiente
          Container(
            height: topHeight,
            decoration: const BoxDecoration(
              gradient: LinearGradient(
                colors: [Color.fromARGB(218, 71, 186, 14), Color.fromARGB(255, 41, 41, 41)],
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
              ),
            ),
          ),

          SafeArea(
            child: Padding(
              padding: const EdgeInsets.only(left: 22.0, top: 22.0),
              child: Text(
                "\nEcoClear",
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 34,
                  fontWeight: FontWeight.w800,
                  height: 0.95,
                ),
              ),
            ),
          ),

          // três pontos topo direito
          SafeArea(
            child: Align(
              alignment: Alignment.topRight,
            ),
          ),

          // conteúdo principal
          Align(
            alignment: Alignment.bottomCenter,
            child: SingleChildScrollView(
              child: Container(
                margin: EdgeInsets.only(top: topHeight - 36),
                padding: const EdgeInsets.fromLTRB(20, 22, 20, 24),
                decoration: const BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.only(
                    topLeft: Radius.circular(28),
                    topRight: Radius.circular(28),
                  ),
                ),
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    // cartão interno
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 12),
                      decoration: BoxDecoration(
                        color: const Color(0xFFF7F7F8),
                        borderRadius: BorderRadius.circular(18),
                      ),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          // Campos do formulário (Razão, CNPJ, Atividade, Email, Telefone, Endereço, Senha, Confirma)
                          // --- Razão Social ---
                          const Text("Razão Social", style: TextStyle(fontSize: 13, color: Color.fromARGB(218, 39, 102, 8))),
                          const SizedBox(height: 6),
                          Row(
                            children: [
                              Expanded(
                                child: TextField(
                                  controller: _razaoController,
                                  textInputAction: TextInputAction.next,
                                  decoration: const InputDecoration(
                                    hintText: "Nome da empresa",
                                    isDense: true,
                                    contentPadding: EdgeInsets.symmetric(vertical: 8, horizontal: 6),
                                    border: InputBorder.none,
                                  ),
                                  onChanged: (_) => _onAnyChanged(),
                                ),
                              ),
                              const SizedBox(width: 8),
                              Icon(Icons.check, size: 20, color: _checkColor(_razaoOk)),
                            ],
                          ),

                          const SizedBox(height: 8),

                          // --- CNPJ ---
                          const Text("CNPJ", style: TextStyle(fontSize: 13, color: Color.fromARGB(218, 39, 102, 8))),
                          const SizedBox(height: 6),
                          Row(
                            children: [
                              Expanded(
                                child: TextField(
                                  controller: _cnpjController,
                                  keyboardType: TextInputType.number,
                                  inputFormatters: [
                                    FilteringTextInputFormatter.digitsOnly,
                                    LengthLimitingTextInputFormatter(14),
                                  ],
                                  decoration: const InputDecoration(
                                    hintText: "XX.XXX.XXX/0001-XX",
                                    isDense: true,
                                    contentPadding: EdgeInsets.symmetric(vertical: 8, horizontal: 6),
                                    border: InputBorder.none,
                                  ),
                                  onChanged: (_) => _onAnyChanged(),
                                ),
                              ),
                              const SizedBox(width: 8),
                              Icon(Icons.check, size: 20, color: _checkColor(_cnpjOk)),
                            ],
                          ),
                          if (!_cnpjOk && _cnpjController.text.isNotEmpty)
                            Padding(
                              padding: const EdgeInsets.only(top: 6.0),
                              child: Text(
                                "CNPJ deve ter 14 dígitos.",
                                style: TextStyle(color: Colors.red.shade400, fontSize: 12),
                              ),
                            ),

                          const SizedBox(height: 8),

                          // --- Descrição de Atividades ---
                          const Text("Descrição de atividades", style: TextStyle(fontSize: 13, color: Color.fromARGB(218, 39, 102, 8))),
                          const SizedBox(height: 6),
                          Row(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Expanded(
                                child: TextField(
                                  controller: _descController,
                                  keyboardType: TextInputType.multiline,
                                  minLines: 1,
                                  maxLines: null,
                                  decoration: const InputDecoration(
                                    hintText: "Descreva as atividades da empresa",
                                    isDense: true,
                                    contentPadding: EdgeInsets.symmetric(vertical: 12, horizontal: 6),
                                    border: InputBorder.none,
                                  ),
                                  onChanged: (_) => _onAnyChanged(),
                                ),
                              ),
                              const SizedBox(width: 8),
                              Icon(Icons.check, size: 20, color: _checkColor(_descOk)),
                            ],
                          ),

                          const SizedBox(height: 8),

                          // --- Email ---
                          const Text("Email", style: TextStyle(fontSize: 13, color: Color.fromARGB(218, 39, 102, 8))),
                          const SizedBox(height: 6),
                          Row(
                            children: [
                              Expanded(
                                child: TextField(
                                  controller: _emailController,
                                  keyboardType: TextInputType.emailAddress,
                                  decoration: const InputDecoration(
                                    hintText: "exemplo@empresa.com",
                                    isDense: true,
                                    contentPadding: EdgeInsets.symmetric(vertical: 8, horizontal: 6),
                                    border: InputBorder.none,
                                  ),
                                  onChanged: (_) => _onAnyChanged(),
                                ),
                              ),
                              const SizedBox(width: 8),
                              Icon(Icons.check, size: 20, color: _checkColor(_emailOk)),
                            ],
                          ),
                          if (!_emailOk && _emailController.text.isNotEmpty)
                            Padding(
                              padding: const EdgeInsets.only(top: 6.0),
                              child: Text(
                                "Email inválido.",
                                style: TextStyle(color: Colors.red.shade400, fontSize: 12),
                              ),
                            ),

                          const SizedBox(height: 8),

                          // --- Telefone ---
                          const Text("Telefone", style: TextStyle(fontSize: 13, color: Color.fromARGB(218, 39, 102, 8))),
                          const SizedBox(height: 6),
                          Row(
                            children: [
                              Expanded(
                                child: TextField(
                                  controller: _phoneController,
                                  keyboardType: TextInputType.number,
                                  inputFormatters: [
                                    FilteringTextInputFormatter.digitsOnly,
                                    LengthLimitingTextInputFormatter(11),
                                  ],
                                  decoration: const InputDecoration(
                                    hintText: "11987654321",
                                    isDense: true,
                                    contentPadding: EdgeInsets.symmetric(vertical: 8, horizontal: 6),
                                    border: InputBorder.none,
                                  ),
                                  onChanged: (_) => _onAnyChanged(),
                                ),
                              ),
                              const SizedBox(width: 8),
                              Icon(Icons.check, size: 20, color: _checkColor(_phoneOk)),
                            ],
                          ),
                          if (!_phoneOk && _phoneController.text.isNotEmpty)
                            Padding(
                              padding: const EdgeInsets.only(top: 6.0),
                              child: Text(
                                "Telefone deve ter 11 dígitos.",
                                style: TextStyle(color: Colors.red.shade400, fontSize: 12),
                              ),
                            ),

                          const SizedBox(height: 8),

                          // --- Endereço ---
                          const Text("Endereço", style: TextStyle(fontSize: 13, color: Color.fromARGB(218, 39, 102, 8))),
                          const SizedBox(height: 6),
                          Row(
                            children: [
                              Expanded(
                                child: TextField(
                                  controller: _addressController,
                                  decoration: const InputDecoration(
                                    hintText: "Rua, número, bairro, cidade - UF",
                                    isDense: true,
                                    contentPadding: EdgeInsets.symmetric(vertical: 8, horizontal: 6),
                                    border: InputBorder.none,
                                  ),
                                  onChanged: (_) => _onAnyChanged(),
                                ),
                              ),
                              const SizedBox(width: 8),
                              Icon(Icons.check, size: 20, color: _checkColor(_addressOk)),
                            ],
                          ),

                          const SizedBox(height: 8),

                          // --- Senha ---
                          const Text("Senha", style: TextStyle(fontSize: 13, color: Color.fromARGB(218, 39, 102, 8))),
                          const SizedBox(height: 6),
                          Row(
                            children: [
                              Expanded(
                                child: TextField(
                                  controller: _passwordController,
                                  obscureText: _obscurePass,
                                  decoration: const InputDecoration(
                                    hintText: "••••••••",
                                    isDense: true,
                                    contentPadding: EdgeInsets.symmetric(vertical: 8, horizontal: 6),
                                    border: InputBorder.none,
                                  ),
                                  onChanged: (_) => _onAnyChanged(),
                                ),
                              ),
                              const SizedBox(width: 8),
                              GestureDetector(
                                onTap: () {
                                  setState(() => _obscurePass = !_obscurePass);
                                },
                                child: Container(
                                  width: 34,
                                  height: 34,
                                  decoration: BoxDecoration(
                                    color: const Color.fromARGB(255, 127, 175, 127).withOpacity(0.2),
                                    shape: BoxShape.circle,
                                  ),
                                  child: Icon(
                                    _obscurePass ? Icons.visibility_off : Icons.visibility,
                                    size: 18,
                                    color: const Color.fromARGB(255, 66, 109, 60),
                                  ),
                                ),
                              ),
                            ],
                          ),

                          const SizedBox(height: 8),

                          // --- Confirmação da senha ---
                          const Text("Reconfirmar Senha", style: TextStyle(fontSize: 13, color: Color.fromARGB(218, 39, 102, 8))),
                          const SizedBox(height: 6),
                          Row(
                            children: [
                              Expanded(
                                child: TextField(
                                  controller: _confirmController,
                                  obscureText: _obscureConfirm,
                                  decoration: const InputDecoration(
                                    hintText: "••••••••",
                                    isDense: true,
                                    contentPadding: EdgeInsets.symmetric(vertical: 8, horizontal: 6),
                                    border: InputBorder.none,
                                  ),
                                  onChanged: (_) => _onAnyChanged(),
                                ),
                              ),
                              const SizedBox(width: 8),
                              GestureDetector(
                                onTap: () {
                                  setState(() => _obscureConfirm = !_obscureConfirm);
                                },
                                child: Container(
                                  width: 34,
                                  height: 34,
                                  decoration: BoxDecoration(
                                    color: const Color.fromARGB(255, 127, 175, 127).withOpacity(0.2),
                                    shape: BoxShape.circle,
                                  ),
                                  child: Icon(
                                    _obscureConfirm ? Icons.visibility_off : Icons.visibility,
                                    size: 18,
                                    color: const Color.fromARGB(255, 66, 109, 60),
                                  ),
                                ),
                              ),
                            ],
                          ),

                          if (_passwordError != null)
                            Padding(
                              padding: const EdgeInsets.only(top: 6.0),
                              child: Text(
                                _passwordError!,
                                style: TextStyle(color: Colors.red.shade400, fontSize: 12),
                              ),
                            ),
                          if (_confirmController.text.isNotEmpty && !_passwordsMatch)
                            Padding(
                              padding: const EdgeInsets.only(top: 6.0),
                              child: Text(
                                "Senhas não conferem.",
                                style: TextStyle(color: Colors.red.shade400, fontSize: 12),
                              ),
                            ),
                        ],
                      ),
                    ),

                    const SizedBox(height: 12),

                    // Botão CADASTRAR
                    SizedBox(
                      width: double.infinity,
                      height: 52,
                      child: ElevatedButton(
                        onPressed: _allValid && !_loading ? _cadastrarEmpresa : null,
                        style: ElevatedButton.styleFrom(
                          padding: EdgeInsets.zero,
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(28),
                          ),
                          elevation: 6,
                        ),
                        child: Ink(
                          decoration: BoxDecoration(
                            gradient: const LinearGradient(
                              colors: [Color.fromARGB(218, 71, 186, 14), Color.fromARGB(255, 41, 41, 41)],
                              begin: Alignment.centerLeft,
                              end: Alignment.centerRight,
                            ),
                            borderRadius: BorderRadius.circular(28),
                          ),
                          child: Container(
                            alignment: Alignment.center,
                            child: _loading
                                ? const CircularProgressIndicator(
                                    valueColor: AlwaysStoppedAnimation<Color>(Colors.white),
                                  )
                                : Text(
                                    "CADASTRAR",
                                    style: TextStyle(
                                      color: _allValid ? Colors.white : Colors.white.withOpacity(1),
                                      fontWeight: FontWeight.w700,
                                      fontSize: 16,
                                    ),
                                  ),
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
