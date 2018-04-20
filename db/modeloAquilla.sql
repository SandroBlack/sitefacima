CREATE TABLE usuario(
id_usuario INT PRIMARY KEY AUTO_INCREMENT,
nomeUser VARCHAR(30) NOT NULL,
senha VARCHAR(30) NOT NULL,
funcao VARCHAR(50) NOT NULL,
nivel_acesso INT NOT NULL
)DEFAULT CHARSET=utf8;

INSERT INTO `usuario`(`id_usuario`, `nomeUser`, `senha`, `funcao`, `nivel_acesso`) VALUES (1,'Aquilla Silva Leite', '123', 'Professor',1);
INSERT INTO `usuario`(`id_usuario`, `nomeUser`, `senha`, `funcao`, `nivel_acesso`) VALUES (2,'Elissandro Santos', '123', 'Analista de TI',1);
INSERT INTO `usuario`(`id_usuario`, `nomeUser`, `senha`, `funcao`, `nivel_acesso`) VALUES (3,'Joseano Junior', '123', 'Estagiário',1);

CREATE TABLE equipamento(
id_equipamento INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(30) NOT NULL,
fabricante VARCHAR(50) NOT NULL,
quantidade INT NOT NULL,
estoque INT NOT NULL
)DEFAULT CHARSET=utf8;

INSERT INTO `equipamento`(`id_equipamento`, `nome`, `fabricante`, `quantidade`, `estoque`) VALUES (1,'Projetor','Epson',5,5);
INSERT INTO `equipamento`(`id_equipamento`, `nome`, `fabricante`, `quantidade`, `estoque`) VALUES (2,'Switch','Cisco',5,5);
INSERT INTO `equipamento`(`id_equipamento`, `nome`, `fabricante`, `quantidade`, `estoque`) VALUES (3,'Roteador','D-link',5,5);

CREATE TABLE reservar(
id_reservar INT PRIMARY KEY AUTO_INCREMENT,
data_reserva VARCHAR(80) NOT NULL,
hora_inicio VARCHAR(80) NOT NULL,
hora_fim VARCHAR(80) NOT NULL,
periodo VARCHAR(80) NOT NULL,
curso VARCHAR(80) NOT NULL,
sala VARCHAR(80) NOT NULL,
fk_usuario INT NOT NULL,
fk_equipamento INT NOT NULL,
CONSTRAINT `fk_id_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`),
CONSTRAINT `fk_id_equipamento` FOREIGN KEY (`fk_equipamento`) REFERENCES `equipamento` (`id_equipamento`)
)DEFAULT CHARSET=utf8;

INSERT INTO `reservar`(`id_reservar`, `data_reserva`, `hora_inicio`, `hora_fim`, `periodo`, `curso`, `sala`, `fk_usuario`, `fk_equipamento`) VALUES (0,'2018-04-20', '1° Aula','2° Aula',7,'Ciência Da Computação',9,1,1);
INSERT INTO `reservar`(`id_reservar`, `data_reserva`, `hora_inicio`, `hora_fim`, `periodo`, `curso`, `sala`, `fk_usuario`, `fk_equipamento`) VALUES (0,'2018-04-20', '1° Aula','3° Aula',7,'Ciência Da Computação',9,1,1);
INSERT INTO `reservar`(`id_reservar`, `data_reserva`, `hora_inicio`, `hora_fim`, `periodo`, `curso`, `sala`, `fk_usuario`, `fk_equipamento`) VALUES (0,'2018-04-20', '1° Aula','4° Aula',7,'Ciência Da Computação',9,1,1);

