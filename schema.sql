drop table local_publico          cascade;
drop table item                   cascade;
drop table anomalia               cascade;
drop table anomalia_traducao      cascade;
drop table duplicado              cascade;
drop table utilizador             cascade;
drop table utilizador_qualificado cascade;
drop table utilizador_regular     cascade;
drop table incidencia             cascade;
drop table proposta_correcao      cascade;
drop table correcao               cascade;

----------------------------------------
-- Table Creation
----------------------------------------

-- Named constraints are global to the database.
-- Therefore the following use the following naming rules:
--   1. pk_table for names of primary key constraints
--   2. fk_table_another for names of foreign key constraints

create table local_publico (
	lp_latitude  decimal(8, 6)  not null,
	lp_longitude decimal(9, 6)  not null,
	lp_nome      varchar(80)    not null,
	constraint pk_local_publico primary key (lp_latitude, lp_longitude)

);

create table item (
	i_id          serial           	 not null unique,
	i_descricao   varchar(80)        not null,
	i_localizacao varchar(80)        not null,
	lp_latitude   decimal(8, 6)      not null,
	lp_longitude  decimal(9, 6)      not null,
	constraint    pk_item            primary key (i_id),
	constraint    fk_i_local_publico foreign key (lp_latitude, lp_longitude) references local_publico(lp_latitude, lp_longitude)
	ON DELETE CASCADE 
	ON UPDATE CASCADE
);

create table anomalia (
	a_id                   serial     	not null unique,
	a_zona                 varchar(8)   not null,
	a_imagem               varchar(80)  not null,
	a_lingua               varchar(80)  not null,
	a_ts                   timestamp    default current_timestamp,
	a_descricao            varchar(80)  not null,
	a_tem_anomalia_redacao boolean      not null,
	constraint pk_anomalia primary key (a_id),
	constraint ck_zone     check   (SUBSTRING(a_zona, 1, 3)::int8 >= -90 AND SUBSTRING(a_zona, 1, 3)::int8 <= 90 AND SUBSTRING(a_zona, 4, 2) = ', ' AND SUBSTRING(a_zona, 6, 3)::int8 >=0 AND SUBSTRING(a_zona, 6, 3)::int8 <= 180)
);

create table anomalia_traducao (
	a_id       smallint    not null unique,
	at_zona2   varchar(8)  not null,
	at_lingua2 varchar(80) not null,
	constraint pk_anomalia_traducao primary key (a_id),
	constraint fk_at_anomalia       foreign key (a_id) references anomalia(a_id) ON DELETE CASCADE ON UPDATE CASCADE,
	constraint ck_zone2       check (SUBSTRING(at_zona2, 1, 3)::int8 >= -90 AND SUBSTRING(at_zona2, 1, 3)::int8 <= 90 AND SUBSTRING(at_zona2, 4, 2) = ', ' AND SUBSTRING(at_zona2, 6, 3)::int8 >=0 AND SUBSTRING(at_zona2, 6, 3)::int8 <= 180)
);

create table duplicado (
	i_id1 smallint not null,
	i_id2 smallint not null,
	constraint pk_duplicado primary key (i_id1, i_id2),
	constraint fk_d_item1   foreign key (i_id1) references item(i_id) ON DELETE CASCADE ON UPDATE CASCADE,
	constraint fk_d_item2   foreign key (i_id2) references item(i_id) ON DELETE CASCADE ON UPDATE CASCADE,
	constraint check_items  check   (i_id1 < i_id2)
);

create table utilizador (
	u_email    varchar(80)   not null unique,
	u_password varchar(80)   not null,
	constraint pk_utilizador primary key (u_email)
);

create table utilizador_qualificado (
	u_email varchar(80)                  not null unique,
	constraint pk_utilizador_qualificado primary key (u_email),
	constraint fk_uq_utilizador          foreign key (u_email) references utilizador(u_email) ON DELETE CASCADE ON UPDATE CASCADE
);

create table utilizador_regular (
	u_email varchar(80)              not null unique,
	constraint pk_utilizador_regular primary key (u_email),
	constraint fk_ur_utilizador      foreign key (u_email) references utilizador(u_email) ON DELETE CASCADE ON UPDATE CASCADE
);

create table incidencia (
	a_id     smallint           not null,
	i_id     smallint           not null,
	u_email  varchar(80)        not null,
	constraint pk_incidencia    primary key (a_id),
	constraint fk_ic_anomalia   foreign key (a_id)    references anomalia(a_id) ON DELETE CASCADE ON UPDATE CASCADE,
	constraint fk_ic_item       foreign key (i_id)    references item(i_id) ON DELETE CASCADE ON UPDATE CASCADE,
	constraint fk_ic_utilizador foreign key (u_email) references utilizador(u_email) ON DELETE CASCADE ON UPDATE CASCADE
);

create table proposta_correcao (
	pc_nro       smallint    not null unique,
	pc_data_hora varchar(80) not null,
	pc_texto     varchar(80) not null,
	u_email      varchar(80) not null,
	constraint   pk_proposta_correcao         primary key (u_email, pc_nro),
	constraint   fk_pc_utilizador_qualificado foreign key (u_email) references utilizador_qualificado(u_email) ON DELETE CASCADE ON UPDATE CASCADE
);

create table correcao (
	u_email varchar(80) not null,
	pc_nro  smallint    not null,
	a_id    smallint    not null,
	constraint pk_correcao            primary key (u_email, pc_nro, a_id),
	constraint fk_c_proposta_correcao foreign key (u_email, pc_nro) references proposta_correcao(u_email, pc_nro) ON DELETE CASCADE ON UPDATE CASCADE,
	constraint fk_c_anomalia          foreign key (a_id)            references incidencia(a_id) ON DELETE CASCADE ON UPDATE CASCADE
);
