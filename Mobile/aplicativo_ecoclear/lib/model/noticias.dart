class Noticias{
  final String titulo;
  final String data_publicacao;
  final String imagem;
  final String link;

  Noticias(
    {required this.titulo,
    required this.data_publicacao,
    required this.imagem,
    required this.link}
  );

  factory Noticias.fromJson(Map<String, dynamic> json){
    return Noticias(
      titulo: json['TITULO'],
      data_publicacao: json['DATA_PUBLICACAO'],
      imagem: json['IMAGEM'],
      link: json['LINK']
    );
  }

  Map<String, dynamic> toJson() => {
    'titulo': titulo,
    'data_publicacao': data_publicacao,
    'imagem': imagem,
    'link': link
  };
}