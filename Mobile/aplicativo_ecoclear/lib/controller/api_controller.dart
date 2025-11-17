import 'dart:convert';
import 'package:aplicativo_ecoclear/model/dadosSensor.dart';
import 'package:http/http.dart' as http;
import '../model/noticias.dart';
import '../model/empresa.dart';
import '../model/empresaLogin.dart';
import '../model/relatorio.dart';


class ApiController {
  static const String baseUrl = 'http://10.141.128.106/api_ecoclear2';

  static Future<List<Noticias>> fetchNoticias() async{
    final response = await http.get(Uri.parse('$baseUrl/noticia'));
    if(response.statusCode == 200){
      List jsonList = jsonDecode(response.body);
      return jsonList.map((json) => Noticias.fromJson(json)).toList();
    }
    else{
      throw Exception("Erro ao carregar a notícia");
    }
  }

 
  static Future<List<Empresa>> fetchEmpresaPeloCNPJ({required String cnpj}) async {
    final response = await http.get(Uri.parse('$baseUrl/empresa?cnpj=$cnpj'));

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);

      // Se o backend retorna um único objeto (Map)
      if (data is Map<String, dynamic>) {
        return [Empresa.fromJson(data)];
      }

      // Se algum dia ele retornar uma lista (compatibilidade futura)
      else if (data is List) {
        return data.map((json) => Empresa.fromJson(json)).toList();
      }

      // Caso o formato seja inesperado
      else {
        throw Exception("Formato de resposta inesperado: ${data.runtimeType}");
      }
    } else {
      throw Exception("Erro ao carregar empresa (status: ${response.statusCode})");
    }
  }


    static Future<void> postEmpresa(Empresa Empresa) async{
    final response = await http.post(
      Uri.parse('$baseUrl/empresa'),
      headers: {'Content-type':'application/json'},
      body: jsonEncode(Empresa.toJson())
      );
    if(response.statusCode == 200 || response.statusCode == 201){
      print("Empresa Cadastrada com sucesso!");
    }
    else{
      throw Exception("Erro ao cadastrar empresa");
    }
  }

  static Future<void> post(EmpresaLogin empresaLogin) async {
  final response = await http.post(
    Uri.parse('$baseUrl/empresa'),
    headers: {'Content-type':'application/json'},
    body: jsonEncode(empresaLogin.toJson()),
  );

  if (response.statusCode != 200) {
    throw Exception("Erro na comunicação com o servidor!");
  }

  // Verifica o corpo da resposta
  if (response.body == "false") {
    throw Exception("CNPJ ou senha inválidos!");
  } else {
    print("Login realizado com sucesso!");
  }
}


     static Future<void> postRelatorio(Relatorio relatorio) async {
  final response = await http.post(
    Uri.parse('$baseUrl/relatorio'),
    headers: {'Content-type': 'application/json'},
    body: jsonEncode(relatorio.toJson()), // usa a instância
  );

  if (response.statusCode == 200 || response.statusCode == 201) {
    print("Relatório enviado com sucesso!");
  } else {
    throw Exception("Erro ao enviar o relatório");
  }
}

 static Future<List<Relatorio>> fetchRelatorio() async{
    final response = await http.get(Uri.parse('$baseUrl/relatorio'));
    if(response.statusCode == 200){
      List jsonList = jsonDecode(response.body);
      return jsonList.map((json) => Relatorio.fromJson(json)).toList();
    }
    else{
      throw Exception("Erro ao carregar a relatório");
    }
  }

  static Future<List<DadosSensor>> fetchDadosSensorCNPJ({required String cnpj}) async {
    final response = await http.get(Uri.parse('$baseUrl/dadoSensor?cnpj=$cnpj'));

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);

      // Se o backend retorna um único objeto (Map)
      if (data is Map<String, dynamic>) {
        return [DadosSensor.fromJson(data)];
      }

      // Se algum dia ele retornar uma lista (compatibilidade futura)
      else if (data is List) {
        return data.map((json) => DadosSensor.fromJson(json)).toList();
      }

      // Caso o formato seja inesperado
      else {
        throw Exception("Formato de resposta inesperado: ${data.runtimeType}");
      }
    } else {
      throw Exception("Erro ao carregar dados dos sensores (status: ${response.statusCode})");
    }
  }

  static Future<List<DadosSensor>> fetchTodosDadosSensorCNPJ({required String cnpj}) async {
    final response = await http.get(Uri.parse('$baseUrl/todasMedidasSensores?cnpj=$cnpj'));

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);

      // Se o backend retorna um único objeto (Map)
      if (data is Map<String, dynamic>) {
        return [DadosSensor.fromJson(data)];
      }

      // Se algum dia ele retornar uma lista (compatibilidade futura)
      else if (data is List) {
        return data.map((json) => DadosSensor.fromJson(json)).toList();
      }

      // Caso o formato seja inesperado
      else {
        throw Exception("Formato de resposta inesperado: ${data.runtimeType}");
      }
    } else {
      throw Exception("Erro ao carregar dados dos sensores (status: ${response.statusCode})");
    }
  }

  static Future<Empresa> fetchEmpresa({required String cnpj}) async {
    final response = await http.get(Uri.parse('$baseUrl/empresa?cnpj=$cnpj')); 
    if (response.statusCode == 200) {
      return Empresa.fromJson(jsonDecode(response.body));
    } else {
      throw Exception("Erro ao carregar o Perfil");
    }
  }
  static Future<void> updateEmpresa(Empresa empresa) async {
    final response = await http.put(
      Uri.parse('$baseUrl/empresa'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
      },
      body: jsonEncode(empresa.toJson()),
    );
    if (response.statusCode != 200 && response.statusCode != 204 && response.statusCode != 201) {
      throw Exception("Erro ao atualizar o Perfil");
    }
  }
}
