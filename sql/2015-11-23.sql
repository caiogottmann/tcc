create database tcc;

use tcc;

create table usuario (
	usuario_id_usuario int auto_increment not null,
	usuario_nome varchar(100) not null,
	usuario_cpf varchar(14),
	usuario_rg varchar(12) ,
	usuario_email varchar(100) not null,
	usuario_tel varchar(15),
	usuario_cel varchar(16),
	usuario_id_end int not null,
	usuario_id_arduino int not null,
	usuario_id_login int not null,
	usuario_situacao enum('A','I') not null,
	primary key(usuario_id_usuario)

)engine = innoDB;


create table funcionario (
	func_id_func int auto_increment not null,
	func_id_usuario int not null,
	func_id_tipoFunc int not null,
	func_situacao enum('A','I') not null,
	primary key(func_id_func)
	
)engine = innoDB;

create table tipoFuncionario (
	tipoFunc_id_tipoFunc int auto_increment not null,
	tipoFunc_tipo varchar(150) not null,
	tipoFunc_obs text,
	tipoFunc_situacao enum('A','I') not null,
	primary key(tipoFunc_id_tipoFunc)

)engine = innoDB;

create table endereco (
	end_id_end int auto_increment not null,
	end_rua varchar(100) not null,
	end_bairro varchar(100) not null,
	end_numero int not null,
	end_complemento varchar(100),
	end_id_estado int not null,
	primary key(end_id_end)

)engine = innoDB;

create table arduino (
	arduino_id_arduino int auto_increment not null,
	arduino_rfid varchar(20) not null unique,
	arduino_senha varchar(20) not null unique,
	arduino_situacao enum('A','I') not null,
	primary key(arduino_id_arduino)

)engine = innoDB;

create table login (
	login_id_login int auto_increment not null,
	login_usuario varchar(100) not null unique,
	login_senha varchar(100) not null,
	login_pags text not null,
	login_id_pags int not null,
	login_situacao enum('A','I') not null,
	primary key(login_id_login)

)engine = innoDB;

create table estado (
	estado_id_estado int auto_increment not null,
	estado_nome varchar(100) not null,
	estado_sigla char(2) not null,
	primary key(estado_id_estado)

)engine = innoDB;

create table visitante
(
	vis_id_vis int auto_increment not null,
	vis_id_usuario int not null,
	vis_nome varchar(100) not null,
	vis_cpf varchar(14),
	vis_rg varchar(12),
	vis_tel int,
	vis_data datetime not null,
	primary key(vis_id_vis)
	
)engine = innoDB;

create table logEntrada
(
	logEntrada_id_logEntrada int auto_increment not null,
	logEntrada_id_usuario int not null,
	logEntrada_id_tipo int not null, 
	logEntrada_data datetime not null,
	primary key(logEntrada_id_logEntrada)
	
)engine = innoDB;

create table logAlt
(
	logAlt_id_logAlt int auto_increment not null,
	logAlt_id_usuario int not null,
	logAlt_nivel int not null, 
	logAlt_pag varchar(100) not null,
	logAlt_dataAlt datetime not null,
	logAlt_alteracao varchar(200) not null,
	logAlt_ip varchar(100) not null,
	primary key(logAlt_id_logAlt)
	
)engine = innoDB;


create table cookie
(
	cookie_id_cookie int auto_increment not null,
	cookie_id_login int not null,
	cookie_valor varchar(21) not null,
	cookie_data_expira datetime not null,
	primary key(cookie_id_cookie)
	
)engine = innoDB;

create table recuperarSenha
(
	rec_id_recuperarSenha int auto_increment not null,
	rec_id_usuario int not null,
	rec_chave varchar(100) not null,
	rec_data datetime not null,
	primary key(rec_id_recuperarSenha)
)engine = innoDB;

create table pagina (
	pags_id_pags int auto_increment not null,
	pags_nome varchar(30) not null,
	pags_apelido varchar(30) not null,
	pags_situacao enum('A','I') not null,
	primary key(pags_id_pags)
)engine = innoDB;

