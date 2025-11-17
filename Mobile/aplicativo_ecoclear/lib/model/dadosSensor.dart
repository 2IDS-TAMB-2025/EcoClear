class DadosSensor {
  final String fk_id_sensor;
  final String dado;
  final String nome;
  final String tipo;
  final String data_hora;

  DadosSensor({
    required this.fk_id_sensor,
    required this.dado,
    required this.nome,
    required this.tipo,
    required this.data_hora,
  });

  factory DadosSensor.fromJson(Map<String, dynamic> json) {
    return DadosSensor(
      fk_id_sensor: json['FK_ID_SENSOR'].toString(),
      dado: json['DADO'].toString(),
      nome: json['NOME'].toString(),
      tipo: json['TIPO'].toString(),
      data_hora: json['DATA_HORA'].toString(),
    );
  }

  Map<String, dynamic> toJson() => {
        'fk_id_sensor': fk_id_sensor,
        'dado': dado,
        'nome': nome,
        'tipo': tipo,
        'data_hora': data_hora,
      };
}
