CREATE DATABASE IF NOT EXISTS ECOCLEAR_2;
USE ecoclear_2;

CREATE TABLE IF NOT EXISTS EMPRESA (
	CNPJ VARCHAR(14) NOT NULL PRIMARY KEY,
    RAZAO_SOCIAL VARCHAR(500) NOT NULL,
    DESCRICAO_ATIVIDADE VARCHAR(1000) NOT NULL,
    TELEFONE VARCHAR(30) NOT NULL,
    ENDERECO VARCHAR (1000) NOT NULL,
    SENHA VARCHAR(255) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL 
);

CREATE TABLE IF NOT EXISTS ADMINISTRADOR (
      ID INTEGER AUTO_INCREMENT PRIMARY KEY,
    NOME VARCHAR(255) NOT NULL,
    CPF VARCHAR(11) NOT NULL,
    DATA_NASC DATE NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,                                   
    SENHA VARCHAR(255) NOT NULL, 
    CELULAR VARCHAR(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS POLUENTE (
      ID INTEGER AUTO_INCREMENT PRIMARY KEY,
    DADOS VARCHAR(255) NOT NULL,
    DATA_HORA DATETIME NOT NULL,
    TIPO_POLUENTE VARCHAR(255) NOT NULL 
);
CREATE TABLE IF NOT EXISTS SENSOR (
	ID INTEGER AUTO_INCREMENT PRIMARY KEY, 
    NOME VARCHAR(255) NOT NULL,
    TIPO VARCHAR(255) NOT NULL, 
    LOCALIZACAO VARCHAR(255) NOT NULL,
    STATUS_SENSOR VARCHAR(255) NOT NULL,
    UNIDADE VARCHAR(255) NOT NULL,
    FK_CNPJ_EMPRESA VARCHAR(14) NOT NULL,
    FOREIGN KEY (FK_CNPJ_EMPRESA) REFERENCES EMPRESA(cnpj)
);  
CREATE TABLE IF NOT EXISTS DADO_SENSOR (
      ID INTEGER AUTO_INCREMENT PRIMARY KEY, 
      DADO VARCHAR(2000) NOT NULL,
      DATA_HORA DATETIME NOT NULL,
      FK_ID_SENSOR INTEGER NOT NULL,
	FOREIGN KEY (FK_ID_SENSOR) REFERENCES SENSOR(ID)
);
CREATE TABLE IF NOT EXISTS NOTICIAS (
      ID INTEGER AUTO_INCREMENT PRIMARY KEY,
    TITULO VARCHAR(255) NOT NULL,
    DATA_PUBLICACAO DATETIME NOT NULL,
    IMAGEM BLOB,
    LINK VARCHAR(500) NOT NULL,
    FK_ID_ADMINISTRADOR INTEGER,
    FOREIGN KEY (FK_ID_ADMINISTRADOR) REFERENCES ADMINISTRADOR(ID)
);
CREATE TABLE IF NOT EXISTS RELATORIO (
      ID INTEGER AUTO_INCREMENT PRIMARY KEY,
    TITULO VARCHAR(1000) NOT NULL,
    DATA_HORA DATETIME NOT NULL,
    CONTEUDO TEXT(50000) NOT NULL,
    FK_CNPJ_EMPRESA VARCHAR(14) NOT NULL,
    FOREIGN KEY (FK_CNPJ_EMPRESA) REFERENCES EMPRESA(CNPJ)
);

CREATE TABLE IF NOT EXISTS FEEDBACK (
    ID INTEGER AUTO_INCREMENT PRIMARY KEY, 
    TITULO VARCHAR(1000) NOT NULL,
    DATA_HORA DATETIME NOT NULL,
    CONTEUDO TEXT(50000) NOT NULL,
    FK_CNPJ_EMPRESA VARCHAR(14) NOT NULL,
    FOREIGN KEY (FK_CNPJ_EMPRESA) REFERENCES EMPRESA(CNPJ)
);

CREATE TABLE IF NOT EXISTS FEEDBACK_EMPRESA (
    ID INTEGER AUTO_INCREMENT PRIMARY KEY,
    FK_ID_FEEDBACK INTEGER,
    FK_CNPJ_EMPRESA VARCHAR(14),
    FOREIGN KEY (FK_ID_FEEDBACK) REFERENCES FEEDBACK(ID),
    FOREIGN KEY (FK_CNPJ_EMPRESA) REFERENCES EMPRESA(CNPJ)
);
CREATE TABLE IF NOT EXISTS POLUENTE_SENSOR (
      ID INTEGER AUTO_INCREMENT PRIMARY KEY, 
    FK_SENSOR_ID INTEGER,
    FK_POLUENTE_ID INTEGER,
    FOREIGN KEY (FK_SENSOR_ID) REFERENCES SENSOR(ID),
    FOREIGN KEY (FK_POLUENTE_ID) REFERENCES POLUENTE(ID)
);   
CREATE TABLE IF NOT EXISTS MEDIDAS_SENSOR (
	DADO VARCHAR(255) NOT NULL,
    UNIDADE_MEDIDA VARCHAR(255) NOT NULL,
    DATA DATETIME NOT NULL,
    FK_SENSOR_ID INTEGER 
);
                                                                          
CREATE TABLE IF NOT EXISTS ADMINISTRADOR_EMPRESA (
      ID INTEGER AUTO_INCREMENT PRIMARY KEY,
    FK_ADMINISTRADOR_ID INTEGER, 
    FK_EMPRESA_CNPJ VARCHAR(14),
    FOREIGN KEY (FK_ADMINISTRADOR_ID) REFERENCES ADMINISTRADOR(ID),
    FOREIGN KEY (FK_EMPRESA_CNPJ) REFERENCES EMPRESA(CNPJ)
);

/*10 INSERT PARA CADA TABELA*/

INSERT INTO ADMINISTRADOR
(NOME, CPF, DATA_NASC, EMAIL, SENHA, CELULAR)
VALUES
('Lucas Almeida','98532617422','1990-03-15','lucas@email.com','Xy@3t9pQ','+55 11 97856-4321'),
('Mariana Oliveira','37041268514','1985-07-22','mariana@email.com','9B#sT6wM','+55 21 98432-1567'),
('Rafael Costa','69574185207','1998-11-08','rafael@email.com','Pq*8R5zL','+55 31 99214-7853'),
('Amanda Fernandes','25896314759','2002-05-30','amanda@email.com','7T%wY2xK','+55 41 98123-6479'),
('Bruno Rocha','41785962046','1993-09-14','bruno@email.com','Zm!4Q7nD','+55 51 97658-3021'),
('Camila Souza','12367895403','1987-01-03','camila@email.com','Wv^5T8sP','+55 61 98874-5096'),
('Gabriel Lima','80456932127','1995-08-27','gabriel@email.com','3R@x9N6L','+55 71 99632-8450'),
('Juliana Mendes','69821463710','2000-12-10','juliana@email.com','Bq*7P4mT','+55 81 99321-7685'),
('Ricardo Pereira','52714380935','1983-05-06','ricardo@email.com','8Y%wX3T2','+55 91 98247-6312'),
('Tatiana Silva','31587240692','1992-04-19','tatiana@email.com','Lz!6Q9nD','+55 95 97458-2039');

INSERT INTO NOTICIAS 
(ID, TITULO, DATA_PUBLICACAO, IMAGEM, LINK)
VALUES
(1, 'Notícia Importante', '2025-03-18', 'imagem1.jpg', 'www.link1.com' ),
(2, 'Novo Lançamento', '2025-03-17', 'imagem2.jpg', 'www.link2.com'),
(3, 'Atualização de Sistema', '2025-03-16', 'imagem3.jpg', 'www.link3.com'),
(4, 'Evento Especial', '2025-03-15', 'imagem4.jpg', 'www.link4.com'),
(5, 'Promoção Exclusiva', '2025-03-14', 'imagem5.jpg', 'www.link5.com'),
(6, 'Gás', '2025-03-13', 'imagem6.jpg', 'www.link6.com'),
(7, 'Reunião Anual', '2025-03-12', 'imagem7.jpg', 'www.link7.com'),
(8, 'Mudança de Política', '2025-03-11', 'imagem8.jpg', 'www.link8.com'),
(9, 'Novo Parceiro Comercial', '2025-03-10', 'imagem9.jpg', 'www.link9.com'),
(10, 'Campanha de Marketing', '2025-03-09', 'imagem10.jpg', 'www.link10.com');

INSERT INTO EMPRESA 
(CNPJ, RAZAO_SOCIAL, DESCRICAO_ATIVIDADE, TELEFONE, ENDERECO, SENHA, EMAIL)
VALUES
("32547896000192","TechNova Soluções Tecnológicas Ltda", "Essa empresa realiza ações que envolvem a tecnologia e o meio ambiente, como instalação de painéis solares", "21976543214", "Rua das Flores, 15 – Bairro Centro, Cidade Bela Vista", "f5T$9qXw", "TechNova.@email.com"),
("90813452000105", "SuperMais Comércio de Alimentos Eireli", "Limpeza ecológica de ambientes comerciais", "21976543210", "Av. Central, 88 – Bairro Jardim, Cidade Nova Esperança", "L2#zJm8p", "SuperMais.@email.com"),
("67425183000147","VivaBem Assistência Médica S.A","Desinfecção e higienização de residências","31923456789", "Rua Bela Vista, 12 – Bairro Lago Azul, Cidade Monte Claro", "Xk9!eV2Q","VivaBem.@email.com"),
("14259736000120","MegaMix Distribuidora de Produtos Ltda","Limpeza de carpetes e tapetes com produtos ecológicos", "41987654321", "Rua do Sol, 45 – Bairro Santa Luzia, Cidade Vale Verde", "mT6!oP7v","MegaMix.@email.com"),
("81324675000189","EletroMax Equipamentos Eletrônicos Ltda","Limpeza de vidros e fachadas com técnicas sustentáveis", "51912345678", "Trav. Esperança, 7 – Bairro Morada Feliz, Cidade Campo Sereno", "rW3*Lqz8","EletroMax.@email.com"),
("25039461000178","EcoVerde Sustentabilidade Ambiental Ltda","Descontaminação e limpeza pós obras", "61987654321", "Rua da Paz, 23 – Bairro Planalto, Cidade Horizonte Azul", "D4y@fK6P","EcoVerde.@email.com"),
("73182045000132","Gourmet Express Alimentos e Bebidas Ltda","Limpeza ecológica de áreas externas e jardins", "71923456789", "Av. das Palmeiras, 56 – Bairro Boa Vista, Cidade Pedra Branca", "9pWx!V1R","Gourmet.@email.com"),
("48956372000161","Brilho & Estilo Confecções Ltda","Limpeza de estofados com soluções naturai", "81976543210", "Rua Nova, 19 – Bairro Vila Alegre, Cidade Porto Real", "gH7@aZq3","Brilho.@email.com"),
("35791024000104","Constrular Materiais para Construção Eireli","Limpeza e manutenção de sistemas de ar condicionado", "91912345678", "Rua dos Sonhos, 3 – Bairro Jardim das Flores, Cidade Estrela do Sul", "B2zP4#Ks","Constrular.@email.com"),
("62048519000156","AutoFast Serviços Automotivos Ltda","Serviços de limpeza pós eventos sustentáveis", "11923456789", "Rua Horizonte, 31 – Bairro Bela Morada, Cidade Rio Sereno", "1vF!pQ9u","AutoFast.@email.com");


INSERT INTO FEEDBACK 
(ID, CONTEUDO, DATA_HORA, TITULO, FK_CNPJ_EMPRESA)
VALUES
(1, 'A promoção de verão está ativa, aproveite as ofertas.', '2025-03-17 14:30:00', 'Promoção de Verão','32547896000192'),
(2, 'A empresa agora oferece novos planos de assinatura.', '2025-03-16 09:00:00', 'Novos Planos de Assinatura','90813452000105'),
(3, 'Comunicado sobre o feriado da próxima semana.', '2025-03-15 16:45:00', 'Feriado Nacional','67425183000147'),
(4, 'Detalhes sobre a parceria com fornecedores internacionais.', '2025-03-14 11:20:00', 'Parceria Internacional','14259736000120'),
(5, 'Abertura de novas vagas para colaboradores em diversas áreas.', '2025-03-13 13:10:00', 'Novas Vagas de Emprego','81324675000189'),
(6, 'Mudança nas políticas internas de vendas.', '2025-03-12 15:50:00', 'Mudança nas Políticas de Vendas','25039461000178'),
(7, 'Relatório de desempenho financeiro do último trimestre.', '2025-03-11 17:00:00', 'Desempenho Financeiro','73182045000132'),
(8, 'Início da campanha de marketing de primavera.', '2025-03-10 08:30:00', 'Campanha de Marketing Primavera','48956372000161'),
(9, 'Atualização de protocolos de segurança no trabalho.', '2025-03-09 12:40:00', 'Protocolos de Segurança','35791024000104'),
(10, 'Conteúdo sobre a nova atualização do sistema.', '2025-03-18 10:00:00', 'Atualização de Sistema','62048519000156');

INSERT INTO RELATORIO
(TITULO, DATA_HORA, CONTEUDO, FK_CNPJ_EMPRESA)
VALUES
('Relatório 1', '2025-03-24 10:00:00', 'Muito bom', '32547896000192'),
('Relatório 2', '2025-03-23 14:15:00', 'Relatório com análise preliminar.', '90813452000105'),
('Relatório 3', '2025-03-22 09:30:00', 'Estudo sobre impacto ambiental recente.', '67425183000147'),
('Relatório 4', '2025-03-21 16:45:00', 'Resultados positivos do segundo ciclo.', '14259736000120'),
('Relatório 5', '2025-03-20 11:10:00', 'Levantamento de dados atualizado.', '81324675000189'),
('Relatório 6', '2025-03-19 13:00:00', 'Relatório com foco em sustentabilidade.', '25039461000178'),
('Relatório 7', '2025-03-18 15:25:00', 'Resumo do plano de ações futuras.', '73182045000132'),
('Relatório 8', '2025-03-17 17:50:00', 'Relatório técnico da área de logística.', '48956372000161'),
('Relatório 9', '2025-03-16 08:40:00', 'Análise financeira do trimestre.', '35791024000104'),
('Relatório 10', '2025-03-15 10:20:00', 'Relatório geral com observações finais.', '62048519000156');
INSERT INTO POLUENTE
(DADOS, DATA_HORA, TIPO_POLUENTE)
VALUES
('Mistura de poeira, fuligem, metais pesados, sulfatos e nitratos.', '2025-03-11 14:30:00','Material Particulado '),
('Gás incolor, cheiro forte, irritante. Solúvel em água, formando H₂SO₄ (ácido sulfúrico), liberado pela queima de carvão e petróleo.','2025-02-17 12:20:00','Dióxido de Enxofre (SO₂)'),
('Gás incolor, inodoro, tóxico. Liga-se à hemoglobina, impedindo o transporte de oxigênio no sangue, liberado por motores a combustão e queimadas.','2025-01-30 22:40:00','Monóxido de Carbono (CO)'),
('Gás marrom-avermelhado, tóxico, contribui para a chuva ácida, liberado na queima de combustíveis fósseis.','2025-03-05 18:10:00','Dióxido de Nitrogênio (NO₂)'),
('Gás azulado, com cheiro característico, produzido por reações entre óxidos de nitrogênio (NOₓ) e compostos orgânicos voláteis (COVs) sob ação da luz solar.','2025-02-14 08:50:00','Ozônio (O₃)'),
('Gases ou líquidos que evaporam facilmente, liberado por emissões de combustíveis.','2025-01-27 10:30:00','Compostos Orgânicos Voláteis (COVs)'),
('Gás incolor, cheiro forte e irritante, liberado principalmente na agricultura e indústrias químicas.','2025-03-10 12:50:00','Amônia (NH₃)'),
('Gás incolor com cheiro de ovo podre, liberado pela decomposição de matéria orgânica.','2025-02-24 18:45:00','Hidrogênio Sulfeto (H₂S)'),
('Gás incolor e inodoro, liberado por processos naturais como digestão de ruminantes.','2025-01-19 14:50:00','Metano (CH₄)'),
('Gás incolor e inodoro liberado pela queima de combustíveis fósseis.','2025-03-08 09:25:00','Dióxido de Carbono (CO₂)');

INSERT INTO SENSOR
(NOME,TIPO,LOCALIZACAO,STATUS_SENSOR,UNIDADE,FK_CNPJ_EMPRESA)
VALUES
('AQ-01','Sensor de Gás','São Paulo - SP','Ativo','PPM', '12334567867788');

INSERT INTO SENSOR
(NOME,TIPO,LOCALIZACAO,STATUS_SENSOR,UNIDADE,FK_CNPJ_EMPRESA)
VALUES
('AQ-02','Sensor de Temperatura','Rio de Janeiro - RJ','Inativo','ºC','12345678978676'),
('AQ-03','Sensor de Gás','Belo Horizonte - MG','Manutenção','PPM','15678904324567'),
('AQ-04','Sensor de Temperatura','Curitiba - PR','Ativo','ºC','15678906543245'),
('AQ-05','Sensor de Gás','Porto Alegre - RS','Inativo','PPM','23456789089665'),
('AQ-06','Sensor de Temperatura','Brasília - DF','Ativo','ºC','32547896000192');

select * from empresa; 
select * from sensor;


INSERT INTO DADO_SENSOR
(DADO, DATA_HORA_FK_ID_SENSOR)
VALUES
('410','2025-06-02 10:00:00',4),
('22','2025-05-28 13:30:00',6),
('456','2025-04-30 16:50:00',1),
('26.5','2025-06-03 21:20:00',9),
('444','2025-05:17 12:20:00',8),
('24.8','2025-05-04 09:25:00',10),
('27.3','2025-05-21 14:54:00',3),
('476','2025-04-23 08:12:00',7),
('448','2025-05-30 19:34:00',5),
('25.6','2025-03-21 07:30:00',2);

INSERT INTO POLUENTE_SENSOR
(FK_SENSOR_ID, FK_POLUENTE_ID)
VALUES
('4','1'),
('6','2'),
('1','3'),
('9','4'),
('8','5'),
('10','6'),
('3','7'),
('7','8'),
('5','9'),
('2','10');

SELECT ID FROM ADMINISTRADOR;
INSERT INTO ADMINISTRADOR_EMPRESA
(FK_ADMINISTRADOR_ID, FK_EMPRESA_CNPJ)
VALUES
('1','14259736000120'),
('2','25039461000178'),
('3','32547896000192'),
('4','35791024000104'),
('5','48956372000161'),
('6','62048519000156'),
('7','67425183000147'),
('8','73182045000132'),
('9','81324675000189'),
('10','90813452000105');

/*10 SELECTS PARA CADA TABELA*/
SELECT * FROM ADMINISTRADOR;
SELECT * FROM ADMINISTRADOR WHERE ID=5;
SELECT * FROM ADMINISTRADOR WHERE NOME='Lucas Almeida';
SELECT * FROM ADMINISTRADOR WHERE EMAIL='rafael@email.com';
SELECT * FROM ADMINISTRADOR WHERE SENHA='Zm!4Q7nD';
SELECT * FROM ADMINISTRADOR WHERE DATA_NASC='1992-04-19';
SELECT * FROM ADMINISTRADOR WHERE CELULAR='+55 95 97458-2039';
SELECT * FROM ADMINISTRADOR WHERE CPF='12367895403';
SELECT * FROM ADMINISTRADOR WHERE ID=8;
SELECT * FROM ADMINISTRADOR WHERE NOME='Camila Souza';

SELECT * FROM EMPRESA;
SELECT * FROM EMPRESA WHERE CNPJ='32547896000192';
SELECT * FROM EMPRESA WHERE NOME_FANTASIA='SuperMais';
SELECT * FROM EMPRESA WHERE RAZAO_SOCIAL='VivaBem Assistência Médica S.A';
SELECT  * FROM EMPRESA WHERE BAIRRO='Residencial Monte Azul';
SELECT * FROM EMPRESA WHERE CEP='44012987';
SELECT * FROM EMPRESA WHERE NUMERO='6042';
SELECT * FROM EMPRESA WHERE RUA='Rua das Orquídeas';
SELECT * FROM EMPRESA WHERE CIDADE='Águas Claras';
SELECT * FROM EMPRESA WHERE ESTADO='Lagoa Branca';

SELECT * FROM NOTICIAS;

update noticias
set imagem = "tendencias2025.jpg"
where id=10; 

/*UPDATE NOTICIAS*/
update noticias
set titulo = "Entra em vigor lei que institui Política Nacional de Qualidade do Ar", data_publicacao = "2024-05-03 09:32:00", imagem = "noticia1.jpg", link = "https://www.camara.leg.br/noticias/1058308-entra-em-vigor-lei-que-institui-politica-nacional-de-qualidade-do-ar/"
where id=1;

UPDATE noticias
SET titulo = "O impacto da poluição industrial do ar na mortalidade no Brasil", data_publicacao = "2025-02-04 09:55:00", imagem = "noticia2.jpg", link = "https://www.nexojornal.com.br/externo/2025/02/03/o-impacto-da-poluicao-industrial-do-ar-na-mortalidade-no-brasil"
WHERE ID=2;

update noticias
set titulo = "Estudo reconstrói um século de poluição na cidade de São Paulo", data_publicacao = "2025-04-12 08:00:00", imagem = "noticia3.jpg", link = "https://www.cnnbrasil.com.br/noticias/estudo-reconstroi-um-seculo-de-poluicao-na-cidade-de-sao-paulo/"
where id=3;

update noticias
set titulo = "As cidades brasileiras mais sufocadas: Ranking da poluição do ar", data_publicacao = "2024-11-09 14:03:00", imagem = "noticia4.jpg", link = "https://www.tupi.fm/entretenimento/as-cidades-brasileiras-mais-sufocadas-ranking-da-poluicao-do-ar/"
where id=4;

update noticias 
set titulo = "Painel vai monitorar poluição atmosférica e impactos na saúde humana", data_publicacao = "2024-06-27 15:55:00", imagem = "noticia5.jpg", link = "https://agenciabrasil.ebc.com.br/saude/noticia/2024-06/painel-vai-monitorar-poluicao-atmosferica-e-impactos-na-saude-humana"
where id=5;

update noticias
set titulo = "Córrego na Argentina ganha cor vermelha e gera suspeitas de poluição industrial", data_publicacao = "2025-02-07 21:00:00", imagem = "noticia6.jpg", link = "https://www.meon.com.br/noticias/mundo/corrego-em-avellaneda-argentina-ganha-cor-vermelha-e-gera-suspeitas-de-poluicao-industrial"
where id=6;

update noticias
set titulo = "A primeira poluição 'industrial' do mundo: como a Grécia Antiga liberou chumbo no meio ambiente", data_publicacao = "2025-02-02 13:20:00", imagem = "noticia7.jpg", link = "https://umsoplaneta.globo.com/sociedade/noticia/2025/02/02/a-primeira-poluicao-industrial-do-mundo-como-a-grecia-antiga-liberou-chumbo-no-meio-ambiente.ghtml"
where id=7;

update noticias
set titulo = "Dia do Combate à Poluição: como a química ajuda na preservação ambiental?", data_publicacao = "2024-08-12 15:00", imagem = "noticia8.jpg", link = "https://www.educamaisbrasil.com.br/educacao/noticias/dia-do-combate-a-poluicao-como-a-quimica-ajuda-na-preservacao-ambiental"
where id=8;

update noticias
set titulo = "Brasil é 4º no mundo em ranking de emissão de gases poluentes desde 1850", data_publicacao = "2021-10-27", imagem = "noticia9.jpg", link = "https://www.bbc.com/portuguese/geral-59065359"
where id=9;

update noticias
set titulo = "Cetesb pede ajuda às indústrias para reduzir poluição em Cubatão", data_publicacao = "2024-03-19 10:43:00", imagem = "noticia10.jpg", link = "https://www.diariodolitoral.com.br/cotidiano/cetesb-pede-ajuda-as-industrias-para-reduzir-poluicao-em-cubatao/180175/"
where id=10;

select * from noticias;

/*------*/
ALTER TABLE NOTICIAS
MODIFY COLUMN IMAGEM varchar(500);


SELECT * FROM NOTICIAS WHERE ID=1;
SELECT * FROM NOTICIAS WHERE TITULO='Governo anuncia investimentos em educação';
SELECT * FROM NOTICIAS WHERE DATA_PUBLICACAO='2025-03-16 09:15:00';
SELECT * FROM NOTICIAS WHERE LINK='https://exemplo.com/noticia4';
SELECT * FROM NOTICIAS WHERE FK_ID_ADMINISTRADOR=2;
SELECT * FROM NOTICIAS WHERE ID=6;
SELECT * FROM NOTICIAS WHERE TITULO='Pesquisadores desenvolvem novo material sustentável';
SELECT * FROM NOTICIAS WHERE DATA_PUBLICACAO='2025-03-11 08:30:00';
SELECT * FROM NOTICIAS WHERE LINK='https://exemplo.com/noticia9';

SELECT * FROM POLUENTE;
SELECT * FROM POLUENTE WHERE ID=2;
SELECT * FROM POLUENTE WHERE DADOS='Gás incolor, cheiro forte, irritante. Solúvel em água, formando H₂SO₄ (ácido sulfúrico), liberado pela queima de carvão e petróleo.';
SELECT * FROM POLUENTE WHERE DATA_HORA='2025-01-30 22:40:00';
SELECT * FROM POLUENTE WHERE TIPO_POLUENTE='Dióxido de Nitrogênio (NO₂)';
SELECT * FROM POLUENTE WHERE ID=6;
SELECT * FROM POLUENTE WHERE DADOS='Gases ou líquidos que evaporam facilmente, liberado por emissões de combustíveis.';
SELECT * FROM POLUENTE WHERE DATA_HORA='2025-03-10 12:50:00';
SELECT * FROM POLUENTE WHERE TIPO_POLUENTE='Hidrogênio Sulfeto (H₂S)';
SELECT * FROM POLUENTE WHERE ID=10;
SELECT * FROM SENSOR WHERE TIPO='Sensor de Partículas';

SELECT * FROM SENSOR;
SELECT * FROM SENSOR WHERE ID=1;
SELECT * FROM SENSOR WHERE NOME='AQ-02';
SELECT * FROM SENSOR WHERE TIPO='Sensor de Partículas';
SELECT * FROM SENSOR WHERE LOCALIZACAO='Curitiba - PR';
SELECT * FROM SENSOR WHERE STATUS_SENSOR='Inativo';
SELECT * FROM SENSOR WHERE DATA_HORA='2025-02-09 14:50:00';
SELECT * FROM SENSOR WHERE FK_CNPJ_EMPRESA='73182045000132';
SELECT * FROM SENSOR WHERE ID=8;
SELECT * FROM SENSOR WHERE NOME='AQ-09';

SELECT * FROM POLUENTE_SENSOR;
SELECT * FROM POLUENTE_SENSOR WHERE ID=1;
SELECT * FROM POLUENTE_SENSOR WHERE FK_SENSOR_ID=2;
SELECT * FROM POLUENTE_SENSOR WHERE FK_POLUENTE_ID=4;
SELECT * FROM POLUENTE_SENSOR WHERE ID=4;
SELECT * FROM POLUENTE_SENSOR WHERE FK_SENSOR_ID=5;
SELECT * FROM POLUENTE_SENSOR WHERE FK_POLUENTE_ID=7;
SELECT * FROM POLUENTE_SENSOR WHERE ID=7;
SELECT * FROM POLUENTE_SENSOR WHERE FK_SENSOR_ID=8;
SELECT * FROM POLUENTE_SENSOR WHERE FK_POLUENTE_ID=10;

SELECT * FROM ADMINISTRADOR_EMPRESA;
SELECT * FROM ADMINISTRADOR_EMPRESA WHERE ID=1;
SELECT * FROM ADMINISTRADOR_EMPRESA WHERE FK_ADMINISTRADOR_ID=2;
SELECT * FROM ADMINISTRADOR_EMPRESA WHERE FK_EMPRESA_CNPJ='32547896000192';
SELECT * FROM ADMINISTRADOR_EMPRESA WHERE ID=4;
SELECT * FROM ADMINISTRADOR_EMPRESA WHERE FK_ADMINISTRADOR_ID=5;
SELECT * FROM ADMINISTRADOR_EMPRESA WHERE FK_EMPRESA_CNPJ='62048519000156';
SELECT * FROM ADMINISTRADOR_EMPRESA WHERE ID=7;
SELECT * FROM ADMINISTRADOR_EMPRESA WHERE FK_ADMINISTRADOR_ID=8;
SELECT * FROM ADMINISTRADOR_EMPRESA WHERE FK_EMPRESA_CNPJ='81324675000189';

ALTER TABLE feedback 
DROP COLUMN TITULO,
DROP COLUMN DATA_HORA;

ALTER TABLE feedback drop column CNPJ;

select * from empresa;

select * from sensor;

select * from administrador;