create table correio
(
	correio_id_correio int auto_increment not null,
	correio_id_usuario int not null,
	correio_nome_correio varchar(100) not null,
	correio_rg_correio varchar(12) not null,
	correio_empre_correio varchar(100),
	correio_data datetime not null,
	correio_situacao enum('A','I','P') not null,
	primary key(correio_id_correio)
)engine = innoDB;

create table areaComum (
	ac_id_ac int auto_increment not null,
	ac_nome varchar(50) not null,
	ac_situacao enum('A','I') not null,
	primary key(ac_id_ac)
)engine = innoDB;

create table aluguel (
	al_id_al int auto_increment not null,
	al_id_usuario int not null,
	al_id_ac int not null,
	al_data date not null,
	al_situacao enum('A','I','P') not null,
	primary key(al_id_al)
)engine = innoDB;

create table grupo (
	gp_id_gp int auto_increment not null,
	gp_grupo varchar(100) not null,
	gp_users text ,
	gp_id_pags text ,
	gp_situacao enum('A','I') not null,
	primary key(gp_id_gp)
)engine = innoDB;

create table fluxo (
	fluxo_id_fluxo int auto_increment not null,
	fluxo_id_usuario int not null,
	fluxo_horario datetime not null,
	fluxo_situacao enum('A','I') not null,
	primary key(fluxo_id_fluxo)
)engine = innoDB;



ALTER TABLE usuario ADD CONSTRAINT FK_usuario_id_end FOREIGN KEY ( usuario_id_end ) REFERENCES endereco ( end_id_end );
ALTER TABLE usuario ADD CONSTRAINT FK_usuario_id_arduino FOREIGN KEY ( usuario_id_arduino ) REFERENCES arduino ( arduino_id_arduino );
ALTER TABLE usuario ADD CONSTRAINT FK_usuario_id_login FOREIGN KEY ( usuario_id_login ) REFERENCES login ( login_id_login );

ALTER TABLE funcionario ADD CONSTRAINT FK_func_id_usuario FOREIGN KEY ( func_id_usuario ) REFERENCES usuario ( usuario_id_usuario );
ALTER TABLE funcionario ADD CONSTRAINT FK_func_id_tipoFunc FOREIGN KEY ( func_id_tipofunc ) REFERENCES tipoFuncionario ( tipoFunc_id_tipoFunc );

ALTER TABLE endereco ADD CONSTRAINT FK_end_id_estado FOREIGN KEY ( end_id_estado ) REFERENCES estado ( estado_id_estado );

ALTER TABLE visitante ADD CONSTRAINT FK_vis_id_usuario FOREIGN KEY ( vis_id_usuario ) REFERENCES usuario ( usuario_id_usuario );

ALTER TABLE logEntrada ADD CONSTRAINT FK_logEntrada_id_usuario FOREIGN KEY ( logEntrada_id_usuario ) REFERENCES usuario ( usuario_id_usuario );

ALTER TABLE logAlt ADD CONSTRAINT FK_logAlt_id_usuario FOREIGN KEY ( logAlt_id_usuario ) REFERENCES usuario ( usuario_id_usuario );

ALTER TABLE cookie ADD CONSTRAINT FK_cookie_id_login FOREIGN KEY ( cookie_id_login ) REFERENCES login ( login_id_login );

ALTER TABLE recuperarSenha ADD CONSTRAINT FK_rec_id_usuario FOREIGN KEY ( rec_id_usuario ) REFERENCES usuario ( usuario_id_usuario );

ALTER TABLE correio ADD CONSTRAINT FK_correio_id_usuario FOREIGN KEY ( correio_id_usuario ) REFERENCES usuario ( usuario_id_usuario );

ALTER TABLE aluguel ADD CONSTRAINT FK_al_id_usuario FOREIGN KEY ( al_id_usuario ) REFERENCES usuario ( usuario_id_usuario );
ALTER TABLE aluguel ADD CONSTRAINT FK_al_id_ac FOREIGN KEY ( al_id_ac ) REFERENCES areaComum ( ac_id_ac );

ALTER TABLE fluxo ADD CONSTRAINT FK_fluxo_id_usuario FOREIGN KEY ( fluxo_id_usuario ) REFERENCES usuario ( usuario_id_usuario );


INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('1', 'Acre', 'AC');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('2', 'Alagoas', 'AL');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('3', 'Amapá', 'AP');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('4', 'Amazonas', 'AM');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('5', 'Bahia', 'BA');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('6', 'Ceará', 'CE');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('7', 'Distrito Federal', 'DF');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('8', 'Espírito Santo', 'ES');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('9', 'Goiás', 'GO');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('10', 'Maranhão', 'MA');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('11', 'Mato Grosso', 'MT');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('12', 'Mato Grosso do Sul', 'MS');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('13', 'Minas Gerais', 'MG');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('14', 'Pará', 'PA');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('15', 'Paraíba', 'PB');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('16', 'Paraná', 'PR');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('17', 'Pernambuco', 'PE');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('18', 'Piauí', 'PI');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('19', 'Rio de Janeiro', 'RJ');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('20', 'Rio Grande do Norte', 'RN');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('21', 'Rio Grande do Sul', 'RS');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('22', 'Rondônia', 'RO');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('23', 'Roraima', 'RR');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('24', 'Santa Catarina', 'SC');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('25', 'São Paulo', 'SP');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('26', 'Sergipe', 'SE');	 
INSERT INTO estado (estado_id_estado, estado_nome, estado_sigla) VALUES ('27', 'Tocantins', 'TO');


INSERT INTO `arduino`(`arduino_id_arduino`, `arduino_rfid`, `arduino_senha`, `arduino_situacao`) VALUES ('1','4131d60e','1234A','A');
INSERT INTO `arduino`(`arduino_id_arduino`, `arduino_rfid`, `arduino_senha`, `arduino_situacao`) VALUES ('2','4131d60f','1234B','A');
INSERT INTO `arduino`(`arduino_id_arduino`, `arduino_rfid`, `arduino_senha`, `arduino_situacao`) VALUES ('3','4131d60g','1234C','A');
INSERT INTO `arduino`(`arduino_id_arduino`, `arduino_rfid`, `arduino_senha`, `arduino_situacao`) VALUES ('4','4131d60c','1234D','A');
INSERT INTO `arduino`(`arduino_id_arduino`, `arduino_rfid`, `arduino_senha`, `arduino_situacao`) VALUES ('5','4131d60h','6789A','A');
INSERT INTO `arduino`(`arduino_id_arduino`, `arduino_rfid`, `arduino_senha`, `arduino_situacao`) VALUES ('6','4131d60i','6789B','A');
INSERT INTO `arduino`(`arduino_id_arduino`, `arduino_rfid`, `arduino_senha`, `arduino_situacao`) VALUES ('7','4131d60j','6789C','A');

INSERT INTO `endereco` (`end_id_end`,  `end_rua`, `end_bairro`, `end_numero`, `end_complemento`, `end_id_estado`) VALUES ('1', 'R: bla', 'teste', '71', 'Casa', '25');
INSERT INTO `endereco` (`end_id_end`,  `end_rua`, `end_bairro`, `end_numero`, `end_complemento`, `end_id_estado`) VALUES ('2', 'R: bla', 'teste', '71', 'Casa', '25');
INSERT INTO `endereco` (`end_id_end`,  `end_rua`, `end_bairro`, `end_numero`, `end_complemento`, `end_id_estado`) VALUES ('3', 'R: bla', 'teste', '71', 'Casa', '25');
INSERT INTO `endereco` (`end_id_end`,  `end_rua`, `end_bairro`, `end_numero`, `end_complemento`, `end_id_estado`) VALUES ('4', 'R: bla', 'teste', '71', 'Casa', '25');
INSERT INTO `endereco` (`end_id_end`,  `end_rua`, `end_bairro`, `end_numero`, `end_complemento`, `end_id_estado`) VALUES ('5', 'R: bla', 'teste', '71', 'Casa', '25');
INSERT INTO `endereco` (`end_id_end`,  `end_rua`, `end_bairro`, `end_numero`, `end_complemento`, `end_id_estado`) VALUES ('6', 'R: bla', 'teste', '71', 'Casa', '25');
INSERT INTO `endereco` (`end_id_end`,  `end_rua`, `end_bairro`, `end_numero`, `end_complemento`, `end_id_estado`) VALUES ('7', 'R: bla', 'teste', '71', 'Casa', '25');

