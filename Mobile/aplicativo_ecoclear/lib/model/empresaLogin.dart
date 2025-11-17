class EmpresaLogin {
  final String cnpj;
  final String senha;

  EmpresaLogin({
    required this.cnpj,
    required this.senha
  });

  factory EmpresaLogin.fromJson(Map<String, dynamic> json) {
    return EmpresaLogin(
      cnpj: json['CNPJ'],
      senha: json['SENHA']
    );
  }

  Map<String, dynamic> toJson() => {
        'cnpj': cnpj,
        'senha': senha
      };
}
