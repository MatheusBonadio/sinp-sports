create database sinpSports;

use sinpSports;

Create table administrador (
	id_adm Int NOT NULL AUTO_INCREMENT,
	id_torneio Int NOT NULL,
	login Varchar(20) NOT NULL,
	senha Varchar(32) NOT NULL,
	email Varchar(70) NOT NULL,
	nome Varchar(40) NOT NULL,
	cargo varchar(20) NOT NULL,
 	Primary Key (id_adm)
);

Create table esporte (
	id_esporte Int NOT NULL AUTO_INCREMENT,
	id_torneio Int NOT NULL,
	esporte Varchar(30) NOT NULL,
	genero Varchar(15) NOT NULL,
	tipo Varchar(30) NOT NULL,
	qtd_jogadores Int NOT NULL,
	qtd_times Int NOT NULL,
	classificacao Varchar(20) NOT NULL,
	imagem Varchar(50) NULL,	
 	Primary Key (id_esporte)
);

Create table equipe (
	id_equipe Int NOT NULL AUTO_INCREMENT,
	id_torneio Int NOT NULL,
	nome Varchar(30) NOT NULL,
	sigla Varchar(6) NOT NULL,
	vitorias Int NULL DEFAULT 0,
	empates Int NULL DEFAULT 0,
	derrotas Int NULL DEFAULT 0,
	pontos Int NULL DEFAULT 0,
	representante varchar(20) NOT NULL,
	logo varchar(50) NULL,
 	Primary Key (id_equipe)
);

Create table partida (
	id_partida Int NOT NULL AUTO_INCREMENT,
	id_torneio Int NOT NULL,
	id_equipe_a Int NOT NULL,
	id_equipe_b Int NOT NULL,
	id_esporte Int NOT NULL,
	id_fase Int NOT NULL,
	dia Date NOT NULL,
	inicio Varchar(15),
	termino Varchar(15),
	placar_equipe_a Int DEFAULT 0,
	placar_equipe_b Int DEFAULT 0,
	vencedor Int,
 	Primary Key (id_partida)
);

Create table partida_log (
	id_log Int NOT NULL AUTO_INCREMENT,
	id_torneio Int NOT NULL,
	id_partida Int NOT NULL,
	id_fase Int NOT NULL,
	inicio Varchar(15),
	termino Varchar(15),
	placar_equipe_a Int,
	placar_equipe_b Int,
	vencedor Int,
	administrador Varchar(40),
	dataUpdate Datetime,
	action Varchar(50),
    Primary Key (id_log)
);

Create table permissao (
	login Varchar(20) NOT NULL,
	id_torneio Int NOT NULL,
	id_esporte Int NOT NULL
);

Create table destaque (
	id_destaque Int NOT NULL AUTO_INCREMENT,
	id_torneio Int NOT NULL,
	id_partida Int NOT NULL,
	texto Varchar(100) NOT NULL,
	imagem Varchar(50) NOT NULL,
 	Primary Key (id_destaque)
);

Create table fase (
	id_fase Int NOT NULL AUTO_INCREMENT,
	fase_descricao Varchar(40),
	fase_indice Int,
	Primary Key (id_fase)
);

Create table torneio (
	id_torneio Int NOT NULL AUTO_INCREMENT,
	descricao Varchar(100) NOT NULL,
	inicio Date NOT NULL,
	termino Date NOT NULL,
    Primary Key (id_torneio)
);

Create table participante (
	id_participante Int NOT NULL AUTO_INCREMENT,
	id_torneio Int NOT NULL,
	id_equipe Int NOT NULL,
	nome char(50) NOT NULL,
 	Primary Key (id_participante)
);

Create table participacao_esporte (
	id_participante Int NOT NULL,
	id_esporte Int NOT NULL
);

Alter table permissao add Foreign Key (login) references administrador (login) on delete  restrict on update  restrict;
Alter table permissao add Foreign Key (id_esporte) references esporte (id_esporte) on delete  restrict on update  restrict;
Alter table partida add Foreign Key (id_esporte) references esporte (id_esporte) on delete  restrict on update  restrict;
Alter table selecao_esporte add Foreign Key (id_esporte) references esporte (id_esporte) on delete  restrict on update  restrict;
Alter table partida add Foreign Key (id_equipe_a) references equipe (id_equipe) on delete  restrict on update  restrict;
Alter table selecao_esporte add Foreign Key (id_equipe) references equipe (id_equipe) on delete  restrict on update  restrict;
Alter table participante add Foreign Key (id_equipe) references equipe (id_equipe) on delete  restrict on update  restrict;
Alter table partida add Foreign Key (id_equipe_b) references equipe (id_equipe) on delete  restrict on update  restrict;
Alter table destaque add Foreign Key (id_partida) references partida (id_partida) on delete  restrict on update  restrict;
Alter table partida_log add Foreign Key (id_partida) references partida (id_partida) on delete  restrict on update  restrict;
Alter table partida add Foreign Key (id_fase) references fase (id_fase) on delete  restrict on update  restrict;
Alter table partida add Foreign Key (id_torneio) references torneio (id_torneio) on delete  restrict on update  restrict;
Alter table administrador add Foreign Key (id_torneio) references torneio (id_torneio) on delete  restrict on update  restrict;
Alter table participacao_esporte add Foreign Key (id_selecao) references selecao_esporte (id_selecao) on delete  restrict on update  restrict;
Alter table participacao_esporte add Foreign Key (id_participante) references participante (id_participante) on delete  restrict on update  restrict;