INSERT INTO `pagina` (`pags_id_pags`, `pags_nome`, `pags_apelido`, `pags_situacao`) VALUES ('1', 'Administracao', 'Inicio', 'A');
INSERT INTO `pagina` (`pags_id_pags`, `pags_nome`, `pags_apelido`, `pags_situacao`) VALUES ('2', 'Administracao/usuarios', 'Usuários', 'A');
INSERT INTO `pagina` (`pags_id_pags`, `pags_nome`, `pags_apelido`, `pags_situacao`) VALUES ('3', 'Administracao/tipoFuncionarios', 'Tipo Funcionários', 'A');
INSERT INTO `pagina` (`pags_id_pags`, `pags_nome`, `pags_apelido`, `pags_situacao`) VALUES ('4', 'Administracao/minhaConta', 'Minha Conta', 'A');
INSERT INTO `pagina` (`pags_id_pags`, `pags_nome`, `pags_apelido`, `pags_situacao`) VALUES ('5', 'Funcionario', 'Funcionários', 'A');
INSERT INTO `pagina` (`pags_id_pags`, `pags_nome`, `pags_apelido`, `pags_situacao`) VALUES ('6', 'Correio', 'Realtorio de Entregas', 'A');
INSERT INTO `pagina` (`pags_id_pags`, `pags_nome`, `pags_apelido`, `pags_situacao`) VALUES ('7', 'AreaComum', 'Área Comum', 'A');
INSERT INTO `pagina` (`pags_id_pags`, `pags_nome`, `pags_apelido`, `pags_situacao`) VALUES ('8', 'Pagina', 'Atribuir Paginas', 'A');
INSERT INTO `pagina` (`pags_id_pags`, `pags_nome`, `pags_apelido`, `pags_situacao`) VALUES ('9', 'Visitante', 'Visitante', 'A');
INSERT INTO `pagina` (`pags_id_pags`, `pags_nome`, `pags_apelido`, `pags_situacao`) VALUES ('10', 'Fluxo', 'Fluxo', 'A');
INSERT INTO `pagina` (`pags_id_pags`, `pags_nome`, `pags_apelido`, `pags_situacao`) VALUES ('11', 'Correio/pendente', 'Entregas Pendentes', 'A');
INSERT INTO `pagina` (`pags_id_pags`, `pags_nome`, `pags_apelido`, `pags_situacao`) VALUES ('12', 'areaComum/cadastro', 'Nova Area Comum', 'A');


INSERT INTO `login` (`login_id_login`, `login_usuario`, `login_senha`, `login_pags`, `login_id_pags`, `login_situacao`) VALUES ('1', 'jose', '202cb962ac59075b964b07152d234b70', '2|5|3|6|11|12|7|8|9|10|4', '1', 'A');
INSERT INTO `login` (`login_id_login`, `login_usuario`, `login_senha`, `login_pags`, `login_id_pags`, `login_situacao`) VALUES ('2', 'caio', '202cb962ac59075b964b07152d234b70', '2|4', '1', 'A');
INSERT INTO `login` (`login_id_login`, `login_usuario`, `login_senha`, `login_pags`, `login_id_pags`, `login_situacao`) VALUES ('3', 'bruno', '202cb962ac59075b964b07152d234b70', '2|4', '1', 'A');
INSERT INTO `login` (`login_id_login`, `login_usuario`, `login_senha`, `login_pags`, `login_id_pags`, `login_situacao`) VALUES ('4', 'jessica', '202cb962ac59075b964b07152d234b70', '2|4', '1', 'A');
INSERT INTO `login` (`login_id_login`, `login_usuario`, `login_senha`, `login_pags`, `login_id_pags`, `login_situacao`) VALUES ('5', 'pedro', '202cb962ac59075b964b07152d234b70', '2|4', '1', 'A');
INSERT INTO `login` (`login_id_login`, `login_usuario`, `login_senha`, `login_pags`, `login_id_pags`, `login_situacao`) VALUES ('6', 'antonio', '202cb962ac59075b964b07152d234b70', '2|4', '1', 'A');
INSERT INTO `login` (`login_id_login`, `login_usuario`, `login_senha`, `login_pags`, `login_id_pags`, `login_situacao`) VALUES ('7', 'lucas', '202cb962ac59075b964b07152d234b70', '2|4', '1', 'A');

