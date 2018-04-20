CREATE TABLE usuario(
id_usuario INT PRIMARY KEY AUTO_INCREMENT,
nomeUser VARCHAR(30) NOT NULL,
funcao VARCHAR(50) NOT NULL,
nivel_acesso INT NOT NULL
)DEFAULT CHARSET=utf8;

INSERT INTO `usuario`(`id_usuario`, `nome`, `funcao`, `nivel_acesso`) VALUES (1,'Aquilla Silva Leite','Professor',1);

CREATE TABLE equipamento(
id_equipamento INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(30) NOT NULL,
fabricante VARCHAR(50) NOT NULL,
quantidade INT NOT NULL,
estoque INT NOT NULL
)DEFAULT CHARSET=utf8;

INSERT INTO `equipamento`(`id_equipamento`, `nome`, `fabricante`, `quantidade`, `estoque`) VALUES (1,'Projetor','Epson',5,5);

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

INSERT INTO `reservar`(`id_reservar`, `data_reserva`, `hora_inicio`, `hora_fim`, `periodo`, `curso`, `sala`, `fk_usuario`, `fk_equipamento`) VALUES (0,'20/04/2018', '18:00','18:40',7,'Ciência Da Computação',9,1,1);  

