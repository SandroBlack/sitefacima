/* MODELO LÓGICO BANCO SITE FACIMA */

/* BASE DE DADOS 
CREATE DATABASE sitefacima
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;*/

/* TABELAS */

/* Tabela Administração*/
CREATE TABLE administracao(
idadmin INT PRIMARY KEY AUTO_INCREMENT,
rg INT UNIQUE NOT NULL,
nome VARCHAR(30) NOT NULL
)DEFAULT CHARSET=utf8;

/* Tabela Professor */
CREATE TABLE professor(
idprofessor INT PRIMARY KEY AUTO_INCREMENT,
rg INT UNIQUE NOT NULL,
nome VARCHAR(30) NOT NULL,
sexo ENUM('M', 'F') NOT NULL,
titulacao VARCHAR(20) NOT NULL
)DEFAULT CHARSET=utf8;

/* Tabela Alocado */
CREATE TABLE alocado(
idalocado INT PRIMARY KEY AUTO_INCREMENT,
id_professor INT NOT NULL,
id_curso INT NOT NULL
)DEFAULT CHARSET=utf8;

/* Tabela Curso */
CREATE TABLE curso(
idcurso INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(30) NOT NULL,
descricao VARCHAR(100),
valor FLOAT(5,2) NOT NULL,
instituicao ENUM('FACIMA','IESA') NOT NULL
)DEFAULT CHARSET=utf8;

/* Tabela Funciona */
CREATE TABLE funciona(
idfunciona INT PRIMARY KEY AUTO_INCREMENT,
id_curso INT NOT NULL,
id_periodo INT NOT NULL
);

/* Tabela Período */
CREATE TABLE periodo(
idperiodo INT PRIMARY KEY AUTO_INCREMENT,
nome ENUM('1º','2º','3º','4º','5º')
)DEFAULT CHARSET=utf8;

/* Tabela Aluno */
CREATE TABLE aluno(
ra INT PRIMARY KEY AUTO_INCREMENT,
rg INT UNIQUE NOT NULL,
nome VARCHAR(30) NOT NULL,
sexo ENUM('M','F'),
id_curso INT NOT NULL
)DEFAULT CHARSET=utf8;

/* Tabela Realizado */
CREATE TABLE realizado(
idrealizado INT PRIMARY KEY AUTO_INCREMENT,
id_curso INT NOT NULL,
id_sala INT NOT NULL
)DEFAULT CHARSET=utf8;

/* Tabela Sala */
CREATE TABLE sala(
idsala INT PRIMARY KEY AUTO_INCREMENT,
local ENUM('TERREO','1º ANDAR') NOT NULL,
qtd_carteiras INT NOT NULL
)DEFAULT CHARSET=utf8;

/* Tabela Reservado */
CREATE TABLE reservado(
idreservado INT PRIMARY KEY AUTO_INCREMENT,
id_equipamento INT NOT NULL,
id_sala INT NOT NULL
)DEFAULT CHARSET=utf8;

/* Tabela Equipamento */
CREATE TABLE equipamento(
idequipamento INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(20) NOT NULL,
fabricante VARCHAR(20) NOT NULL,
estoque INT NOT NULL
)DEFAULT CHARSET=utf8;

/* Tabela Reserva */
CREATE TABLE reserva(
idreserva INT PRIMARY KEY AUTO_INCREMENT,
data TIMESTAMP NOT NULL,
horario1 ENUM('19:15-19:40','19:40-20:30'),
horario2 ENUM('20:45-21:10','21:10-22:00'),
id_professor INT NOT NULL,
id_equipamento INT NOT NULL
)DEFAULT CHARSET=utf8;

/* Tabela Administração */


/*---------------------------------------------------------------*/

/* CHAVES ESTRAGEIRAS */

/* Tabela alocado */
ALTER TABLE alocado ADD CONSTRAINT FK_id_professor1
FOREIGN KEY(id_professor) REFERENCES professor(idprofessor);
ALTER TABLE alocado ADD CONSTRAINT FK_id_curso1
FOREIGN KEY(id_curso) REFERENCES curso(idcurso);

/* Tabela Funciona */
ALTER TABLE funciona ADD CONSTRAINT FK_id_curso2
FOREIGN KEY(id_curso) REFERENCES curso(idcurso);
ALTER TABLE funciona ADD CONSTRAINT FK_id_periodo
FOREIGN KEY(id_periodo) REFERENCES periodo(idperiodo);

/* Tabela Aluno */
ALTER TABLE aluno ADD CONSTRAINT FK_id_id_curso3
FOREIGN KEY(id_curso) REFERENCES curso(idcurso);

/* Tabela realizado */
ALTER TABLE realizado ADD CONSTRAINT FK_id_curso4
FOREIGN KEY(id_curso) REFERENCES curso(idcurso);
ALTER TABLE realizado ADD CONSTRAINT FK_id_sala1
FOREIGN KEY(id_sala) REFERENCES sala(idsala);


/* Tabela Reservado */
ALTER TABLE reservado ADD CONSTRAINT FK_id_sala2
FOREIGN KEY(id_sala) REFERENCES sala(idsala);
ALTER TABLE reservado ADD CONSTRAINT FK_id_equipamento2
FOREIGN KEY(id_equipamento) REFERENCES equipamento(idequipamento);  

/* Tabela Reserva */
ALTER TABLE reserva ADD CONSTRAINT FK_id_professor2
FOREIGN KEY(id_professor) REFERENCES professor(idprofessor);
ALTER TABLE reserva ADD CONSTRAINT FK_id_equipamento3
FOREIGN KEY(id_equipamento) REFERENCES equipamento(idequipamento);

/*------------------------------------------------------------------*/

/* ADICIONANDO REGISTROS PARA TESTE */

/* Tabela Administração*/
INSERT INTO administracao(rg,nome)
VALUES(1,'André'),
	  (2,'Pedro'),
	  (3,'Laura');

/* Tabela Professor */
INSERT INTO professor(rg,nome,sexo,titulacao) 
VALUES(1,'Ronaldo Fernandes','M','Especialista'),
	  (2,'Ramom Tenório','M','Especialista'),
      (3,'Valdick Sales','M','Mestre');

/* Tabela Curso */
INSERT INTO curso(nome,descricao,valor,instituicao)
VALUES('Ciência da Computação','Curso de Tecnologia',600,'FACIMA'),
      ('Administração','Administração em Geral',500,'IESA'),
      ('Direito','Direito em Geral',850,'FACIMA');

/* Tabela Período */
INSERT INTO periodo(nome)
VALUES('1º'),
      ('2º'),
      ('3º'),
      ('4º'),
      ('5º');

/* Tabela Aluno */
INSERT INTO aluno(rg,nome,sexo,id_curso)
VALUES(1,'Joseano Junior','M',1),
      (2,'José da Silva','M',2),
      (3,'Laura Maria','F',3);

/* Tabela Sala */
INSERT INTO sala(local,qtd_carteiras)
VALUES('Terreo',30),
      ('1º Andar',25),
      ('Terreo',20);

/* Tabela Equipamento */
INSERT INTO equipamento(nome,fabricante,estoque)
VALUES('Projetor','Epson',5),
      ('Notebook','Positivo',3),
      ('Caixa de Som','Sony',2);