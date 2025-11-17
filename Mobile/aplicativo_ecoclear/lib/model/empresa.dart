class Empresa {
  final String cnpj;
  final String razao_social;
  final String descricao_atividade;
  final String telefone;
  final String senha;
  final String email;
  final String endereco;

  Empresa({
    required this.cnpj,
    required this.razao_social,
    required this.descricao_atividade,
    required this.telefone,
    required this.senha,
    required this.email,
    required this.endereco,
  });

  factory Empresa.fromJson(Map<String, dynamic> json) {
    return Empresa(
      cnpj: json['CNPJ'],
      razao_social: json['RAZAO_SOCIAL'],
      descricao_atividade: json['DESCRICAO_ATIVIDADE'],
      telefone: json['TELEFONE'],
      senha: json['SENHA'],
      email: json['EMAIL'],
      endereco: json['ENDERECO']
    );
  }

  Map<String, dynamic> toJson() => {
        'cnpj': cnpj,
        'razao_social': razao_social,
        'descricao_atividade': descricao_atividade,
        'telefone': telefone,
        'senha': senha,
        'email': email,
        'endereco': endereco
      };
}
