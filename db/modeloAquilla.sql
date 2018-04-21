CREATE TABLE usuario(
id_usuario INT PRIMARY KEY AUTO_INCREMENT,
nome_usuario VARCHAR(30) NOT NULL,
email_usuario VARCHAR(30) NOT NULL,
senha_usuario VARCHAR(30) NOT NULL,
funcao_usuario VARCHAR(50) NOT NULL,
nivel_acesso INT NOT NULL
)DEFAULT CHARSET=utf8;

INSERT INTO `usuario`(`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `funcao_usuario`, `nivel_acesso`) VALUES (1,'Aquilla Silva Leite', 'aquilla11@hotmail.com', '123', 'Professor',1);

CREATE TABLE equipamento(
id_equipamento INT PRIMARY KEY AUTO_INCREMENT,
nome_equipamento VARCHAR(30) NOT NULL,
fabricante_equipamento VARCHAR(50) NOT NULL,
quantidade_equipamento INT NOT NULL,
patrimonio_equipamento INT NOT NULL,
)DEFAULT CHARSET=utf8;

INSERT INTO `equipamento`(`id_equipamento`, `nome_equipamento`, `fabricante_equipamento`, `quantidade_equipamento`, `patrimonio_equipamento`) VALUES (1,'Projetor','Epson',5,2959);
INSERT INTO `equipamento`(`id_equipamento`, `nome_equipamento`, `fabricante_equipamento`, `quantidade_equipamento`, `patrimonio_equipamento`) VALUES (2,'Switch','Cisco',5,2960);
INSERT INTO `equipamento`(`id_equipamento`, `nome_equipamento`, `fabricante_equipamento`, `quantidade_equipamento`, `patrimonio_equipamento`) VALUES (3,'Roteador','D-link',5,2961);

CREATE TABLE reservar(
id_reservar INT PRIMARY KEY AUTO_INCREMENT,
data_reserva VARCHAR(30) NOT NULL,
hora_inicio VARCHAR(30) NOT NULL,
hora_fim VARCHAR(30) NOT NULL,
semestre VARCHAR(30) NOT NULL,
curso VARCHAR(30) NOT NULL,
sala VARCHAR(30) NOT NULL,
periodo VARCHAR(30) NOT NULL,
fk_usuario INT NOT NULL,
fk_equipamento INT NOT NULL,
CONSTRAINT `fk_id_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`),
CONSTRAINT `fk_id_equipamento` FOREIGN KEY (`fk_equipamento`) REFERENCES `equipamento` (`id_equipamento`)
)DEFAULT CHARSET=utf8;

INSERT INTO `reservar`(`id_reservar`, `data_reserva`, `hora_inicio`, `hora_fim`, `semestre`, `curso`, `sala`, `periodo`, `fk_usuario`, `fk_equipamento`) VALUES (1,'2018-04-20', '1° Aula','2° Aula',7,'Ciência Da Computação',9,'Noturno',1,1);