INSERT INTO `usuario` (`usuario_id_usuario`, `usuario_nome`,  `usuario_cpf`, `usuario_rg`, `usuario_email`, `usuario_tel`, `usuario_cel`, `usuario_id_end`, `usuario_id_arduino`, `usuario_id_login`,  `usuario_situacao`) VALUES ('1', 'Jose de Arimateia Neves Junior',  '471.431.341-04', '46.999.444-6', 'contato@jnevesjunior.com.br', '(012) 98122-5040', '(012) 98867-4050', '1', '1', '1', 'A');
INSERT INTO `usuario` (`usuario_id_usuario`, `usuario_nome`,  `usuario_cpf`, `usuario_rg`, `usuario_email`, `usuario_tel`, `usuario_cel`, `usuario_id_end`, `usuario_id_arduino`, `usuario_id_login`,  `usuario_situacao`) VALUES ('2', 'Caio Gottmann',  '875.559.481-68', '56.555.343-7', 'caio_gott@hotmail.com', '(012) 3912-0998', '(012) 98874-9050', '2', '2', '2', 'A');
INSERT INTO `usuario` (`usuario_id_usuario`, `usuario_nome`,  `usuario_cpf`, `usuario_rg`, `usuario_email`, `usuario_tel`, `usuario_cel`, `usuario_id_end`, `usuario_id_arduino`, `usuario_id_login`,  `usuario_situacao`) VALUES ('3', 'Bruno Henrique',  '339.092.451-53', '16.585.363-7', 'bruno@gmail.com', '(012) 3912-4587', '(012) 98812-0332', '3', '3', '3', 'A');
INSERT INTO `usuario` (`usuario_id_usuario`, `usuario_nome`,  `usuario_cpf`, `usuario_rg`, `usuario_email`, `usuario_tel`, `usuario_cel`, `usuario_id_end`, `usuario_id_arduino`, `usuario_id_login`,  `usuario_situacao`) VALUES ('4', 'Jessica Almeida',  '444.565.901-06', '12.851.393-7', 'jessica@hotmail.com', '(012) 3912-4211', '(012) 98164-0120', '4', '4', '4', 'A');
INSERT INTO `usuario` (`usuario_id_usuario`, `usuario_nome`,  `usuario_cpf`, `usuario_rg`, `usuario_email`, `usuario_tel`, `usuario_cel`, `usuario_id_end`, `usuario_id_arduino`, `usuario_id_login`,  `usuario_situacao`) VALUES ('5', 'Pedro Henrique',  '188.729.307-82', '12.875.303-7', 'pedro@hotmail.com', '(012) 3912-0943', '(012) 98113-9121', '5', '5', '5', 'A');
INSERT INTO `usuario` (`usuario_id_usuario`, `usuario_nome`,  `usuario_cpf`, `usuario_rg`, `usuario_email`, `usuario_tel`, `usuario_cel`, `usuario_id_end`, `usuario_id_arduino`, `usuario_id_login`,  `usuario_situacao`) VALUES ('6', 'Antonio Carlos',  '926.358.811-20', '12.743.143-7', 'antonio@hotmail.com', '(012) 3912-9812', '(012) 97734-0112', '6', '6', '6', 'A');
INSERT INTO `usuario` (`usuario_id_usuario`, `usuario_nome`,  `usuario_cpf`, `usuario_rg`, `usuario_email`, `usuario_tel`, `usuario_cel`, `usuario_id_end`, `usuario_id_arduino`, `usuario_id_login`,  `usuario_situacao`) VALUES ('7', 'Lucas Hofman',  '281.064.341-00', '12.112.563-7', 'lucas@hotmail.com', '(012) 3912-1239', '(012) 98262-2430', '7', '7', '7', 'A');

