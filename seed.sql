create database if not exists apiPhp;

use apiPhp;

create table if not exists tbl_usuario(

	col_nome varchar(255) not null,
	col_usuario varchar(255) not null unique,
	col_email varchar(255) not null,
	col_senha varchar(255) not null,
	col_ativo boolean default False,

	primary key (col_email)

);