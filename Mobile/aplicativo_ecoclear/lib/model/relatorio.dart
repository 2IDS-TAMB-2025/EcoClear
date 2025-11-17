class Relatorio {
  final String titulo;
  final String conteudo;
  final String fk_cnpj_empresa;

  Relatorio({
    required this.titulo,
    required this.conteudo,
    required this.fk_cnpj_empresa
  });

  factory Relatorio.fromJson(Map<String, dynamic> json) {
    return Relatorio(
      titulo: json['TITULO'],
      conteudo: json['CONTEUDO'],
      fk_cnpj_empresa: json['FK_CNPJ_EMPRESA']
    );
  }

  Map<String, dynamic> toJson() => {
        'titulo': titulo,
        'conteudo': conteudo,
        'fk_cnpj_empresa': fk_cnpj_empresa
      };
}
