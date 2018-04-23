CREATE TABLE usuario(
id_usuario INT PRIMARY KEY AUTO_INCREMENT,
nome_usuario VARCHAR(255) NOT NULL,
email_usuario VARCHAR(255) UNIQUE NOT NULL,
senha_usuario VARCHAR(255) NOT NULL,
cargo_usuario VARCHAR(50) NOT NULL,
nivel_acesso INT NOT NULL
);

CREATE TABLE equipamento(
id_equipamento INT PRIMARY KEY AUTO_INCREMENT,
nome_equipamento VARCHAR(255) NOT NULL,
fabricante_equipamento VARCHAR(50) NOT NULL,
quantidade_equipamento INT NOT NULL,
patrimonio_equipamento INT NOT NULL
);

CREATE TABLE reservar(
id_reservar INT PRIMARY KEY AUTO_INCREMENT,
data_reserva VARCHAR(255) NOT NULL,
hora_inicio VARCHAR(255) NOT NULL,
hora_fim VARCHAR(255) NOT NULL,
semestre VARCHAR(255) NOT NULL,
curso VARCHAR(255) NOT NULL,
sala VARCHAR(255) NOT NULL,
periodo VARCHAR(255) NOT NULL,
fk_usuario INT NOT NULL,
fk_equipamento INT NOT NULL,
CONSTRAINT `fk_id_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`),
CONSTRAINT `fk_id_equipamento` FOREIGN KEY (`fk_equipamento`) REFERENCES `equipamento` (`id_equipamento`)
);

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `cargo_usuario`, `nivel_acesso`) VALUES (1, 'Aquilla Silva Leite', 'aquilla11@hotmail.com', '71eea47ff018db4456aa926d911ceba6f33f4f3d', 'Administrador do Sistema', 0);