INSERT INTO `tipoFuncionario`(`tipoFunc_id_tipoFunc`, `tipoFunc_tipo`, `tipoFunc_obs`, `tipoFunc_situacao`) VALUES ('1','Jardineiro','Cuidar do gramado.','A');
INSERT INTO `tipoFuncionario`(`tipoFunc_id_tipoFunc`, `tipoFunc_tipo`, `tipoFunc_obs`, `tipoFunc_situacao`) VALUES ('2','Limpeza','Limpar e manter em ordem as areas comunitarias.','A');
INSERT INTO `tipoFuncionario`(`tipoFunc_id_tipoFunc`, `tipoFunc_tipo`, `tipoFunc_obs`, `tipoFunc_situacao`) VALUES ('3','Porteiro','Garantir a entrada e saida de moradores com segurança.','A');

INSERT INTO `funcionario`(`func_id_func`, `func_id_usuario`, `func_id_tipoFunc`, `func_situacao`) VALUES ('1','2','1','A');

INSERT INTO `correio` (`correio_id_correio`, `correio_id_usuario`, `correio_nome_correio`, `correio_rg_correio`, `correio_empre_correio`, `correio_data`, `correio_situacao`) VALUES ('1', '1', 'Fernando', '23.563.562-9', 'Kabum', '2015-09-28 00:00:00', 'A');
INSERT INTO `correio` (`correio_id_correio`, `correio_id_usuario`, `correio_nome_correio`, `correio_rg_correio`, `correio_empre_correio`, `correio_data`, `correio_situacao`) VALUES ('2', '2', 'Fernando', '23.563.562-9', 'Kabum', '2015-09-28 00:00:00', 'A');

INSERT INTO `grupo`(`gp_id_gp`, `gp_grupo`, `gp_users`, `gp_id_pags` ,`gp_situacao`) VALUES ('1', 'Administrador', '1|' , '2|5|3|6|11|12|7|8|9|10|4' ,'A');
INSERT INTO `grupo`(`gp_id_gp`, `gp_grupo`, `gp_users`, `gp_id_pags` ,`gp_situacao`) VALUES ('2', 'Sindico', '' , '2|5|' ,'A');
INSERT INTO `grupo`(`gp_id_gp`, `gp_grupo`, `gp_users`, `gp_id_pags` ,`gp_situacao`) VALUES ('3', 'Funcionario', '' , '2|5|' ,'A');
INSERT INTO `grupo`(`gp_id_gp`, `gp_grupo`, `gp_users`, `gp_id_pags` ,`gp_situacao`) VALUES ('4', 'Indefinido', '2|3|4|5|6|7|8|9|10|11|' , '' ,'A');

INSERT INTO `areaComum` (`ac_id_ac`, `ac_nome`, `ac_situacao`) VALUES ('1','Churrasqueira','A');
INSERT INTO `areaComum` (`ac_id_ac`, `ac_nome`, `ac_situacao`) VALUES ('2','Salao','A');
INSERT INTO `areaComum` (`ac_id_ac`, `ac_nome`, `ac_situacao`) VALUES ('3','Sala de cinema','A');

INSERT INTO `aluguel` (`al_id_al`, `al_id_usuario`, `al_id_ac`, `al_data`, `al_situacao`) VALUES ('1', '1', '1', '2015-11-10', 'A');

INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES ('1', '1', '2015-11-18 01:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES ('2', '1', '2015-11-18 02:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES ('3', '1', '2015-11-18 03:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES ('4', '3', '2015-11-18 04:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES ('5', '1', '2015-11-18 05:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES ('6', '1', '2015-11-18 06:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES ('7', '1', '2015-11-18 07:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES ('8', '2', '2015-11-18 08:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES ('9', '1', '2015-11-18 09:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES ('10', '1', '2015-11-18 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-01 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-02 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-03 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-04 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-05 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-05 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-05 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-05 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-05 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-05 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-06 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-07 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-08 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-09 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-10 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-11 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-11 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-11 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-12 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-13 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-14 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-14 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-14 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-15 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-16 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-17 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-18 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-19 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-19 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-19 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-20 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-21 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-22 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-22 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-22 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-23 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-24 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-24 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-24 10:02:03', 'A');
INSERT INTO `fluxo` (`fluxo_id_fluxo`, `fluxo_id_usuario`, `fluxo_horario`, `fluxo_situacao`) VALUES (null, '1', '2015-11-24 10:02:03', 'A');