class Relatorio{
  final String titulo;
  final String data_hora;
  final String conteudo;

  Relatorio(
    {required this.titulo,
    required this.data_hora,
    required this.conteudo}
  );

  factory Relatorio.fromJson(Map<String, dynamic> json){
    return Relatorio(
      titulo: json['titulo'],
      data_hora: json['data_hora'],
      conteudo: json['conteudo']
    );
  }

  Map<String, dynamic> toJson() => {
    'titulo': titulo,
    'data_hora': data_hora,
    'conteudo': conteudo
  };
}